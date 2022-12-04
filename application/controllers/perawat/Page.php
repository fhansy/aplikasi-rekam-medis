<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	var $hak_akses='perawat';
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
		$this->data['judul_tab']='Sistem Informasi Rekam Medis';
		$this->data['title']='Dashboard';
		$this->data['periksa']=$this->M_Pendaftaran->getDay($this->session->userdata('tgl_sekarang'),'Periksa',$this->session->userdata('poli'));
		$this->data['vital_sign']=$this->M_Pendaftaran->getDay($this->session->userdata('tgl_sekarang'),'Vital Sign',$this->session->userdata('poli'));
		$this->data['tunggu_periksa']=$this->M_Pendaftaran->getDay($this->session->userdata('tgl_sekarang'),'Tunggu Periksa',$this->session->userdata('poli'));
		$this->data['tunggu_vital_sign']=$this->M_Pendaftaran->getDay($this->session->userdata('tgl_sekarang'),'Tunggu Vital Sign',$this->session->userdata('poli'));
		$this->data['antrian']=$this->M_Pendaftaran->getDay($this->session->userdata('tgl_sekarang'),'Antrian',$this->session->userdata('poli'));
		$this->data['perawat']=$this->M_User->hak_akses('perawat');
		$this->data['isi'] = $this->load->view('template/dashboard',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function profile()
	{
		
			$this->data['judul_tab']='Profile';
			$this->data['title']='Profile User';

			$this->data['user']=$this->M_User->getID($this->session->userdata('id_user'));
			$this->data['isi'] = $this->load->view('user/form_profile',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function input()
	{

		$id_user	= $this->input->post('id_user');
		$nama		= $this->input->post('nama');
		$jabatan	= $this->input->post('jabatan');
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');

			$data = array(
				'nama'=>$nama,
				'jabatan'=>$jabatan,
				'username'=>$username,
				'password'=>$password);

		if($id_user==0){	
			if ($this->M_User->insert($data)) {// success
					$this->session->set_flashdata('message', 'Berhasil tambah data');
				}
		}else{
			$data += array(
				'id_user'=>$id_user);
			if ($this->M_User->update($data)) {// success
					$this->session->set_flashdata('message', 'Berhasil Edit data');
				}
		}
					redirect($this->hak_akses.'/page/profile');
			
	}

	public function upload_gambar()
	{
		$id_user	= $this->input->post('id_user');
		$filename = $_FILES['foto']['tmp_name'];
		
		$tipe_file =array('image/png','image/jpeg','image/gif');
		// Content type
		if($_FILES['foto']['tmp_name']){
			//Seleksi Tipe File
			if(!in_array($_FILES['foto']['type'], $tipe_file)){
				$this->session->set_flashdata('message2', 'File Bukan Gambar');
				redirect($this->hak_akses.'/page/profile');
			}

			//Seleksi Ukuran
			if($_FILES['foto']['size']>1000000){	
				$this->session->set_flashdata('message2', 'File Terlalu Besar Max 1 MB');
				redirect($this->hak_akses.'/page/profile');
			}elseif($_FILES['foto']['size']>500000){	
				$percent = 70;
			}else if($_FILES['foto']['size']<500000 ){
				$percent=100;
			}

			if($_FILES['foto']['type']=='image/png'){
				$image = imagecreatefrompng($filename);
				imagejpeg($image, 'image.jpg', $percent);
				$foto=base64_encode(file_get_contents(base_url().'image.jpg'));
			}else if($_FILES['foto']['type']=='image/gif'){
				$image = imagecreatefromgif($filename);
				imagejpeg($image, 'image.jpg', $percent);
				$foto=base64_encode(file_get_contents(base_url().'image.jpg'));
			}elseif($_FILES['foto']['type']=='image/jpeg'){
				if($_FILES['foto']['size']>500000){	
					$percent=0.3;
				}else if($_FILES['foto']['size']<500000 ){
					$percent=1;
				}
				
				$src = imagecreatefromjpeg($filename);        
				list($width, $height) = getimagesize($filename); 

				$tmp = imagecreatetruecolor($width*$percent, $height*$percent); 
				imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width*$percent, $height*$percent, $width, $height);

				imagejpeg($tmp, 'image.jpg', 100);
				$foto=base64_encode(file_get_contents(base_url().'image.jpg'));
			}
			
			$data = array(
			'id_user'=>$id_user,
			'foto'=>$foto);

			if ($this->M_User->update($data)) {// success
					$this->session->set_flashdata('message', 'Berhasil Edit data');
					redirect($this->hak_akses.'/page/profile');
				}
		}
	}

}
