<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function jumlah_buku()
	{
		$this->db->select('SUM(jumlah) AS jumlah_buku');
		return $this->db->get('buku')->row();
	}
	
	public function jumlah_judul_buku()
	{
		return $this->db->get('buku')->num_rows();
	}

	public function jumlah_buku_terpinjam()
	{
		return $this->db->get_where('peminjaman', ['kembali' => 'N'])->num_rows();
	}

	public function jumlah_buku_tersedia()
	{
		$this->db->select('SUM(jumlah) AS jumlah_buku');
		$jumlah_buku = $this->db->get('buku')->row()->jumlah_buku;

		$jumlah_peminjaman = $this->db->get_where('peminjaman', ['kembali' => 'N'])->num_rows();

		return $buku_tersedia = ($jumlah_buku - $jumlah_peminjaman);
	}

	public function jumlah_anggota()
	{
		return $this->db->get('anggota')->num_rows();
	}

	public function jumlah_anggota_karyawan () {
		return $this->db->get_where('anggota', ['jenis_anggota' => '0'])->num_rows();
	}
	public function jumlah_anggota_kelas7 () {
		return $this->db->get_where('anggota', ['jenis_anggota' => '7'])->num_rows();
	}
	public function jumlah_anggota_kelas8 () {
		return $this->db->get_where('anggota', ['jenis_anggota' => '8'])->num_rows();
	}
	public function jumlah_anggota_kelas9 () {
		return $this->db->get_where('anggota', ['jenis_anggota' => '9'])->num_rows();
	}


}
