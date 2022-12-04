<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyakit extends CI_Controller {
	var $hak_akses='admin';
	var $link='penyakit';
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		if(empty($this->session->userdata('username'))){
			redirect('auth');
		}
	}

	public function index()
	{
		$this->data['judul_tab']='Penyakit';
		$this->data['title']='Data Penyakit';
		$this->data['penyakit']=$this->M_Penyakit->getAll();
		$this->data['isi'] = $this->load->view($this->link.'/index',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}

	public function form($id)
	{
		if($id==0){	
			$this->data['judul_tab']='Form Tambah Penyakit';
			$this->data['title']='Tambah Penyakit';
		}else{

			$this->data['judul_tab']='Form Edit Penyakit';
			$this->data['title']='Edit Penyakit';

			$this->data['penyakit']=$this->M_Penyakit->getID($id);
			// $id= $this->form_validation->set_value('id');
			// $nama_barang= $this->form_validation->set_value('nama_barang');
		}
			$this->data['isi'] = $this->load->view($this->link.'/form',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function input()
	{
		
		$id_penyakit	= $this->input->post('id_penyakit');
		$kode_dtd	= $this->input->post('kode_dtd');
		$kode_icdx	= $this->input->post('kode_icdx');
		$nama_penyakit	= $this->input->post('nama_penyakit');
			
		$data = array(
				'kode_dtd'=>$kode_dtd,
				'kode_icdx'=>$kode_icdx,
				'nama_penyakit'=>$nama_penyakit
				);

		if($id_penyakit==0){	
			if ($this->M_Penyakit->insert($data)) {// success
					$this->session->set_flashdata('message', 'Berhasil <b>Tambah</b> Data Penyakit');
					redirect($this->hak_akses.'/'.$this->link.'/index/');
				}
		}else{
			$data += array(
				'id_penyakit'=>$id_penyakit
			);
			if ($this->M_Penyakit->update($data)) {// success
					$this->session->set_flashdata('message', 'Data Penyakit Berhasil <b>Diubah</b>');
					redirect($this->hak_akses.'/'.$this->link.'/index/');
				}
		}
			
	}

	public function hapus($id)
	{
		// $this->M_Penyakit->hapus_gambar($id);
	if ($this->M_Penyakit->delete($id)){
			$this->session->set_flashdata('message2', 'Data Penyakit Berhasil <b>Dihapus</b>');
			redirect($this->hak_akses.'/'.$this->link.'/index/');
		}
	}

	public function laporan()
	{
		$tahun	= $this->input->post('tahun');

		$this->data['judul_tab']='Laporan Morbiditas';
		$this->data['title']='Data Laporan Morbiditas';
		$this->data['penyakit']=$this->M_Penyakit->getAll();
		$this->data['tahun']=$tahun;
		$this->data['isi'] = $this->load->view($this->link.'/laporan',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
}
