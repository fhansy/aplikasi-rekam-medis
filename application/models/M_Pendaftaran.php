<?php
class M_Pendaftaran extends CI_Model {
	// var $session_expire	= 7200;
	var $table='pendaftaran';
	var $pk='id_pendaftaran';

	public function getAll ()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by($this->pk, 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getDay ($tgl_sekarang,$status,$poli_tujuan)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('pasien p','p.id_pasien=pendaftaran.id_pasien');
		$this->db->join('rekap_medis rm','rm.id_pendaftaran=pendaftaran.id_pendaftaran');
		$this->db->where('date(tgl_pendaftaran)',$tgl_sekarang);
		$this->db->where('status',$status);
		$this->db->where('poli_tujuan',$poli_tujuan);
		$this->db->order_by('pendaftaran.'.$this->pk, 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getJmlAntrianPoli ($tgl_sekarang,$poli_tujuan)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('pasien p','p.id_pasien=pendaftaran.id_pasien');
		$this->db->join('rekap_medis rm','rm.id_pendaftaran=pendaftaran.id_pendaftaran');
		$this->db->where('date(tgl_pendaftaran)',$tgl_sekarang);
		$this->db->where('status != "Selesai"');
		$this->db->where('status != "Batal Antrian"');
		$this->db->where('poli_tujuan',$poli_tujuan);
		$this->db->order_by('pendaftaran.'.$this->pk, 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getPasien ($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('pasien p','p.id_pasien=pendaftaran.id_pasien');
		$this->db->join('rekap_medis rm','rm.id_pendaftaran=pendaftaran.id_pendaftaran');
		$this->db->join('diagnosa d','rm.id_rekap_medis=d.id_rekap_medis');
		$this->db->where('p.id_pasien',$id);
		$this->db->order_by('pendaftaran.'.$this->pk, 'DESC');
		$this->db->limit(3, 0);
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
		$this->db->select('Max(id_pendaftaran) as id');
		$this->db->from($this->table);
		$query = $this->db->get();
		// if ($query->num_rows() > 0){
			return $query->row('id');
		// }else{
		// 	return false;
		// }
	}
	public function getMaxNo($tgl_sekarang,$poli_tujuan)
	{
		$this->db->select('Max(no_daftar) as id');
		$this->db->where('date(tgl_pendaftaran)',$tgl_sekarang);
		$this->db->where('poli_tujuan',$poli_tujuan);
		$this->db->from($this->table);
		$query = $this->db->get();
		// if ($query->num_rows() > 0){
			return $query->row('id')+1;
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

	public function totalKunjunganHarian($tgl,$poli)
	{
		$this->db->select('*');
		$this->db->from($this->table." rm");
		$this->db->where('Date(tgl_pendaftaran)',$tgl);
		$this->db->where('poli_tujuan',$poli);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function totalKunjungan($tahun, $bulan){
		$this->db->select("COUNT(tgl_pendaftaran) as totalKunjungan");
		$this->db->from($this->table." rm");
		$this->db->where('MONTHNAME(tgl_pendaftaran) =', $bulan);
		$this->db->where('Year(tgl_pendaftaran)', $tahun);
		$query = $this->db->get();
		//return $query->result_array();
		$hasil_totalKunjungan = $query->row_array()['totalKunjungan'];
		if (!empty($hasil_totalKunjungan)) {
			$totalKunjungan = $hasil_totalKunjungan;
		} else {
			$totalKunjungan = 0;
		}
		return $totalKunjungan;
	}
}
