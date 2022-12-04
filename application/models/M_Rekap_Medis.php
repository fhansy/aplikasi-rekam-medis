<?php
class M_Rekap_Medis extends CI_Model {
	
	var $table='rekap_medis';
	var $pk='id_rekap_medis';

	public function getAll ()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getID($id)
	{
		$this->db->select('*, u.nama as nama_dokter');
		$this->db->from($this->table." rm");
		$this->db->join('pendaftaran pe','rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p','p.id_pasien=rm.id_pasien');
		$this->db->join('user u','u.id_user=rm.id_user');
		$this->db->where('rm.'.$this->pk, $id);

		$query = $this->db->get();
		// if ($query->num_rows() > 0){
			return $query->row();
		// }else{
		// 	return false;
		// }
	}
	public function getHari($tgl,$poli)
	{
		$this->db->select('*,  u.nama as nama_dokter');
		$this->db->from($this->table." rm");
		$this->db->join('pendaftaran pe','rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p','p.id_pasien=rm.id_pasien');
		$this->db->join('user u','u.id_user=rm.id_user');
		$this->db->join('diagnosa d','d.id_rekap_medis=rm.id_rekap_medis');
		$this->db->join('penyakit s','s.id_penyakit=d.id_penyakit');
		$this->db->where('Date(pe.tgl_pendaftaran)',$tgl);
		$this->db->where('poli_tujuan',$poli);
		$this->db->where('penyakit_terkonfirmasi','Y');


		$query = $this->db->get();
		return $query->result_array();
	}
	public function getPenyakit($tgl,$poli)
	{
		$this->db->select('s.id_penyakit,s.nama_penyakit, Count(*) as jumlah');
		$this->db->from($this->table." rm");
		$this->db->join('pendaftaran pe','rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p','p.id_pasien=rm.id_pasien');
		$this->db->join('user u','u.id_user=rm.id_user');
		$this->db->join('diagnosa d','d.id_rekap_medis=rm.id_rekap_medis');
		$this->db->join('penyakit s','s.id_penyakit=d.id_penyakit');
		$this->db->where('Date(pe.tgl_pendaftaran)',$tgl);
		$this->db->where('poli_tujuan',$poli);
		$this->db->where('penyakit_terkonfirmasi','Y');
		$this->db->group_by('s.id_penyakit');


		$query = $this->db->get();
		return $query->result_array();
	}

	public function get10BesarPenyakit($tgl)
	{
		$this->db->select('s.id_penyakit,s.nama_penyakit, Count(*) as jumlah');
		$this->db->from($this->table." rm");
		$this->db->join('pendaftaran pe','rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p','p.id_pasien=rm.id_pasien');
		// $this->db->join('user u','u.id_user=rm.id_user');
		$this->db->join('diagnosa d','d.id_rekap_medis=rm.id_rekap_medis');
		$this->db->join('penyakit s','s.id_penyakit=d.id_penyakit');
		$this->db->where("DATE_FORMAT(pe.tgl_pendaftaran,'%Y-%m')",$tgl);
		$this->db->where('penyakit_terkonfirmasi','Y');
		$this->db->group_by('s.id_penyakit');
		$this->db->order_by('jumlah', 'DESC');
		$this->db->limit(10);

		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function getPerTahun($tahun)
	{
		$this->db->select('pe.id_pendaftaran, pe.tgl_pendaftaran, Count(*) as jumlah');
		$this->db->from($this->table." rm");
		$this->db->join('pendaftaran pe','rm.id_pendaftaran=pe.id_pendaftaran');
		// $this->db->join('pasien p','p.id_pasien=rm.id_pasien');
		// $this->db->join('user u','u.id_user=rm.id_user');
		// $this->db->join('diagnosa d','d.id_rekap_medis=rm.id_rekap_medis');
		// $this->db->join('penyakit s','s.id_penyakit=d.id_penyakit');
		$this->db->where('Year(pe.tgl_pendaftaran)', $tahun);
		//$this->db->group_by('Year(pe.tgl_pendaftaran)');

		$query = $this->db->get();
		//return $query->result_array();
		$hasil_jumlah = $query->row_array()['jumlah'];
		if (!empty($hasil_jumlah)) {
			$jumlah = $hasil_jumlah;
		} else {
			$jumlah = 0;
		}
		return $jumlah;
	}

	public function getGroupByTahun($id)
	{
		$this->db->select('*');
		$this->db->from($this->table." rm");
		$this->db->join('pendaftaran pe','rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p','p.id_pasien=rm.id_pasien');
		$this->db->join('user u','u.id_user=rm.id_user');
		$this->db->join('diagnosa d','d.id_rekap_medis=rm.id_rekap_medis');
		$this->db->join('penyakit s','s.id_penyakit=d.id_penyakit');
		$this->db->where('p.id_pasien', $id);
		$this->db->group_by('Year(pe.tgl_pendaftaran)');
		$this->db->order_by('Year(pe.tgl_pendaftaran)', 'DESC');


		$query = $this->db->get();
		return $query->result_array();
	}
	public function getTahun($tahun,$id)
	{
		$this->db->select('*');
		$this->db->from($this->table." rm");
		$this->db->join('pendaftaran pe','rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p','p.id_pasien=rm.id_pasien');
		$this->db->join('user u','u.id_user=rm.id_user');
		$this->db->join('diagnosa d','d.id_rekap_medis=rm.id_rekap_medis');
		$this->db->join('penyakit s','s.id_penyakit=d.id_penyakit');
		$this->db->where('p.id_pasien', $id);
		$this->db->where('Year(pe.tgl_pendaftaran)', $tahun);
		$this->db->group_by('rm.id_rekap_medis');

		$query = $this->db->get();
		return $query->result_array();
	}
	public function insert($data){
		$id = $this->db->insert($this->table, $data);
		//$this->db->insert_id();
		return $id;
	}
	public function getPasien($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('pasien p','p.id_pasien=rekap_medis.id_pasien');
		$this->db->where('p.id_pasien', $id);

		$query = $this->db->get();
		// if ($query->num_rows() > 0){
			return $query->row();
		// }else{
		// 	return false;
		// }
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

	public function deleteTahun($id, $tahun){

		$sql = "DELETE rm FROM rekap_medis rm
				JOIN pendaftaran pe ON rm.id_pendaftaran = pe.id_pendaftaran
				WHERE rm.id_pasien = $id AND YEAR(pe.tgl_pendaftaran) = $tahun";

		$this->db->query($sql);

		// $this->db->from('rekap_medis rm');
		// $this->db->join('pendaftaran pe','rm.id_pendaftaran=pe.id_pendaftaran');
		// $this->db->where('rm.id_pasien', $id);
		// $this->db->where('Year(pe.tgl_pendaftaran)', $tahun);
		// $id = $this->db->delete('rm');
		// return $id;
	}
}
