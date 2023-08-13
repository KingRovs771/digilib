<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	var $table          = 'pengguna';

	public function auth($u, $p)
	{
		return $this->db->get_where($this->table, ['username' => $u, 'password' => $p])->row();
	}

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */