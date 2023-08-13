<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peminjaman extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		validasi_login(1);
		$this->load->model('Peminjaman_model', 'peminjaman');
	}

	public function index()
	{
		$data = [
			'main'  => 'peminjaman/data',
		];
		$this->load->view('template/layout', $data);
	}

	public function get_data()
	{
		$list = $this->peminjaman->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = tanggal_indonesia($field->tanggal_pinjam);
			$row[] = $field->nama_anggota;
			$row[] = character_limiter($field->judul_buku, 30);
			$row[] = tanggal_indonesia($field->tanggal_kembali);
			$row[] = $field->nama_admin;
			$row[] = $field->id_peminjaman;
			$data[] = $row;
		}

		$output = array(
			"draw"              => $_POST['draw'],
			"recordsTotal"      => $this->peminjaman->count_all(),
			"recordsFiltered"   => $this->peminjaman->count_filtered(),
			"data"              => $data,
		);
		echo json_encode($output);
	}

	public function simpan()
	{
		$this->rules();
		if ($this->form_validation->run() == TRUE) {
			// Memeriksa apakah anggota tersebut sudah memiliki pinjaman sebelumnya?
			$pinjam = $this->peminjaman->get_peminjaman_by_id_anggota($this->input->post('nis_nipy'));
			if ($pinjam->num_rows() >= 2) {
				// Jika anggota tersebut memiliki pinjaman lebih dari 2, maka tidak diijinkan meminjam lagi sebelum pinjaman sebelumnya dikembalikan
				$this->session->set_flashdata('peminjaman',
					'<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
						Maaf, Anggota tersebut memiliki pinjaman 2 buku yang belum dikembalikan.
					</div>'
				);
				$this->index();
			} else if ($pinjam->row() && $pinjam->row()->isbn == $this->input->post('isbn')) {
				// Memeriksa apakah judul buku yang dipinjam sekarang, masih sama dengan yang masih dipinjam? Jika sama, maka tidak diijinkan!
				$this->session->set_flashdata('peminjaman',
					'<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
						Maaf, Anggota tersebut masih meminjam judul buku yang sama sebelumnya.
					</div>'
				);
				$this->index();
			} else {
				// Jika anggota tidak memiliki pinjaman atau memiliki pinjaman kurang dari 2 buku maka diijinkan meminjam
				$tanggal_pinjam = date_create($this->input->post('tanggal_pinjam')); 
				date_add($tanggal_pinjam, date_interval_create_from_date_string("7 days")); 
				$tanggal_kembali = date_format($tanggal_pinjam, "Y-m-d");

				if ($this->session->userdata('id')) {
					$id_pengguna = $this->session->userdata('id');
				} else {
					$id_pengguna = 0;
				}

				// mencari id buku berdasar isbn
				$cek_id_anggota = $this->peminjaman->get_id_by_nis_nipy($this->input->post('nis_nipy'));
				if (condition) {
					# code...
				} else {
					# code...
				}
				
				// mencari id anggota berdasar nis_nipy
				
				$data = [
					'id_anggota'  => $this->input->post('id_anggota'),
					'id_buku'  => $this->input->post('id_buku'),
					'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
					'tanggal_kembali'  => $tanggal_kembali,
					'id_pengguna'	=> $id_pengguna,
				];
				$this->peminjaman->insert($data);
				$this->session->set_flashdata('peminjaman',
					'<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-check"></i> Berhasil!</h5>
						Data berhasil ditambahkan!
					</div>'
				);
				redirect('admin/peminjaman', 'refresh');
			}
		} else {
			$this->session->set_flashdata('peminjaman',
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
		$row = $this->peminjaman->get_by_id($id);
		if ($row) {
			$data = [
				'id'	=> set_value('id', $row->id),
                'tanggal_pinjam' => set_value('tanggal_pinjam', $row->tanggal_pinjam),
				'url'				=> site_url('admin/peminjaman/update'),
				'main'  			=> 'peminjaman/form',
			];
			$this->load->view('template/layout', $data);
		} else {
			$this->session->set_flashdata('peminjaman',
				'<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
					Data tidak ditemukan!
				</div>'
			);
			redirect('peminjaman', 'refresh');
		}
	}

	public function update()
	{
		$this->rules();
		if ($this->form_validation->run() == TRUE) {
			
			$tanggal_pinjam = date_create($this->input->post('tanggal_pinjam')); 
			date_add($tanggal_pinjam, date_interval_create_from_date_string("7 days")); 
			$tanggal_kembali = date_format($tanggal_pinjam, "Y-m-d");

			if ($this->session->userdata('id')) {
				$id_pengguna = $this->session->userdata('id');
			} else {
				$id_pengguna = 0;
			}
			
			$data = [
                'id_anggota'  => $this->input->post('id_anggota'),
                'id_buku'  => $this->input->post('id_buku'),
                'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
                'tanggal_kembali'  => $tanggal_kembali,
				'id_pengguna'	=> $id_pengguna,
			];
			$this->peminjaman->update($this->input->post('id'), $data);
			$this->session->set_flashdata('peminjaman',
				'<div class="alert bg-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-check"></i> Berhasil!</h5>
					Data berhasil diperbaharui!
				</div>'
			);
			redirect('admin/peminjaman', 'refresh');
		} else {
			$this->session->set_flashdata('peminjaman',
				'<div class="alert bg-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
					Data tidak dapat diperbaharui! Pastikan Anda mengisi data dengan benar.
				</div>'
			);
			$this->edit($this->input->post('id'));
		}
	}

	public function hapus($id)
	{
		$row = $this->peminjaman->get_by_id($id);
		if ($row) {
			$this->peminjaman->delete($row->id);
			echo "berhasilDihapus";
		}

	}

	public function riwayat()
	{
		$data = [
			'main'  => 'peminjaman/data',
		];
		$this->load->view('template/layout', $data);
	}

	public function get_data_anggota()
	{
		$inputan = $this->input->get('q');

			$hasil = [
				'code' => 200,
				'status' => 'OK',
				'data' => $this->peminjaman->get_data_anggota($inputan),
			];
			echo json_encode($hasil);
	}

	public function get_data_buku()
	{
		$inputan = $this->input->get('q');

			$hasil = [
				'code' => 200,
				'status' => 'OK',
				'data' => $this->peminjaman->get_data_buku($inputan),
			];
			echo json_encode($hasil);
	}

	public function get_anggota_by_id_peminjaman($id_peminjaman = '')
    {
        if ($this->peminjaman->get_anggota_by_id_peminjaman($id_peminjaman)) {
            $id_anggota = $this->peminjaman->get_anggota_by_id_peminjaman($id_peminjaman)->id;
            $nama_anggota = $this->peminjaman->get_anggota_by_id_peminjaman($id_peminjaman)->nama;
        } else {
            $id_anggota   = '';
            $nama_anggota = 'Tidak ditemukan!';
        }

        $data = [
            'id'              => $id_anggota,
            'nama'            => $nama_anggota,
        ];
        echo json_encode($data);
    }

	public function get_buku_by_id_peminjaman($id_peminjaman = '')
    {
        if ($this->peminjaman->get_buku_by_id_peminjaman($id_peminjaman)) {
            $id_buku = $this->peminjaman->get_buku_by_id_peminjaman($id_peminjaman)->id;
            $judul_buku = $this->peminjaman->get_buku_by_id_peminjaman($id_peminjaman)->judul;
        } else {
            $id_buku   = '';
            $judul_buku = 'Tidak ditemukan!';
        }

        $data = [
            'id'              => $id_buku,
            'judul'            => $judul_buku,
        ];
        echo json_encode($data);
    }

	// public function data_input($id_anggota = NULL, $id_buku = NULL)
	// {
	// 	if ($this->peminjaman->get_anggota_by_id($id_anggota)) {
    //         $nama_anggota = $this->peminjaman->get_anggota_by_id($id_anggota)->nama;
    //     } else {
    //         $nama_anggota = 'Tidak diketahui';
    //     }
		
	// 	if ($this->peminjaman->get_buku_by_id($id_buku)) {
    //         $judul_buku = $this->peminjaman->get_buku_by_id($id_buku)->judul;
    //     } else {
    //         $judul_buku = 'Tidak diketahui';
    //     }

	// 	$data = [
    //         'id_anggota'              => $id_anggota,
	// 		'nama_anggota'			=> $nama_anggota,
    //         'id_buku'            => $id_buku,
    //         'judul_buku'            => $judul_buku,
    //     ];
    //     echo json_encode($data);
	// }

	public function rules()
	{
		$this->form_validation->set_rules('id_anggota', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
        $this->form_validation->set_rules('id_buku', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
        $this->form_validation->set_rules('tanggal_pinjam', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
	}
}
