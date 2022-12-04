<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index()
	{
		
		$this->data['judul_tab'] = 'KLINIK PKU MUHAMMADIYAH GANDRUNGMANGU';
		$this->data['isi'] = $this->load->view('template/dashboard_user',$this->data,TRUE);
		$this->load->view('template/v_layout_user', $this->data);
	}
	public function login()
	{
		$this->data['judul_tab'] = 'Login';

		$this->load->view('login', $this->data);
	}
	public function sejarah()
	{
		$this->data['judul_tab'] = 'Sejarah';
		$this->data['isi'] = $this->load->view('penunjung/sejarah',$this->data,TRUE);
		$this->load->view('template/v_layout_user', $this->data);
	}
	
	public function visi_misi()
	{
		$this->data['judul_tab'] = 'Visi, Misi & Tujuan';
		$this->data['isi'] = $this->load->view('penunjung/visi_misi',$this->data,TRUE);
		$this->load->view('template/v_layout_user', $this->data);
	}
	public function kontak()
	{
		$this->data['judul_tab'] = 'Kontak';
		$this->data['isi'] = $this->load->view('penunjung/kontak',$this->data,TRUE);
		$this->load->view('template/v_layout_user', $this->data);
	}
	public function jadwal_dokter()
	{
		$this->data['judul_tab'] = 'Jadwal Dokter';
		$this->data['isi'] = $this->load->view('penunjung/jadwal_dokter',$this->data,TRUE);
		$this->load->view('template/v_layout_user', $this->data);
	}
	public function jam_layanan()
	{
		$this->data['judul_tab'] = 'Jam Layanan';
		$this->data['isi'] = $this->load->view('penunjung/jam_layanan',$this->data,TRUE);
		$this->load->view('template/v_layout_user', $this->data);
	}
	public function berita()
	{
		$this->data['judul_tab'] = 'Berita';
		$this->data['isi'] = $this->load->view('penunjung/berita',$this->data,TRUE);
		$this->load->view('template/v_layout_user', $this->data);
	}
	public function detail_berita()
	{
		$this->data['judul_tab'] = 'Berita';
		$this->data['isi'] = $this->load->view('penunjung/detail_berita',$this->data,TRUE);
		$this->load->view('template/v_layout_user', $this->data);
	}
	public function fasilitas()
	{
		$this->data['judul_tab'] = 'Fasilitas Pelayanan';
		$this->data['isi'] = $this->load->view('penunjung/fasilitas',$this->data,TRUE);
		$this->load->view('template/v_layout_user', $this->data);
	}
	public function alur_pemeriksaan()
	{
		$this->data['judul_tab'] = 'Alur Pemeriksaan';
		$this->data['isi'] = $this->load->view('penunjung/alur_pemeriksaan',$this->data,TRUE);
		$this->load->view('template/v_layout_user', $this->data);
	}
	public function struktur()
	{
		$this->data['judul_tab'] = 'Struktur Kepegawaian';
		$this->data['isi'] = $this->load->view('penunjung/struktur',$this->data,TRUE);
		$this->load->view('template/v_layout_user', $this->data);
	}
}
