<?php
class M_Diagnosa extends CI_Model {
	// var $session_expire	= 7200;
	var $table='diagnosa';
	var $pk='id_diagnosa';

	public function getAll ()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by($this->pk, 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getID($id)
	{
		$this->db->select('*');
		$this->db->from($this->table.' d');
		$this->db->join('rekap_medis rm','rm.id_rekap_medis=d.id_rekap_medis');
		$this->db->join('penyakit p','p.id_penyakit=d.id_penyakit');
		$this->db->where('rm.id_rekap_medis', $id);

		$query = $this->db->get();
			return $query->result_array();
	}
	public function insert($data){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_penyakit', $data['id_penyakit']);
		$this->db->where('id_rekap_medis', $data['id_rekap_medis']);

		$query = $this->db->get()->row();
		if(empty($query)){
			$id = $this->db->insert($this->table, $data);
		}else{
			$id = $this->db->update($this->table, $data);
		}
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
}