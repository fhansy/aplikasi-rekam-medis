<?php
class M_Resep_Obat extends CI_Model {

	var $table='resep_obat';
	var $pk='id_resep_obat';

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
		$this->db->from($this->table.' ro');
		$this->db->join('rekap_medis rm','rm.id_rekap_medis=ro.id_rekap_medis');
		$this->db->join('obat o','o.id_obat=ro.id_obat');
		$this->db->where('rm.id_rekap_medis', $id);

		$query = $this->db->get();
			return $query->result_array();
	}
	
	public function insert($data){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_obat', $data['id_obat']);
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