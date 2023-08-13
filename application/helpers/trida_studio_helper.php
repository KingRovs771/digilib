<?php

// Membatasi akses login berdasar level user
if (! function_exists('validasi_login'))
{
	function validasi_login($rule = 0)
	{
		$CI =& get_instance();
		if ($CI->session->userdata('login') == TRUE) {
			if ($CI->session->userdata('status') == '1') {
				// Developer
				if ($rule == '0') {
					if ($CI->session->userdata('level') == '0') {
						return TRUE;
					} else {
						redirect('admin','refresh');
					}
				// Admin website
				} else if ($rule == '1') {
					if ($CI->session->userdata('level') == '1' || $CI->session->userdata('level') == '0') {
						return TRUE;
					} else {
						redirect('admin','refresh');
					}
				// Editor website
				} else if ($rule == '2') {
					if ($CI->session->userdata('level') == '2' || $CI->session->userdata('level') == '1' || $CI->session->userdata('level') == '0') {
						return TRUE;
					} else {
						redirect('admin','refresh');
					}
				} else {
					redirect('beranda','refresh');
				}
			} else {
				$CI->session->set_flashdata('login',
					'<div class="alert alert-danger" role="alert">
						Akun belum aktif!
					</div>'
				);
				redirect('login','refresh');
			}
		} else {
			$CI->session->set_flashdata('login',
				'<div class="alert alert-danger" role="alert">
					Silahkan login terlebih dahulu!
				</div>'
			);
			redirect('login','refresh');
		}
	}
}

// Mengambil data dari tabel pengguna berdasar id
if (! function_exists('identitas')) {
	function identitas($id = '') {
		$CI =& get_instance();
		$CI->db->where('id', $id);
		return $CI->db->get('pengguna')->row();
	}
}

if (! function_exists('customer')) {
	function customer() {
		$data = [
			'nama'	=> 'SMPIT Nur Hidayah',
			'aplikasi'	=> 'DIGILIB',
			'versi'	=> '1.1.0',
			'logo' => 'logo.jpg',
			'favicon' => '',
		];
		return $data;
	}
}

if (! function_exists('tanggal_indonesia')) {
    function tanggal_indonesia($tgl = '') {
        if ($tgl != '' && $tgl != '0000-00-00') {
					switch (date('m', strtotime($tgl))) {
	            case '01':
	                $bulan = 'Januari';
	                break;
	            case '02':
	                $bulan = 'Februari';
	                break;
	            case '03':
	                $bulan = 'Maret';
	                break;
	            case '04':
	                $bulan = 'April';
	                break;
	            case '05':
	                $bulan = 'Mei';
	                break;
	            case '06':
	                $bulan = 'Juni';
	                break;
	            case '07':
	                $bulan = 'Juli';
	                break;
	            case '08':
	                $bulan = 'Agustus';
	                break;
	            case '09':
	                $bulan = 'September';
	                break;
	            case '10':
	                $bulan = 'Oktober';
	                break;
	            case '11':
	                $bulan = 'November';
	                break;
	            case '12':
	                $bulan = 'Desember';
	                break;

	            default:
	                $bulan = 'Tidak diketahui';
	                break;
	        }

	        $tanggal_indonesia = date('d', strtotime($tgl)).' '.$bulan.' '.date('Y', strtotime($tgl));
	        return $tanggal_indonesia;
        } else {
        	return 'Tidak diketahui';
        }

    }
}

if (! function_exists('get_anggota_by_id_pengguna')) {
	function get_anggota_by_id_pengguna($id = '')
    {
		$CI =& get_instance();
        $CI->db->select('pengguna.id AS no_anggota, anggota.nama_depan AS nama_depan, anggota.nama_belakang AS nama_belakang, pengguna.status AS status, pengguna.username AS username, pengguna.password');
        $CI->db->from('pengguna');
        $CI->db->where('pengguna.id', $id);
        $CI->db->join('anggota', 'pengguna.id_anggota = anggota.id', 'left');
		
    }
}