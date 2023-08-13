<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anggota extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		validasi_login(1);
		$this->load->model('Anggota_model', 'anggota');
	}

	public function index()
	{
		$data = [
			'main'  => 'anggota/data',
		];
		$this->load->view('template/layout', $data);
	}

	public function get_data()
	{
		$list = $this->anggota->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();

			$row[] = '<input type="checkbox">';
			$row[] = $no;
			
			$row[] = $field->nama;
			$row[] = $field->nis_nipy;
			$row[] = tanggal_indonesia($field->tanggal_daftar);
			$row[] = $field->id;
			$data[] = $row;
		}

		$output = array(
			"draw"              => $_POST['draw'],
			"recordsTotal"      => $this->anggota->count_all(),
			"recordsFiltered"   => $this->anggota->count_filtered(),
			"data"              => $data,
		);
		echo json_encode($output);
	}

	public function tambah()
	{

		$data = [
            'nama'  => set_value('nama'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'nis_nipy'  => set_value('nis_nipy'),
            'jenis_anggota'  => set_value('jenis_anggota'),
            'tanggal_daftar'    => set_value('tanggal_daftar'),
            'foto'  => set_value('foto'),
			'url'			=> site_url('admin/anggota/simpan'),
			'main'  		=> 'anggota/form',
		];
		$this->load->view('template/layout', $data);
	}

	public function simpan()
	{
		$this->rules();
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] 		= './assets/admin/images/anggota/';
			$config['allowed_types']	= 'jpeg|jpg|png';
			$config['max_size']			= 2000;
			$config['encrypt_name'] 	= TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {
				$foto_upload = $this->upload->data();
				$foto = $foto_upload['file_name'];

				// croping images
				$this->load->library('image_lib');

				$image_config['image_library'] = 'gd2';
				$image_config['source_image'] = './assets/admin/images/anggota/'.$foto;
				$image_config['new_image'] = './assets/admin/images/anggota/temp/'.$foto;
				$image_config['quality'] = "100%";
				$image_config['maintain_ratio'] = TRUE;
				// $image_config['width'] = 370;
				$image_config['height'] = 336;
				$this->image_lib->clear();
				$this->image_lib->initialize($image_config);
				$this->image_lib->resize();

				if (is_file('./assets/admin/images/anggota/temp/'.$foto)) {
					unlink('./assets/admin/images/anggota/temp/'.$foto);
				}
			} else {
				$foto = '';
			}

			if ($this->input->post('jenis_anggota') == '7') {
				$tanggal = new DateTime($this->input->post('tanggal_daftar'));
				$tanggal->modify('+1095 day');
				$tanggal_berakhir = $tanggal->format('Y-m-d');
			} else if ($this->input->post('jenis_anggota') == '8') {
				$tanggal = new DateTime($this->input->post('tanggal_daftar'));
				$tanggal->modify('+730 day');
				$tanggal_berakhir = $tanggal->format('Y-m-d');
			} else if ($this->input->post('jenis_anggota') == '9') {
				$tanggal = new DateTime($this->input->post('tanggal_daftar'));
				$tanggal->modify('+365 day');
				$tanggal_berakhir = $tanggal->format('Y-m-d');
			} else {
				$tanggal = new DateTime($this->input->post('tanggal_daftar'));
				$tanggal->modify('+15779 day');
				$tanggal_berakhir = $tanggal->format('Y-m-d');
			}

			$this->load->library('Ciqrcode');
			$params['data'] = $this->input->post('nis_nipy');
			$params['level'] = 'H';
			$params['size'] = 10;
			$params['savename'] = './assets/admin/images/qr-code/anggota/'.$this->input->post('nis_nipy').'.png';
			$this->ciqrcode->generate($params);

			$nis_nipy = $this->anggota->cek_nis_nipy($this->input->post('nis_nipy'));

			if ($nis_nipy) {
				$this->session->set_flashdata('anggota',
					'<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
						Data anggota dengan NIS/NIPY tersebut sudah ada. Pastikan Anda menginput NIS/NIPY berbeda!
					</div>'
				);
				$this->tambah();
			} else {
				$data = [
					'nama'  => ucwords($this->input->post('nama')),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'nis_nipy'  => $this->input->post('nis_nipy'),
					'jenis_anggota'  => $this->input->post('jenis_anggota'),
					'tanggal_daftar'    => $this->input->post('tanggal_daftar'),
					'tanggal_berakhir'  => $tanggal_berakhir,
					'foto'				=> $foto,
				];
				$this->anggota->insert($data);
				$this->session->set_flashdata('anggota',
					'<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h5><i class="icon fas fa-check"></i> Berhasil!</h5>
						Data berhasil ditambahkan!
					</div>'
				);
				redirect('admin/anggota', 'refresh');
			}
		} else {
			$this->session->set_flashdata('anggota',
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
		$row = $this->anggota->get_by_id($id);
		if ($row) {
			$data = [
				'id'  				=> set_value('id', $row->id),
				'nama'  => set_value('nama', $row->nama),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'nis_nipy'  => set_value('nis_nipy', $row->nis_nipy),
				'jenis_anggota'  => set_value('jenis_anggota', $row->jenis_anggota),
                'tanggal_daftar'    => set_value('tanggal_daftar', $row->tanggal_daftar),
                'foto'  => set_value('foto', $row->foto),
				'url'				=> site_url('admin/anggota/update'),
				'main'  			=> 'anggota/form',
			];
			$this->load->view('template/layout', $data);
		} else {
			redirect('admin/anggota/get/'.$this->input->post('type'), 'refresh');
		}
	}

	public function update()
	{
		$this->rules();
		if ($this->form_validation->run() == TRUE) {
			$foto_lama = $this->anggota->get_by_id($this->input->post('id'))->foto;
			
			$config['upload_path'] 		= './assets/admin/images/anggota/';
			$config['allowed_types']	= 'jpeg|jpg|png';
			$config['max_size']			= 2000;
			$config['encrypt_name'] 	= TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {
				if ($foto_lama || is_file('./assets/admin/images/anggota/'.$foto_lama)) {
					unlink('assets/admin/images/anggota/'.$foto_lama);
				}
				
				$foto_upload = $this->upload->data();
				$foto = $foto_upload['file_name'];
				
				// croping images
				$this->load->library('image_lib');
				
				$image_config['image_library'] = 'gd2';
				$image_config['source_image'] = './assets/admin/images/anggota/'.$foto;
				$image_config['new_image'] = './assets/admin/images/anggota/temp/'.$foto;
				$image_config['quality'] = "100%";
				$image_config['maintain_ratio'] = TRUE;
				// $image_config['width'] = 370;
				$image_config['height'] = 336;
				$this->image_lib->clear();
				$this->image_lib->initialize($image_config);
				$this->image_lib->resize();

				if (is_file('./assets/admin/images/anggota/temp/'.$foto)) {
					unlink('./assets/admin/images/anggota/temp/'.$foto);
				}
			} else {
				$foto = $foto_lama;
			}
			
			if ($this->input->post('jenis_anggota') == '7') {
				$tanggal = new DateTime($this->input->post('tanggal_daftar'));
				$tanggal->modify('+1095 day');
				$tanggal_berakhir = $tanggal->format('Y-m-d');
			} else if ($this->input->post('jenis_anggota') == '8') {
				$tanggal = new DateTime($this->input->post('tanggal_daftar'));
				$tanggal->modify('+730 day');
				$tanggal_berakhir = $tanggal->format('Y-m-d');
			} else if ($this->input->post('jenis_anggota') == '9') {
				$tanggal = new DateTime($this->input->post('tanggal_daftar'));
				$tanggal->modify('+365 day');
				$tanggal_berakhir = $tanggal->format('Y-m-d');
			} else {
				$tanggal = new DateTime($this->input->post('tanggal_daftar'));
				$tanggal->modify('+15779 day');
				$tanggal_berakhir = $tanggal->format('Y-m-d');
			}
			
			$data = [
				'nama'  => ucwords($this->input->post('nama')),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'nis_nipy'  => $this->input->post('nis_nipy'),
				'jenis_anggota'  => $this->input->post('jenis_anggota'),
                'tanggal_daftar'    => $this->input->post('tanggal_daftar'),
                'tanggal_berakhir'  => $tanggal_berakhir,
				'foto'				=> $foto,
			];
			$this->anggota->update($this->input->post('id'), $data);
			$this->session->set_flashdata('anggota',
				'<div class="alert bg-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-check"></i> Berhasil!</h5>
					Data berhasil diperbaharui!
				</div>'
			);
			redirect('admin/anggota', 'refresh');
		} else {
			$this->session->set_flashdata('anggota',
				'<div class="alert bg-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Berhasil!</h5>
					Data tidak dapat diperbaharui! Pastikan Anda mengisi data dengan benar.
				</div>'
			);
			$this->edit($this->input->post('id'));
		}
	}

	public function hapus($id)
	{
		$row = $this->anggota->get_by_id($id);
		if ($row) {
			if ($row->foto && is_file('./assets/admin/images/anggota/'.$row->foto)) {
				unlink('assets/admin/images/anggota/'.$row->foto);
			}

			if ($row->nis_nipy) {
				unlink('assets/admin/images/qr-code/anggota/'.$row->nis_nipy.'.png');
			}
			$this->anggota->delete($row->id);
			echo "berhasilDihapus";
		}

	}

	public function cetak_kartu($id = NULL)
	{
		$row = $this->anggota->get_by_id($id);
		if ($row) {
			$data = [
				'foto'				     => $row->foto,
				'nama'				   => $row->nama,
				'nis_nipy'        => $row->nis_nipy,
				'jenis_kelamin'        => $row->jenis_kelamin,
				'masa_berlaku' => $row->tanggal_berakhir,
				'qr_code'		=> $row->nis_nipy,
			];
			$this->load->view('anggota/kartu-anggota', $data);
		} else {
			$this->session->set_flashdata('anggota',
				'<div class="alert bg-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-ban"></i> Gagal!</h5>
					Data tidak ditemukan!
				</div>'
			);
			redirect('admin/anggota', 'refresh');
		}
	}

	public function rules()
	{
		$this->form_validation->set_rules('nama', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
        $this->form_validation->set_rules('jenis_kelamin', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
        $this->form_validation->set_rules('nis_nipy', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
        $this->form_validation->set_rules('jenis_anggota', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
        $this->form_validation->set_rules('tanggal_daftar', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
	}
}
