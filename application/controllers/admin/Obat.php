<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller {
	var $hak_akses='admin';
	var $link='obat';
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
		$this->data['judul_tab']='Data Obat';
		$this->data['title']='Data Obat';
		$this->data['obat']=$this->M_Obat->getAll();
		$this->data['isi'] = $this->load->view($this->link.'/index',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}

	public function form($id)
	{

		if($id==0){	
			$this->data['judul_tab']='Form Tambah Obat';
			$this->data['title']='Tambah Data Obat';
		}else{

			$this->data['judul_tab']='Form Edit Obat';
			$this->data['title']='Edit Obat';

			$this->data['obat']=$this->M_Obat->getID($id);

		}
			$this->data['isi'] = $this->load->view($this->link.'/form',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function input()
	{
		
		$id_obat	= $this->input->post('id_obat');
		$nama_obat	= $this->input->post('nama_obat');

		$data = array(
				'nama_obat'=>$nama_obat
				);

		if($id_obat==0){	
			if ($this->M_Obat->insert($data)) {// success
					$this->session->set_flashdata('message', 'Berhasil <b>Tambah</b> Data Obat');
					redirect($this->hak_akses.'/'.$this->link.'/index/');
				}
		}else{
			
			$data += array(
			'id_obat'=>$id_obat
			);
			if ($this->M_Obat->update($data)) {// success
					$this->session->set_flashdata('message', 'Berhasil <b>Ubah</b> Data Obat');
					redirect($this->hak_akses.'/'.$this->link.'/index/');
				}
		}
			
	}

	public function hapus($id)
	{
		$this->M_Obat->delete($id);
		$this->session->set_flashdata('message2', 'Data Obat Berhasil <b>Dihapus</b>');
		redirect($this->hak_akses.'/'.$this->link.'/index/');
	}

}
