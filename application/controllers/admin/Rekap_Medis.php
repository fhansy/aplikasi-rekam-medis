<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_Medis extends CI_Controller {
	var $hak_akses='admin';
	var $link='rekap_medis';
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
		// $data['barang']= $this->Model_Barang->getAllBarang();
		$this->data['judul_tab']='Data Rekam Medis';
		$this->data['title']='Data Rekam Medis';
		$this->data['pasien']=$this->M_Pasien->getAll();
		$this->data['isi'] = $this->load->view($this->link.'/index',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function pasien($id)
	{

			$this->data['judul_tab']='Form Rekam Medis';
			$this->data['title']='Rekam Medis';
			
			
			$this->data['rekap_medis']=$this->M_Rekap_Medis->getPasien($id);
			$this->data['pasien']=$this->M_Pasien->getID($id);
			$this->data['tahun']=$this->M_Rekap_Medis->getGroupByTahun($id);
			$this->data['isi'] = $this->load->view($this->link.'/rekap_pasien',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function cetak($id)
	{
		$status='Periksa';
		$rekap_medis=$this->M_Rekap_Medis->getID($id);
	
			$this->data['judul_tab']='Form Rekam Medis';
			$this->data['title']='Rekam Medis';
			$this->data['halaman']='lihat';
			$this->data['pasien']=$this->M_Pasien->getID($rekap_medis->id_pasien);

			$this->data['rekap_medis_pasien']=$this->M_Pendaftaran->getPasien($rekap_medis->id_pasien);
			$this->data['rekap_medis']=$rekap_medis;
			$this->data['resep_obat']=$this->M_Resep_Obat->getID($id);
			$this->data['diagnosis']=$this->M_Diagnosa->getID($id);
			$this->data['file']=$this->M_Penunjang->getAll($id);
			
			$this->data['isi'] = $this->load->view($this->link.'/cetak',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function lihat($id)
	{
		$status='Periksa';
		$rekap_medis=$this->M_Rekap_Medis->getID($id);
		$rujukan = $this->M_Rujukan->getID($id);

		$this->session->set_userdata('halamanKembali', "lihat");
	
			$this->data['judul_tab']='Form Rekam Medis';
			$this->data['title']='Rekam Medis';
			$this->data['halaman']='lihat';
			

			$this->data['rekap_medis_pasien']=$this->M_Pendaftaran->getPasien($rekap_medis->id_pasien);
			$this->data['rekap_medis']=$rekap_medis;
			$this->data['resep_obat']=$this->M_Resep_Obat->getID($id);
			$this->data['diagnosis']=$this->M_Diagnosa->getID($id);
			$this->data['file']=$this->M_Penunjang->getAll($id);
			$this->data['rujukan']=$rujukan;
			
			$this->data['isi'] = $this->load->view($this->link.'/lihat',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function form($id)
	{
		// $data['barang']= $this->Model_Barang->getAllBarang();
			$this->data['judul_tab']='Form Rekam Medis';
			$this->data['title']='Rekam Medis';

			$this->data['rekap_medis']=$this->M_Rekap_Medis->getPasien($id);
			$this->data['isi'] = $this->load->view($this->link.'/form',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function input()
	{
		$halaman	= $this->input->post('halaman');

		$id_rekap_medis	= $this->input->post('id_rekap_medis');
		$anamnesis	= $this->input->post('anamnesis');
		$pemeriksaan = $this->input->post('pemeriksaan');
		// $keluhan	= $this->input->post('keluhan');
		$terapi	= $this->input->post('terapi');
		$id_user	= $this->session->userdata('id_user');
			
		$data = array(
				'anamnesis'=>$anamnesis,
				'pemeriksaan'=>$pemeriksaan,
				// 'keluhan'=>$keluhan,
				'terapi'=>$terapi,
				'id_user'=>$id_user,
				'id_rekap_medis'=>$id_rekap_medis
				);

		if ($this->M_Rekap_Medis->update($data)) {// success
				$this->session->set_flashdata('message', 'Berhasil Edit data');
				redirect($this->hak_akses.'/rekap_medis/'.$halaman.'/'.$id_rekap_medis);
			}
			
	}
	
	public function hapus($id)
	{
		// $this->M_Barang->hapus_gambar($id);
		$this->M_Rekap_Medis->delete($id);
		redirect($this->hak_akses.'/'.$this->link);
	}

	public function hapus_tahun($id, $tahun)
	{
		// $this->M_Barang->hapus_gambar($id);
		$this->M_Rekap_Medis->deleteTahun($id, $tahun);
		redirect($this->hak_akses.'/rekap_medis/pasien/'.$id);
	}

	public function hapus_penunjang($id)
	{
		$data=$this->M_Penunjang->getID($id);
		$this->M_Penunjang->delete($id);
		redirect($this->hak_akses.'/rekap_medis/lihat/'.$data->id_rekap_medis);
	}
	public function tampil_file($id)
	{
		$data=$this->M_Penunjang->getID($id);
		echo '<html><head><title>'.$data->nama_file.'</title></head>';
		header('Content-Type:application/pdf');
		print base64_decode($data->file);
	}
	public function upload_file()
	{
		$id_rekap_medis	= $this->input->post('id_rekap_medis');
		$filename = $_FILES['file']['tmp_name'];
		$nama_file = $_FILES['file']['name'];
		
		$tipe_file =array('application/pdf');
		// Content type
		if($filename){
			//Seleksi Tipe File
			if(!in_array($_FILES['file']['type'], $tipe_file)){
				$this->session->set_flashdata('message2', 'File Bukan Gambar');
					redirect($this->hak_akses.'/rekap_medis/lihat/'.$id_rekap_medis);
			}

			//Seleksi Ukuran
			if($_FILES['file']['size']>500000){	
				$this->session->set_flashdata('message2', 'File Terlalu Besar Max 1 MB');
				redirect($this->hak_akses.'/rekap_medis/lihat/'.$id_rekap_medis);
			}
			$file=base64_encode(file_get_contents($filename));
				
			
			$data = array(
			'id_rekap_medis'=>$id_rekap_medis,
			'file_name'=>$nama_file,
			'file'=>$file);

			if ($this->M_Penunjang->insert($data)) {// success
					$this->session->set_flashdata('message', 'Berhasil Edit data');
					redirect($this->hak_akses.'/rekap_medis/lihat/'.$id_rekap_medis);
				}
		}
		

	}

	public function form_rujukan($id)
	{

		$status='Periksa';
		$rekap_medis=$this->M_Rekap_Medis->getID($id);
		$rujukan = $this->M_Rujukan->getID($id);
	
			$this->data['judul_tab']='Form Rujukan';
			$this->data['title']='Form Rujukan';
			$this->data['halaman']='form_rujukan';
			$this->data['pasien']=$this->M_Pasien->getID($rekap_medis->id_pasien);

			$this->data['rekap_medis_pasien']=$this->M_Pendaftaran->getPasien($rekap_medis->id_pasien);
			$this->data['rekap_medis']=$rekap_medis;
			$this->data['resep_obat']=$this->M_Resep_Obat->getID($id);
			$this->data['diagnosis']=$this->M_Diagnosa->getID($id);
			$this->data['file']=$this->M_Penunjang->getAll($id);

			$this->data['rujukan']=$rujukan;
			
			$this->data['isi'] = $this->load->view($this->link.'/cetak_rujukan',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}

}
