<?php
class M_Rujukan extends CI_Model {

	var $table='rujukan';
	var $pk='id_surat';

	public function getAll ()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function insert($data){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_rekap_medis', $data['id_rekap_medis']);

		$query = $this->db->get()->row();
		if(empty($query)){
			$id = $this->db->insert($this->table, $data);
		}else{
			$id = $this->db->where('id_rekap_medis', $data['id_rekap_medis'])->update($this->table, $data);
		}
		//$this->db->insert_id();
		return $id;
	}

	public function getID($id){
		$this->db->select('*');
		$this->db->from($this->table." rj");
		$this->db->join('rekap_medis rm','rm.id_rekap_medis=rj.id_rekap_medis');
		$this->db->where('rj.id_rekap_medis', $id);

		$query = $this->db->get();
		// if ($query->num_rows() > 0){
			return $query->row();
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