<?php
class M_Pasien extends CI_Model {
	// var $session_expire	= 7200;
	var $table='pasien';
	var $pk='id_pasien';

	public function getAll ()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by($this->pk, 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getAllWithTgl ()
	{
		$this->db->select('*');
		$this->db->from('pasien p');
		$this->db->join('pendaftaran pe', 'pe.id_pasien=p.id_pasien');
		$this->db->order_by('p.id_pasien', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getID($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where($this->pk, $id);

		$query = $this->db->get();
		// if ($query->num_rows() > 0){
			return $query->row();
		// }else{
		// 	return false;
		// }
	}
	public function getMax()
	{
		$this->db->select('Max(id_pasien) as id');
		$this->db->from($this->table);
		$query = $this->db->get();
		// if ($query->num_rows() > 0){
			return $query->row('id');
		// }else{
		// 	return false;
		// }
	}
	public function insert($data){
		$id = $this->db->insert($this->table, $data);
		//$this->db->insert_id();
		return $id;
	}
	
	public function update($data){
		$this->db->where($this->pk, $data[$this->pk]);
		$id = $this->db->update($this->table, $data);
		return $id;
	}
	public function delete($id){
		$id = $this->db->where($this->pk,$id)->delete($this->table);
		return $id;
	}

	public function totalKunjunganUsia($tahun, $awal, $akhir)
	{
		$this->db->select('COUNT(*) as totalKunjunganUsia');
		$this->db->from("rekap_medis rm");
		$this->db->join('pendaftaran pe', 'rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p', 'p.id_pasien=rm.id_pasien');
		$this->db->where('Year(pe.tgl_pendaftaran)-Year(p.tanggal_lahir) >=', $awal);
		$this->db->where('Year(pe.tgl_pendaftaran)-Year(p.tanggal_lahir) <', $akhir);
		$this->db->where('Year(pe.tgl_pendaftaran)', $tahun);

		$query = $this->db->get();
		$hasil_totalKunjunganUsia = $query->row_array()['totalKunjunganUsia'];
		if (!empty($hasil_totalKunjunganUsia)) {
			$totalKunjunganUsia = $hasil_totalKunjunganUsia;
		} else {
			$totalKunjunganUsia = 0;
		}
		return $totalKunjunganUsia;
	}

	public function totalKunjunganGender($tahun, $jenis_kelamin)
	{
		$this->db->select('COUNT(*) as jumlahGender');
		$this->db->from("rekap_medis rm");
		$this->db->join('pendaftaran pe', 'rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p', 'p.id_pasien=rm.id_pasien');
		$this->db->where('p.jenis_kelamin', $jenis_kelamin);
		$this->db->where('Year(pe.tgl_pendaftaran)', $tahun);

		$query = $this->db->get();
		// $hasil_jumlah=$query->row_array()->jumlah;
		$hasil_jumlahGender = $query->row_array()['jumlahGender'];
		if (!empty($hasil_jumlahGender)) {
			$jumlahGender = $hasil_jumlahGender;
		} else {
			$jumlahGender = 0;
		}
		return $jumlahGender;
	}
}
