<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_Medis extends CI_Controller {
	var $hak_akses='perawat';
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

	public function form($id)
	{
		// $data['barang']= $this->Model_Barang->getAllBarang();
			$this->data['judul_tab']='Pemeriksaan Pasien';
			$this->data['title']='Pemeriksaan Pasien';
			if($id!=0){
			$this->data['rekap_medis']=$this->M_Rekap_Medis->getID($id);
			}
			$this->data['isi'] = $this->load->view($this->link.'/form_perawat',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function input()
	{
		
		$id_pendaftaran	= $this->input->post('id_pendaftaran');
		$status	= 'Vital Sign';

		$id_rekap_medis	= $this->input->post('id_rekap_medis');
		$tinggi_badan	= $this->input->post('tinggi_badan');
		$berat_badan	= $this->input->post('berat_badan');
		$suhu_badan	= $this->input->post('suhu_badan');
		$frekuensi_nadi	= $this->input->post('frekuensi_nadi');
		$frekuensi_pernapasan	= $this->input->post('frekuensi_pernapasan');
		$tekanan_darah_sistolik	= $this->input->post('tekanan_darah_sistolik');
		$tekanan_darah_diastolik	= $this->input->post('tekanan_darah_diastolik');
		$riwayat_alergi = $this->input->post('riwayat_alergi');
		$riwayat_penyakit_terdahulu = $this->input->post('riwayat_penyakit_terdahulu');
		$riwayat_kebiasaan = $this->input->post('riwayat_kebiasaan');
		
			$data = array(
					'tinggi_badan'=>$tinggi_badan,
					'berat_badan'=>$berat_badan,
					'suhu_badan'=>$suhu_badan,
					'frekuensi_nadi'=>$frekuensi_nadi,
					'frekuensi_pernapasan'=>$frekuensi_pernapasan,
					'tekanan_darah_sistolik'=>$tekanan_darah_sistolik,
					'tekanan_darah_diastolik'=>$tekanan_darah_diastolik,
					'id_rekap_medis'=>$id_rekap_medis,
					'riwayat_alergi'=>$riwayat_alergi,
					'riwayat_penyakit_terdahulu'=>$riwayat_penyakit_terdahulu,
					'riwayat_kebiasaan'=>$riwayat_kebiasaan
					);
			$data2 = array(
					'id_pendaftaran'=>$id_pendaftaran,
					'status'=>$status
					);
		

		$this->M_Pendaftaran->update($data2);
		if ($this->M_Rekap_Medis->update($data)) {// success
				$this->session->set_flashdata('message', 'Hasil Vital Sign Pasien Berhasil Tersimpan');
				redirect($this->hak_akses.'/pendaftaran/index/');
			}
			
	}
	public function hapus($id)
	{
		// $this->M_Barang->hapus_gambar($id);
	if($this->M_Rekap_Medis->delete($id)){
			$this->session->set_flashdata('message2', 'Data Pasien Berhasil <b>Dihapus</b>');
			redirect($this->hak_akses.'/'.$this->link);
		}
	}

}
