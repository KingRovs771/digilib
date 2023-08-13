<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Katalog extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		validasi_login(1);
		$this->load->model('Katalog_model', 'katalog');
	}

	public function index()
	{
		$data = [
			'main'  => 'katalog/data',
		];
		$this->load->view('template/layout', $data);
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
			$row[] = $field->judul;
			$row[] = $field->penulis;
			$row[] = $field->tahun_terbit;
			$row[] = $field->penerbit;
			$row[] = $field->jumlah;
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

	public function tambah()
	{
		$data = [
			'judul' => set_value('judul'),
			'penulis' => set_value('penulis'),
			'isbn' => set_value('isbn'),
			'tahun_terbit' => set_value('tahun_terbit'),
			'tempat_terbit' => set_value('tempat_terbit'),
			'penerbit' => set_value('penerbit'),
			'jumlah' => set_value('jumlah'),
			'klasifikasi' => set_value('klasifikasi'),
			'url'			=> site_url('admin/katalog/simpan'),
			'main'  		=> 'katalog/form',
		];
		$this->load->view('template/layout', $data);
	}

	public function simpan()
	{
		$this->rules();
		if ($this->form_validation->run() == TRUE) {
			$isbn = $this->katalog->cek_isbn($this->input->post('isbn'));
			if ($isbn) {
				$this->session->set_flashdata('katalog',
					'<div class="alert alert-warning alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
						Data dengan ISBN tersebut sudah ada. Pastikan Anda mengisikan ISBN yang benar!
					</div>'
				);
				$this->tambah();
			} else {
				$id_terbesar = $this->katalog->get_id_terakhir();
				if ($id_terbesar) {
					$nomor = strval($id_terbesar->id + 1);
					$no_buku = sprintf("%03d", $nomor);
				} else {
					$nomor = strval(1);
					$no_buku = sprintf("%03d", $nomor);
				}
				
				$this->load->library('Ciqrcode');
				$params['data'] = $no_buku;
				$params['level'] = 'H';
				$params['size'] = 10;
				$params['savename'] = './assets/admin/images/qr-code/buku/'.$no_buku.'.png';
				$this->ciqrcode->generate($params);
				
				$data = [
					'no_buku'	=> $no_buku,
					'judul' => $this->input->post('judul'),
					'penulis' => $this->input->post('penulis'),
					'isbn' => $this->input->post('isbn'),
					'tahun_terbit' => $this->input->post('tahun_terbit'),
					'tempat_terbit' => $this->input->post('tempat_terbit'),
					'penerbit' => $this->input->post('penerbit'),
					'jumlah' => $this->input->post('jumlah'),
					'klasifikasi' => $this->input->post('klasifikasi'),
				];
				$this->katalog->insert($data);
				$this->session->set_flashdata('katalog',
					'<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-check"></i> Berhasil!</h5>
						Data berhasil ditambahkan!
					</div>'
				);
				redirect('admin/katalog', 'refresh');
			}
			
		} else {
			$this->session->set_flashdata('katalog',
				'<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
					Data gagal ditambahkan! Pastikan Anda mengisi data dengan benar.
				</div>'
			);
			$this->tambah();
		}

	}

	public function edit($id = '')
	{
		$row = $this->katalog->get_by_id($id);
		if ($row) {
			$data = [
				'id' => set_value('id', $row->id),
				'judul' => set_value('judul', $row->judul),
				'penulis' => set_value('penulis', $row->penulis),
				'isbn' => set_value('isbn', $row->isbn),
				'tahun_terbit' => set_value('tahun_terbit', $row->tahun_terbit),
				'tempat_terbit' => set_value('tempat_terbit', $row->tempat_terbit),
				'penerbit' => set_value('penerbit', $row->penerbit),
				'jumlah' => set_value('jumlah', $row->jumlah),
				'klasifikasi' => set_value('klasifikasi', $row->klasifikasi),
				'url'				=> site_url('admin/katalog/update'),
				'main'  			=> 'katalog/form',
			];
			$this->load->view('template/layout', $data);
		} else {
			$this->session->set_flashdata('katalog',
				'<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
					Data tidak ditemukan!
				</div>'
			);
			redirect('admin/katalog/', 'refresh');
		}
	}

	public function update()
	{
		$this->rules();
		if ($this->form_validation->run() == TRUE) {
			$isbn_dan_id = $this->katalog->cek_isbn_dan_id($this->input->post('id'), $this->input->post('isbn'));
			if ($isbn_dan_id) {
				$this->session->set_flashdata('katalog',
					'<div class="alert alert-warning alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
						Data dengan ISBN tersebut sudah ada. Pastikan Anda mengisikan ISBN yang benar!
					</div>'
				);
				$this->edit($this->input->post('id'));
			} else {
				$nomor = strval($this->input->post('id'));
				$no_buku = sprintf("%03d", $nomor);

				$row = $this->katalog->get_by_id($this->input->post('id'));
				if ($row && $row->no_buku && file_exists('./assets/admin/images/qr-code/buku/'.$no_buku.'.png')) {
					unlink('./assets/admin/images/qr-code/buku/'.$no_buku.'.png');
				}

				$this->load->library('Ciqrcode');
				$params['data'] = $no_buku;
				$params['level'] = 'H';
				$params['size'] = 10;
				$params['savename'] = './assets/admin/images/qr-code/buku/'.$no_buku.'.png';
				$this->ciqrcode->generate($params);

				$data = [
					'no_buku'	=> $no_buku,
					'judul' => $this->input->post('judul'),
					'penulis' => $this->input->post('penulis'),
					'isbn' => $this->input->post('isbn'),
					'tahun_terbit' => $this->input->post('tahun_terbit'),
					'tempat_terbit' => $this->input->post('tempat_terbit'),
					'penerbit' => $this->input->post('penerbit'),
					'jumlah' => $this->input->post('jumlah'),
					'klasifikasi' => $this->input->post('klasifikasi'),
				];
				$this->katalog->update($this->input->post('id'), $data);
				$this->session->set_flashdata('katalog',
					'<div class="alert bg-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-check"></i> Berhasil!</h5>
						Data berhasil diperbaharui!
					</div>'
				);
				// die();
				redirect('admin/katalog', 'refresh');
			}
		} else {
			$this->session->set_flashdata('katalog',
				'<div class="alert bg-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
					Data gagal diperbaharui! Pastikan Anda mengisi data dengan benar.
				</div>'
			);
			$this->edit($this->input->post('id'));
		}
	}

	public function hapus($id)
	{
		$row = $this->katalog->get_by_id($id);
		if ($row) {
			if ($row && $row->no_buku && file_exists('./assets/admin/images/qr-code/buku/'.$row->no_buku.'.png')) {
				unlink('./assets/admin/images/qr-code/buku/'.$row->no_buku.'.png');
			}
			$this->katalog->delete($row->id);
			$this->session->set_flashdata('katalog',
				'<div class="alert bg-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-check"></i> Berhasil!</h5>
					katalog berhasil dihapus!
				</div>'
			);
			echo "berhasilDihapus";
		}
	}

	public function cetak_label($id = NULL)
	{
		$row = $this->katalog->get_by_id($id);
		if ($row) {
			$data = [
				'no_buku'				     => $row->no_buku,
				'judul'				     => $row->judul,
				'isbn'				   => $row->isbn,
				'klasifikasi'	=> $row->klasifikasi,
				'penulis'	=> $row->penulis,
				'jumlah'	=> $row->jumlah,
			];
			$this->load->view('katalog/label-barcode', $data);
		} else {
			$this->session->set_flashdata('katalog',
				'<div class="alert bg-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
					Data tidak ditemukan!
				</div>'
			);
			redirect('admin/katalog', 'refresh');
		}
	}

	public function rules()
	{
		$this->form_validation->set_rules('judul', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_rules('penulis', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_rules('isbn', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_rules('tahun_terbit', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_rules('tempat_terbit', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_rules('penerbit', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_rules('jumlah', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_rules('klasifikasi', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
	}
}
