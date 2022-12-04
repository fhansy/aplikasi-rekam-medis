<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnosa extends CI_Controller {
	var $hak_akses='dokter';
	var $link='diagnosa';
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

			$this->data['judul_tab']='Form Diagnosis';
			$this->data['title']='Diagnosis';
			

			$this->data['diagnosis']=$this->M_Diagnosa->getID($id);
			$this->data['rekap_medis']=$this->M_Rekap_Medis->getID($id);

			$this->data['penyakit']=$this->M_Penyakit->getAll();
			$this->data['isi'] = $this->load->view($this->link.'/form',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function input()
	{

		$id_rekap_medis	= $this->input->post('id_rekap_medis');
		$halaman	= $this->input->post('halaman');
		$id_penyakit	= $this->input->post('id_penyakit');
		$penyakit_terkonfirmasi	= $this->input->post('penyakit_terkonfirmasi');
		$keterangan = $this->input->post('keterangan');
			
		$data = array(
				'id_penyakit'=>$id_penyakit,
				'penyakit_terkonfirmasi'=>$penyakit_terkonfirmasi,
				'id_rekap_medis'=>$id_rekap_medis,
				'keterangan'=>$keterangan
				);

		if ($this->M_Diagnosa->insert($data)) {// success
				$this->session->set_flashdata('message', 'Berhasil Simpan Hasil Diagnosis');
				redirect($this->hak_akses.'/'.$this->link.'/form/'.$id_rekap_medis.'?h='.$halaman);
			}
			
	}
	public function hapus($id,$id_rekap_medis,$halaman)
	{
		// $this->M_Barang->hapus_gambar($id);
		$this->M_Diagnosa->delete($id);
		$this->session->set_flashdata('message2', 'Hasil Diagnosis Berhasil <b>Dihapus</b>');
		redirect($this->hak_akses.'/'.$this->link.'/form/'.$id_rekap_medis.'?h='.$halaman);
	}

}
