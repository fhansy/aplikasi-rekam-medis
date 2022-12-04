<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
	var $hak_akses='perawat';
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
		$this->data['judul_tab']='Antrian Pasien';
		$this->data['title']='Antrian Pasien';
		$this->data['periksa']=$this->M_Pendaftaran->getDay($this->session->userdata('tgl_sekarang'),'Periksa',$this->session->userdata('poli'));
		$this->data['vital_sign']=$this->M_Pendaftaran->getDay($this->session->userdata('tgl_sekarang'),'Vital Sign',$this->session->userdata('poli'));
		$this->data['tunggu_periksa']=$this->M_Pendaftaran->getDay($this->session->userdata('tgl_sekarang'),'Tunggu Periksa',$this->session->userdata('poli'));
		$this->data['tunggu_vital_sign']=$this->M_Pendaftaran->getDay($this->session->userdata('tgl_sekarang'),'Tunggu Vital Sign',$this->session->userdata('poli'));
		$this->data['antrian']=$this->M_Pendaftaran->getDay($this->session->userdata('tgl_sekarang'),'Antrian',$this->session->userdata('poli'));
		
		$this->data['isi'] = $this->load->view($this->link.'/index_perawat',$this->data,TRUE);

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
	public function input($id)
	{
		
		$id_pendaftaran	= $id;
		$status	= "Tunggu Vital Sign";
			
		$data = array(
				'id_pendaftaran'=>$id_pendaftaran,
				'status'=>$status
				);

		if ($this->M_Pendaftaran->update($data)) {// success
				$this->session->set_flashdata('message', 'Pasien Dilewati Dari Antrian');
				redirect($this->hak_akses.'/pendaftaran/');
			}
			
	}
	public function input_batal($id)
	{
		
		$id_pendaftaran	= $id;
		$status	= "Batal Antrian";
			
		$data = array(
				'id_pendaftaran'=>$id_pendaftaran,
				'status'=>$status
				);

		if ($this->M_Pendaftaran->update($data)) {// success
				$this->session->set_flashdata('message3', 'Batal Pemeriksaan, pasien telah dihapus dari antrian');
				redirect($this->hak_akses.'/pendaftaran/');
			}
			
	}

	public function hapus($id)
	{
		// $this->M_Pendaftaran->hapus_gambar($id);
		$this->M_Pendaftaran->delete($id);
		$this->session->set_flashdata('message2', 'Pasien Berhasil <b>Dihapus</b> dari Antrian');
		redirect($this->hak_akses.'/'.$this->link.'/index/');
	}

}
