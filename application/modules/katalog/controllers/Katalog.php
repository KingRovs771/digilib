<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Katalog extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Katalog_model', 'katalog');

  }

  public function index()
  {
      $data = [
          'main'	=> 'katalog',
      ];
      $this->load->view('template/template', $data);
  }

  public function get_data()
	{
		$list = $this->katalog->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = character_limiter($field->judul, 65);
			$row[] = character_limiter($field->penulis, 20);
			$row[] = character_limiter($field->tahun_terbit, 4);
			$row[] = character_limiter($field->penerbit, 15);
			$row[] = $field->id;
			$data[] = $row;
		}

		$output = array(
			"draw"              => $_POST['draw'],
			"recordsTotal"      => $this->katalog->count_all(),
			"recordsFiltered"   => $this->katalog->count_filtered(),
			"data"              => $data,
		);
		echo json_encode($output);
	}

	public function simpan()
	{
		$this->rules();
		if ($this->form_validation->run() == TRUE) {
			$cek_no_anggota = $this->katalog->cek_no_anggota($this->input->post('no_anggota'));
			if ($cek_no_anggota) {
				// katalog dibatasi atau tidak? konfirmasi dulu!
				// $katalog = $this->katalog->cek_katalog($this->input->post('no_anggota'));
				$data = [
					'id_anggota' => $cek_no_anggota->id,
					'tanggal'	=> date('Y-m-d'),
					'waktu'	=> date("H:i:s", time()),
				];
				$this->katalog->insert($data);
				$this->session->set_flashdata('katalog',
					'<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-check"></i> Asslamu\'alaikum <strong>'.$cek_no_anggota->nama_depan.'</strong>!</h5>
						Selamat datang di perpustakaan SMPIT Nur Hidayah. Selamat Belajar!
					</div>'
				);
				redirect('katalog', 'refresh');
			} else {
				$this->session->set_flashdata('katalog',
					'<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
						Data tidak ditemukan! Pastikan Anda menginputkan nomor anggota Anda dengan benar.
					</div>'
				);
				$this->index();
			}
		} else {
			$this->session->set_flashdata('katalog',
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
		$this->form_validation->set_rules('no_anggota', '', 'trim|required', [
        'required' => 'Kolom ini <strong>harus diisi!</strong>',
    ]);
    $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
	}
}
