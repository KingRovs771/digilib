<?php
// Informasi
if (! function_exists('web_info')) {
	function web_info() {
		$CI =& get_instance();
		$web_info = [
			'title'         		=> 'Neobadala',
			'tagline'				=> 'Vendor Hangtag Solo',
			'description'			=> 'vendro hangtag solo, produsen packaging solo,',
			'logo_admin'			=> base_url('assets/admin/images/default/logo-admin.jpg'),
			'favicon_admin'			=> base_url('assets/admin/images/default/logo-admin.jpg'),
			'no_image'				=> '',
		];
		return $web_info;
	}
}

// Memanggil kategori dengan dibatasi limit 7
if (! function_exists('get_home_kategori_produk')) {
	function get_home_kategori_produk() {
		$CI =& get_instance();
		return $CI->db->get('kategori_produk', 7)->result();
	}
}

if (! function_exists('get_home_produk')) {
	function get_home_produk($limit = 0) {
		$CI =& get_instance();
		return $CI->db->get('produk', $limit)->result();
	}
}

if (! function_exists('get_home_galeri')) {
	function get_home_galeri($limit = 0) {
		$CI =& get_instance();
		return $CI->db->get('galeri', $limit)->result();
	}
}

if (! function_exists('get_home_testimoni')) {
	function get_home_testimoni($limit = 0) {
		$CI =& get_instance();
		return $CI->db->get('testimoni', $limit)->result();
	}
}

if (! function_exists('get_home_neoinsight')) {
	function get_home_neoinsight($limit = 0) {
		$CI =& get_instance();
		$CI->db->order_by('id', 'desc');
		return $CI->db->get('neoinsight', $limit)->result();
	}
}


// produk
if (! function_exists('get_kategori_produk')) {
	function get_kategori_produk($limit = '') {
		$CI =& get_instance();
		return $CI->db->get('kategori_produk', $limit)->result();
	}
}

if (! function_exists('get_author')) {
	function get_author($id_pengguna = '') {
		$CI =& get_instance();
		return $CI->db->get_where('pengguna', ['id' => $id_pengguna])->row();
	}
}

if (! function_exists('get_kategori_neoinsight')) {
	function get_kategori_neoinsight($limit = 0) {
		$CI =& get_instance();
		return $CI->db->get('kategori', $limit)->result();
	}
}

if (! function_exists('get_jumlah_post_kategori_neoinsight')) {
	function get_jumlah_post_kategori_neoinsight($id_kategori = '') {
		$CI =& get_instance();
		$sql = "SELECT * FROM `neoinsight` WHERE find_in_set(".$id_kategori.", `id_kategori`)";
		return $CI->db->query($sql)->num_rows();
	}
}
