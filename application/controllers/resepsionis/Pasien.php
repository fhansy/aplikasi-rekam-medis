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
		$this->data['pendaftaran']=$this->M_Pasien->getAllWithTgl();
		$this->data['isi'] = $this->load->view($this->link.'/index',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}

	public function form($id)
	{
		if($id==0){	
			$this->data['judul_tab']='Form Pendaftaran Pasien Baru';
			$this->data['title']='Form Pendaftaran Pasien Baru';
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
		$identitas = $this->input->post('identitas');
		$nik	= $this->input->post('nik');
		$sim	= $this->input->post('sim');
		$paspor	= $this->input->post('paspor');
			
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
				'identitas'=>$identitas,
				'nik'=>$nik,
				'sim'=>$sim,
				'paspor'=>$paspor
				);

		if($id_pasien==0){	
			$data += array(
				'id_pasien'=>$this->M_Pasien->getMax()+1
				);
			if ($this->M_Pasien->insert($data)) {// success
				$poli_tujuan	= $this->input->post('poli_tujuan');
				$id_pasien	= $this->M_Pasien->getMax();
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
				if ($this->M_Pendaftaran->insert($data)) {// success
					$id_pendaftaran	= $this->M_Pendaftaran->getMax();
					$data = array(
					'id_pendaftaran'=>$id_pendaftaran,
					'id_pasien'=>$id_pasien,
					'id_user'=>$id_user,
					'keluhan'=>$keluhan
					);
					$this->M_Rekap_Medis->insert($data);
				}
					$this->session->set_flashdata('message', 'Data Pasien Baru Berhasil Disimpan');
					

					// redirect($this->hak_akses.'/'.$this->link.'/index/');
					redirect($this->hak_akses.'/'.$this->link.'/kartu/'.$this->M_Pasien->getMax());
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
		if($this->M_Pasien->delete($id)){
			$this->session->set_flashdata('message2', 'Data Pasien Berhasil <b>Dihapus</b>');
			redirect($this->hak_akses.'/'.$this->link.'/index/');
		}
	}
	public function kartu($id)
	{
		$this->data['judul_tab']='Cetak Kartu';
			$this->data['pasien']=$this->M_Pasien->getID($id);

			$this->load->view('pasien/kartu',$this->data);
	}
}
