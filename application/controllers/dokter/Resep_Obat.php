<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resep_Obat extends CI_Controller {
	var $hak_akses='dokter';
	var $link='resep_obat';
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		if(empty($this->session->userdata('username'))){
			redirect('auth');
		}
	}

	public function form($id)
	{

			$this->data['judul_tab']='Form Resep Obat';
			$this->data['title']='Resep Obat';
			

			$this->data['resep_obat']=$this->M_Resep_Obat->getID($id);
			$this->data['rekap_medis']=$this->M_Rekap_Medis->getID($id);

			$this->data['obat']=$this->M_Obat->getAll();
			$this->data['isi'] = $this->load->view($this->link.'/form',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function input()
	{

		$id_rekap_medis	= $this->input->post('id_rekap_medis');
		$halaman	= $this->input->post('halaman');
		$id_obat	= $this->input->post('id_obat');
		$signatura	= $this->input->post('signatura');
		$terapi	= $this->input->post('terapi');
		$id_user	= $this->session->userdata('id_user');
			
		$data = array(
				'id_obat'=>$id_obat,
				'signatura'=>$signatura,
				'id_rekap_medis'=>$id_rekap_medis
				);

		if ($this->M_Resep_Obat->insert($data)) {// success
				$this->session->set_flashdata('message', 'Resep Obat Berhasil Disimpan');
				redirect($this->hak_akses.'/resep_obat/form/'.$id_rekap_medis.'?h='.$halaman);
			}
			
	}
	public function hapus($id,$id_rekap_medis,$halaman)
	{
		// $this->M_Barang->hapus_gambar($id);
		$this->M_Resep_Obat->delete($id);
		redirect($this->hak_akses.'/'.$this->link.'/form/'.$id_rekap_medis.'?h='.$halaman);
	}
	
	public function print($id)
	{
		$this->data['judul_tab']='Cetak Resep';
		$rekap_medis=$this->M_Rekap_Medis->getID($id);

		$this->data['rekap_medis']=$rekap_medis;
		$this->data['resep_obat']=$this->M_Resep_Obat->getID($id);

			$this->load->view('resep_obat/cetak',$this->data);
	}
	

}
