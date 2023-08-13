<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kunjungan extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Kunjungan_model', 'kunjungan');
	date_default_timezone_set('Asia/Jakarta');
	validasi_login(1);
  }

  public function index()
  {
      $data = [
          'main'	=> 'kunjungan/data',
      ];
      $this->load->view('template/layout', $data);
  }

  public function get_data_kehadiran()
	{
		$list = $this->kunjungan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();

			$row[] = $no;

			$row[] = tanggal_indonesia($field->tanggal);
			$row[] = $field->nama;
			$row[] = $field->nis_nipy;
			$row[] = $field->waktu;
			$row[] = $field->id_kunjungan;
			$data[] = $row;
		}

		$output = array(
			"draw"              => $_POST['draw'],
			"recordsTotal"      => $this->kunjungan->count_all(),
			"recordsFiltered"   => $this->kunjungan->count_filtered(),
			"data"              => $data,
		);
		echo json_encode($output);
	}

	public function simpan()
	{
		$this->rules();
		if ($this->form_validation->run() == TRUE) {
			$nis_nipy = $this->kunjungan->cek_nis_nipy($this->input->post('nis_nipy'));
			if ($nis_nipy) {
				$kunjungan = $this->kunjungan->cek_kunjungan($this->input->post('nis_nipy'));
				$tanggal_sekarang = date('Y-m-d');
				
				if($kunjungan && $kunjungan->tanggal == $tanggal_sekarang){
					$this->session->set_flashdata('kunjungan',
						'<div class="alert alert-warning alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h5><i class="icon fas fa-exclamation-triangle"></i> Hai, <strong>'.$nis_nipy->nama.'</strong>!</h5>
							Anda sudah mengisi form kehadiran, Teramkasih atas kunjungannya dan selamat belajar.
						</div>'
					);
					$this->index();
				} else {
					$data = [
						'id_anggota' => $nis_nipy->id,
						'tanggal'	=> date('Y-m-d'),
						'waktu'	=> date("H:i:s", time()),
					];
					$this->kunjungan->insert($data);
					$this->session->set_flashdata('kunjungan',
						'<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-check"></i> Asslamu\'alaikum <strong>'.$nis_nipy->nama.'</strong>!</h5>
						Selamat datang di perpustakaan SMPIT Nur Hidayah. Selamat Belajar!
						</div>'
					);
					redirect('kunjungan', 'refresh');
				}
			} else {
				$this->session->set_flashdata('kunjungan',
					'<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
						Data tidak ditemukan! Pastikan Anda menginputkan nomor anggota Anda dengan benar.
					</div>'
				);
				$this->index();
			}
		} else {
			$this->session->set_flashdata('kunjungan',
				'<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
					Silahkan isi data dengan benar!
				</div>'
			);
			$this->index();
		}
		
	}

	public function rules()
	{
		$this->form_validation->set_rules('nis_nipy', '', 'trim|required', [
        'required' => 'Kolom ini <strong>harus diisi!</strong>',
    ]);
    $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
	}
}
