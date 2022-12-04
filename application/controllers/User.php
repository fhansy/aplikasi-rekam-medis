<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	var $hak_akses='user';
	// var $list= $this->list.'/index';
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		if(empty($this->session->userdata('username_user'))){
			redirect('page/login');
		}
	}

	public function index()
	{
		$this->data['judul_tab'] = 'Home';
		$this->data['title'] = 'Home';
		$this->data['isi'] = $this->load->view('user/home',$this->data,TRUE);

		$this->load->view('template/v_layout_user',$this->data);
	}

	public function periksa()
	{
		$this->data['judul_tab'] = 'Periksa';
		
		// $this->data['user']=$this->session->userdata();
		$this->data['user']=$this->M_Data_User->getID($this->session->userdata('id_data_user'));
		$this->data['gejala']=$this->M_Gejala->getAll();
		$this->data['isi'] = $this->load->view('user/periksa',$this->data,TRUE);

		$this->load->view('template/v_layout_user',$this->data);
		
	}
	public function lihat_perhitungan_periksa()
	{
		$this->data['judul_tab'] = 'Lihat Hitungan Periksa';
		$gejala	= $this->input->post('gejala');
		
		$this->data['perhitungan']=$this->M_Gejala->lihat_hasil_perhitungan($gejala,'penyakit','gejala','relasi_penyakit_gejala');
		$this->data['isi'] = $this->load->view('user/perhitungan',$this->data,TRUE);

		$this->load->view('template/v_layout_user',$this->data);
		
	}
	public function detail($id)
	{
		$this->data['judul_tab'] = 'Detail Diagnosis';
		$this->data['hasil_diagnosis']=$this->M_Hasil_Diagnosa->getID($id);
		$this->data['isi'] = $this->load->view('user/detail',$this->data,TRUE);

		$this->load->view('template/v_layout_user',$this->data);
	}
	public function hasil_diagnosa()
	{
		$this->data['judul_tab'] = 'Hasil Diagnosis';
		$this->data['hasil_diagnosis']=$this->M_Hasil_Diagnosa->getUser($this->session->userdata('id_data_user'));
		$this->data['isi'] = $this->load->view('user/hasil_diagnosa',$this->data,TRUE);

		$this->load->view('template/v_layout_user',$this->data);
	}
	public function hapus_diagnosa($id)
	{
		// $this->M_Penyakit->hapus_gambar($id);
		$this->M_Hasil_Diagnosa->delete($id);
		redirect($this->hak_akses.'/'.$this->link.'/hasil_diagnosa/');
	}
	public function input()
	{

		$id_data_user	= $this->session->userdata('id_data_user');
		$gejala		= $this->input->post('gejala');
		
		if(empty($gejala)){	
			$this->session->set_flashdata('message', 'Inputkan Gejala');
			redirect($this->hak_akses.'/periksa');
		}else{
			$id_penyakit=$this->M_Hasil_Diagnosa->perhitungan($gejala,'penyakit','gejala','relasi_penyakit_gejala');
			$insert = array(
				'id_data_user'=>$id_data_user,
				'id_penyakit'=>$id_penyakit);
			if ($this->M_Hasil_Diagnosa->insert($insert)) {// success
					$this->session->set_flashdata('message', 'Selesai Mendiagnosis');
					redirect($this->hak_akses.'/hasil_diagnosa');
				}
		}
			
	}
	public function hapus($id)
	{
		$this->M_Admin->hapus_gambar($id);
		$this->M_Admin->delete($id);
		redirect($hak_akses.'/'.$this->link);
	}

}