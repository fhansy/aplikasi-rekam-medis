<?php
class M_Penyakit extends CI_Model
{

	var $table = 'penyakit';
	var $pk = 'id_penyakit';

	public function getAll()
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
		$this->db->from($this->table);
		$this->db->where($this->pk, $id);

		$query = $this->db->get();
		// if ($query->num_rows() > 0){
		return $query->row();
		// }else{
		// 	return false;
		// }
	}

	public function getCount($id, $tahun, $jenis_kelamin, $awal, $akhir)
	{
		$this->db->select('s.id_penyakit, COUNT(*) as jumlah');
		$this->db->from("rekap_medis rm");
		$this->db->join('pendaftaran pe', 'rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p', 'p.id_pasien=rm.id_pasien');
		$this->db->join('user u', 'u.id_user=rm.id_user');
		$this->db->join('diagnosa d', 'd.id_rekap_medis=rm.id_rekap_medis');
		$this->db->join('penyakit s', 's.id_penyakit=d.id_penyakit');
		$this->db->where('s.' . $this->pk, $id);
		$this->db->where('Year(pe.tgl_pendaftaran)-Year(p.tanggal_lahir) >=', $awal);
		$this->db->where('Year(pe.tgl_pendaftaran)-Year(p.tanggal_lahir) <', $akhir);
		$this->db->where('p.jenis_kelamin', $jenis_kelamin);
		$this->db->where('Year(pe.tgl_pendaftaran)', $tahun);
		$this->db->group_by('s.id_penyakit');
		$this->db->group_by('p.id_pasien');

		$query = $this->db->get();
		// $hasil_jumlah=$query->row_array()->jumlah;
		$hasil_jumlah = $query->row_array()['jumlah'];
		if (!empty($hasil_jumlah)) {
			$jumlah = $hasil_jumlah;
		} else {
			$jumlah = 0;
		}
		return $jumlah;
	}
	public function getCountJK($id, $tahun, $jenis_kelamin)
	{
		//$condition = "d.id_pasien"

		// count(d.id_penyakit as idTerhitung);
		// where(d.id_pasien != idTerhitung)
		$this->db->select('s.id_penyakit, COUNT(s.id_penyakit) as jumlah');
		$this->db->from("rekap_medis rm");
		$this->db->join('pendaftaran pe', 'rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p', 'p.id_pasien=rm.id_pasien');
		$this->db->join('user u', 'u.id_user=rm.id_user');
		$this->db->join('diagnosa d', 'd.id_rekap_medis=rm.id_rekap_medis');
		$this->db->join('penyakit s', 's.id_penyakit=d.id_penyakit');
		$this->db->where('s.' . $this->pk, $id);
		//$this->db->where('')
		$this->db->where('p.jenis_kelamin', $jenis_kelamin);
		$this->db->where('Year(pe.tgl_pendaftaran)', $tahun);
		$this->db->group_by('s.id_penyakit');
		$this->db->group_by('p.id_pasien');

		$query = $this->db->get();
		// $hasil_jumlah=$query->row_array()->jumlah;
		$hasil_jumlah = $query->row_array()['jumlah'];
		if (!empty($hasil_jumlah)) {
			$jumlah = $hasil_jumlah;
		} else {
			$jumlah = 0;
		}
		return $jumlah;
	}
	public function getCountPenyakit($id, $tahun)
	{
		$this->db->select('s.id_penyakit, COUNT(*) as jumlah');
		$this->db->from("rekap_medis rm");
		$this->db->join('pendaftaran pe', 'rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p', 'p.id_pasien=rm.id_pasien');
		$this->db->join('user u', 'u.id_user=rm.id_user');
		$this->db->join('diagnosa d', 'd.id_rekap_medis=rm.id_rekap_medis');
		$this->db->join('penyakit s', 's.id_penyakit=d.id_penyakit');
		$this->db->where('s.' . $this->pk, $id);
		$this->db->where('Year(pe.tgl_pendaftaran)', $tahun);
		$this->db->group_by('s.id_penyakit');
		$this->db->group_by('p.id_pasien');

		$query = $this->db->get();
		// $hasil_jumlah=$query->row_array()->jumlah;
		$hasil_jumlah = $query->row_array()['jumlah'];
		if (!empty($hasil_jumlah)) {
			$jumlah = $hasil_jumlah;
		} else {
			$jumlah = 0;
		}
		return $jumlah;
	}
	public function getCountPenyakitAja($id, $tahun)
	{
		$this->db->select('s.id_penyakit, COUNT(*) as jumlah');
		$this->db->from("rekap_medis rm");
		$this->db->join('pendaftaran pe', 'rm.id_pendaftaran=pe.id_pendaftaran');
		$this->db->join('pasien p', 'p.id_pasien=rm.id_pasien');
		$this->db->join('user u', 'u.id_user=rm.id_user');
		$this->db->join('diagnosa d', 'd.id_rekap_medis=rm.id_rekap_medis');
		$this->db->join('penyakit s', 's.id_penyakit=d.id_penyakit');
		$this->db->where('s.' . $this->pk, $id);
		$this->db->where('Year(pe.tgl_pendaftaran)', $tahun);
		$this->db->group_by('s.id_penyakit');

		$query = $this->db->get();
		// $hasil_jumlah=$query->row_array()->jumlah;
		$hasil_jumlah = $query->row_array()['jumlah'];
		if (!empty($hasil_jumlah)) {
			$jumlah = $hasil_jumlah;
		} else {
			$jumlah = 0;
		}
		return $jumlah;
	}
	public function insert($data)
	{
		$id = $this->db->insert($this->table, $data);
		//$this->db->insert_id();
		return $id;
	}

	public function update($data)
	{
		$this->db->where($this->pk, $data[$this->pk]);
		$id = $this->db->update($this->table, $data);
		return $id;
	}

	public function delete($id)
	{
		$id = $this->db->where($this->pk, $id)->delete($this->table);
		return $id;
	}
}
