<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
	var $hak_akses='resepsionis';
	var $link='pendaftaran';
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
		$this->data['judul_tab']='Pasien';
		$this->data['title']='Data Pasien';
		$this->data['pendaftaran']=$this->M_Pendaftaran->getAll();
		$this->data['isi'] = $this->load->view($this->link.'/index',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function form($id)
	{
			$this->data['judul_tab']='Form Pendaftaran Pasien Rawat Jalan';
			$this->data['title']='Pendaftaran Pasien Rawat Jalan';

			$this->data['pasien']=$this->M_Pasien->getID($id);

			$this->data['isi'] = $this->load->view($this->link.'/form',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function input()
	{
		
		$id_pendaftaran	= $this->input->post('id_pendaftaran');
		$poli_tujuan	= $this->input->post('poli_tujuan');
		$id_pasien	= $this->input->post('id_pasien');
		$id_user	= $this->session->userdata('id_user');
		$tgl_sekarang	= $this->session->userdata('tgl_sekarang');
		$status	= "Antrian";
		$keluhan	= $this->input->post('keluhan');
			
		$data = array(
				'poli_tujuan'=>$poli_tujuan,
				'id_pasien'=>$id_pasien,
				'no_daftar'=>$this->M_Pendaftaran->getMaxNo($tgl_sekarang,$poli_tujuan),
				'id_user'=>$id_user,
				'status'=>$status
				);

		if($id_pendaftaran==0){	
			if ($this->M_Pendaftaran->insert($data)) {// success
				$data = array(
				'id_pendaftaran'=>$this->M_Pendaftaran->getMax(),
				'id_pasien'=>$id_pasien,
				'id_user'=>$id_user,
				'keluhan'=>$keluhan
				);
				$this->M_Rekap_Medis->insert($data);
					$this->session->set_flashdata('message', 'Pasien Berhasil Didaftarkan');
					redirect($this->hak_akses.'/pasien/index/');
				}
		}else{
			$data += array(
				'id_pendaftaran'=>$id_pendaftaran
			);
			if ($this->M_Pendaftaran->update($data)) {// success
					$this->session->set_flashdata('message', 'Berhasil Edit data');
					redirect($this->hak_akses.'/pasien/index/');
				}
		}
			
	}

	public function hapus($id)
	{
		// $this->M_Pendaftaran->hapus_gambar($id);
		$this->M_Pendaftaran->delete($id);
		redirect($this->hak_akses.'/'.$this->link.'/index/');
	}

	

}
