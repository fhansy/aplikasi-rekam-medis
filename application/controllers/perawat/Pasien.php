<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
	var $hak_akses='resepsionis';
	var $link='pasien';
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
		$this->data['pasien']=$this->M_Pasien->getAll();
		$this->data['isi'] = $this->load->view($this->link.'/index',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}

	public function form($id)
	{
		if($id==0){	
			$this->data['judul_tab']='Form Tambah Pasien';
			$this->data['title']='Tambah Pasien';
		}else{

			$this->data['judul_tab']='Form Edit Pasien';
			$this->data['title']='Edit Pasien';

			$this->data['pasien']=$this->M_Pasien->getID($id);
		}
			$this->data['isi'] = $this->load->view($this->link.'/form',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function input()
	{
		
		$id_pasien	= $this->input->post('id_pasien');
		$nama_pasien	= $this->input->post('nama_pasien');
		$tempat_lahir	= $this->input->post('tempat_lahir');
		$tanggal_lahir	= $this->input->post('tanggal_lahir');
		$jenis_kelamin	= $this->input->post('jenis_kelamin');
		$agama	= $this->input->post('agama');
		$status_perkawinan	= $this->input->post('status_perkawinan');
		$pekerjaan	= $this->input->post('pekerjaan');
		$alamat	= $this->input->post('alamat');
		$no_telp	= $this->input->post('no_telp');
		$no_identitas	= $this->input->post('no_identitas');
			
		$data = array(
				'nama_pasien'=>$nama_pasien,
				'tempat_lahir'=>$tempat_lahir,
				'tanggal_lahir'=>$tanggal_lahir,
				'jenis_kelamin'=>$jenis_kelamin,
				'agama'=>$agama,
				'status_perkawinan'=>$status_perkawinan,
				'pekerjaan'=>$pekerjaan,
				'alamat'=>$alamat,
				'no_telp'=>$no_telp,
				'no_identitas'=>$no_identitas
				);

		if($id_pasien==0){	
			if ($this->M_Pasien->insert($data)) {// success
					$this->session->set_flashdata('message', 'Pasien Baru Berhasil Ditambahkan');
					redirect($this->hak_akses.'/'.$this->link.'/index/');
				}
		}else{
			$data += array(
				'id_pasien'=>$id_pasien
			);
			if ($this->M_Pasien->update($data)) {// success
					$this->session->set_flashdata('message', 'Data Pasien Berhasil Diubah');
					redirect($this->hak_akses.'/'.$this->link.'/index/');
				}
		}
			
	}

	public function hapus($id)
	{
		// $this->M_Pasien->hapus_gambar($id);
		$this->M_Pasien->delete($id);
		$this->session->set_flashdata('message2', 'Data Pasien Berhasil <b>Dihapus</b>');
		redirect($this->hak_akses.'/'.$this->link.'/index/');
	}

	public function laporan()
	{	
		$hari	= $this->input->post('hari');
		$poli	= $this->session->userdata('poli');
		if(empty($hari)){
			$hari=Date('Y-m-d');
		}

		$this->data['judul_tab']='Laporan Harian';
		$this->data['title']='Data Laporan Harian';
		$this->data['hari']=$hari;
		$this->data['pasien']=$this->M_Rekap_Medis->getHari($hari,$poli);
		$this->data['penyakit']=$this->M_Rekap_Medis->getPenyakit($hari,$poli);
		$this->data['isi'] = $this->load->view($this->link.'/laporan',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}

}
