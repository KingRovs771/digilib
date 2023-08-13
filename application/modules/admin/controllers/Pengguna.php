<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengguna_model', 'pengguna');
		validasi_login(1);
	}

	public function index()
	{
		$data = [
			'main'  => 'pengguna/data',
		];
		$this->load->view('template/layout', $data);
	}

	public function get_data()
	{
		$list = $this->pengguna->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			if ($field->status == '0') $status = '<span class="text-danger">Tidak Aktif</span>'; else $status = '<span class="text-success">Aktif</span>';
			if ($field->level == '0') {
				$level = '<span class="text-danger">Developer</span>';
			} else {
				$level = '<span class="text-success">Admin</span>';
			}
			
			$row[] = $no;
			$row[] = $field->nama;
			$row[] = $field->username;
			$row[] = $level;
			$row[] = $status;
			$row[] = $field->id;
			$data[] = $row;
		}

		$output = array(
			"draw"              => $_POST['draw'],
			"recordsTotal"      => $this->pengguna->count_all(),
			"recordsFiltered"   => $this->pengguna->count_filtered(),
			"data"              => $data,
		);
		echo json_encode($output);
	}

	public function tambah()
	{
		$data = [
			'id'				=> set_value('id'),
			'nama'		=> set_value('nama'),
			'username'			=> set_value('username'),
			'password'			=> set_value('password'),
			'status'			=> set_value('status'),
			'url'				=> site_url('admin/pengguna/simpan'),
			'main'  			=> 'pengguna/form',
		];
		$this->load->view('template/layout', $data);
	}

	public function simpan()
	{
		$this->rules();
		if ($this->form_validation->run() == TRUE) {
			$cek_username = $this->pengguna->cek_username($this->input->post('username'));
			if ($cek_username) {
				$this->session->set_flashdata('pengguna',
				'<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-ban"></i> Berhasil!</h5>
				Username sudah ada di dalam database. Gunakan username yang lain!
				</div>' );
				$this->tambah();
			} else {
				$data = [
					'username'			=> $this->input->post('username'),
					'nama'		=> $this->input->post('nama'),
					'password'			=> sha1(md5(sha1(sha1($this->input->post('password'))))),
					'level'				=> $this->input->post('level'),
					'status'			=> $this->input->post('status'),
				];
				$this->pengguna->insert($data);
				$this->session->set_flashdata('pengguna',
				'<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Berhasil!</h5>
				Data berhasil ditambahkan!
				</div>' );
				redirect('admin/pengguna', 'refresh');
			}
		} else {
			$this->session->set_flashdata('pengguna',
			'<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="icon fas fa-ban"></i> Berhasil!</h5>
			Silahkan lengkapi data pengguna!
			</div>' );
			$this->tambah();
		}

	}

	public function edit($id)
	{
		$row = $this->pengguna->get_by_id($id);
		if ($row) {
			$data = [
				'id'				=> set_value('id', $row->id),
				'nama'		=> set_value('nama', $row->nama),
				'username'			=> set_value('username', $row->username),
				'password'			=> set_value('password', $row->password),
				'level'				=> set_value('level', $row->level),
				'status'			=> set_value('status', $row->status),
				'url'				=> site_url('admin/pengguna/update'),
				'main'  			=> 'pengguna/form',
			];
			$this->load->view('template/layout', $data);
		} else {
			redirect('admin/pengguna', 'refresh');
		}
	}

	public function update()
	{
		$this->rules();
		if ($this->form_validation->run() == TRUE) {
			if ($this->input->post('password')) {
				$password = sha1(md5(sha1(sha1($this->input->post('password')))));
			} else {
				$password = $this->input->post('password_lama');
			}

			$data = [
				'username'			=> sha1($this->input->post('username')),
				'nama'		=> $this->input->post('nama'),
				'username'		=> $this->input->post('username'),
				'password'			=> $password,
				'level'				=> $this->input->post('level'),
				'status'			=> $this->input->post('status'),
			];
			$this->pengguna->update($this->input->post('id'), $data);
			redirect('admin/pengguna', 'refresh');
		} else {
			redirect('admin/pengguna', 'refresh');
		}
	}

	public function hapus($id)
	{
		validasi_login(1);
		$row = $this->pengguna->get_by_id($id);
		if ($row && $this->session->userdata('id') != $row->id) {
			$this->pengguna->delete($row->id);
			echo "berhasilDihapus";
		} else {
			echo 'sedangLogin';
		}
	}

	public function rules()
	{
		$this->form_validation->set_rules('nama', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_rules('username', '', 'trim|required', [
			'required' => 'Kolom ini <strong>harus diisi!</strong>',
		]);
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
	}
}
