<?php
class M_User extends CI_Model {
	// var $session_expire	= 7200;
	var $table='user';
	var $pk='id_user';

	public function getAll ()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by($this->pk, 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getPhoto(){
		$this->db->select('*');
		$this->db->from($this->table);
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
	public function login($data)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where($data);

		$query = $this->db->get();
		// if ($query->num_rows() > 0){
			return $query->row();
		// }else{
			// return false;
		// }
	}
	public function hak_akses($hak_akses){		
		// return $this->db->get_where($this->table,array('hak_akses'=>$hak_akses));
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('hak_akses', $hak_akses);
		$query = $this->db->get();
		return $query->result_array();
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

	public function cek_login($where){		
		return $this->db->get_where($this->table,$where);
	}
	public function delete($id){
		$id = $this->db->where($this->pk,$id)->delete($this->table);
		return $id;
	}	
}