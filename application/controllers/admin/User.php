<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	var $hak_akses='admin';
	var $link='user';
	// var $list= $this->list.'/index';
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
		$this->data['judul_tab']='Data User';
		$this->data['title']='Data User';
		$this->data['dokter']=$this->M_User->hak_akses('dokter');
		$this->data['resepsionis']=$this->M_User->hak_akses('resepsionis');
		$this->data['perawat']=$this->M_User->hak_akses('perawat');
		$this->data['admin']=$this->M_User->hak_akses('admin');
		$this->data['isi'] = $this->load->view($this->link.'/index',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}

	public function form($id)
	{
		// $data['barang']= $this->Model_Barang->getAllBarang();
			$this->data['id']=$id;
		if($id==0){	
			$this->data['judul_tab']='Form Tambah User';
			$this->data['title']='Tambah User';
		}else{

			$this->data['judul_tab']='Form Edit User';
			$this->data['title']='Edit User';

			$this->data['user']=$this->M_User->getID($id);
			// $id= $this->form_validation->set_value('id');
			// $nama_barang= $this->form_validation->set_value('nama_barang');
		}
			$this->data['isi'] = $this->load->view($this->link.'/form',$this->data,TRUE);

		$this->load->view('template/v_layout_utama',$this->data);
	}
	public function input()
	{

		$id_user	= $this->input->post('id_user');
		$nama		= $this->input->post('nama');
		$jabatan	= $this->input->post('jabatan');
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');
		$hak_akses	= $this->input->post('hak_akses');

			$data = array(
				'nama'=>$nama,
				'jabatan'=>$jabatan,
				'username'=>$username,
				'password'=>$password,
				'hak_akses'=>$hak_akses);

		if($id_user==0){	
			if ($this->M_User->insert($data)) {// success
					$this->session->set_flashdata('message', 'Berhasil tambah data');
					redirect($this->hak_akses.'/'.$this->link);
				}
		}else{
			$data += array(
				'id_user'=>$id_user);
			if ($this->M_User->update($data)) {// success
					$this->session->set_flashdata('message', 'Berhasil Edit data');
					redirect($this->hak_akses.'/'.$this->link);
				}
		}
			
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
					redirect($this->hak_akses.'/'.$this->link);
			}

			//Seleksi Ukuran
			if($_FILES['foto']['size']>1000000){	
				$this->session->set_flashdata('message2', 'File Terlalu Besar Max 1 MB');
				redirect($this->hak_akses.'/'.$this->link);
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
					redirect($this->hak_akses.'/'.$this->link);
				}
		}
		

	}
	public function tampil_gambar($id)
	{
		$data=$this->M_User->getID($id);
		print base64_decode($data->foto);
	}
	public function hapus($id)
	{
		$this->M_User->delete($id);
		redirect($this->hak_akses.'/'.$this->link);
	}
	public function kartu($id)
	{
		$this->data['judul_tab']='Cetak Kartu';
			$this->data['pasien']=$this->M_Pasien->getID($id);

			$this->load->view('pasien/kartu',$this->data);
	}

}