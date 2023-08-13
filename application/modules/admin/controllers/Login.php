<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model', 'login');
	}

	public function index()
	{
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('status') == '1') {
			redirect('admin','refresh');
		} else {
			$data = [
				'username'  => set_value('username'),
				'password'	=> set_value('password'),
			];
			$this->load->view('login', $data);
		}
	}

	public function auth()
	{
		$row = $this->login->auth($this->input->post('username'), sha1(md5(sha1(sha1($this->input->post('password'))))));
		if ($row) {
			$array = array(
				'login'        => TRUE,
				'id'           => $row->id,
				'level'        => $row->level,
				'status'       => $row->status,
			);
			$this->session->set_userdata( $array );
			redirect('admin','refresh');
		} else {
			$this->session->set_flashdata('login',
				'<div class="alert alert-danger" role="alert">
					Username dan password tidak sesuai!
				</div>'
			);
			$this->index();
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
        redirect('login','refresh');
	}

}
