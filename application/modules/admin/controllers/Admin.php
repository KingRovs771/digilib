<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		validasi_login(1);
		$this->load->model('Admin_model', 'admin');
	}

	public function index()
	{
		if ($this->admin->jumlah_buku()) {
			$jumlah_buku = $this->admin->jumlah_buku()->jumlah_buku;
		} else {
			$jumlah_buku = 0;
		}
		
		$data = [
			'jumlah_buku' 	=> $jumlah_buku,
			'jumlah_judul_buku' 	=> $this->admin->jumlah_judul_buku(),
			'jumlah_buku_terpinjam' 	=> $this->admin->jumlah_buku_terpinjam(),
			'jumlah_buku_tersedia' 	=> $this->admin->jumlah_buku_tersedia(),
			'jumlah_anggota' 	=> $this->admin->jumlah_anggota(),
			'jumlah_anggota_karyawan'	=> $this->admin->jumlah_anggota_karyawan(),
			'jumlah_anggota_kelas7'	=> $this->admin->jumlah_anggota_kelas7(),
			'jumlah_anggota_kelas8'	=> $this->admin->jumlah_anggota_kelas8(),
			'jumlah_anggota_kelas9'	=> $this->admin->jumlah_anggota_kelas9(),
			'main' 	=> 'template/part/main/dashboard',
		];
		$this->load->view('template/layout', $data);
	}

}
