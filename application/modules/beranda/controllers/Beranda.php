<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Beranda_model', 'beranda');
  }

  public function index()
  {
      $data = [
          'main'	=> 'beranda',
      ];
      $this->load->view('template/template', $data);
  }

  public function get_data_kehadiran()
	{
		$list = $this->beranda->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();

			$row[] = $no;

			$row[] = $field->nama;
			$row[] = $field->no_beranda;
			$row[] = tanggal_indonesia($field->tanggal_daftar);
			$row[] = $field->foto;
			$row[] = $field->id;
			$data[] = $row;
		}

		$output = array(
			"draw"              => $_POST['draw'],
			"recordsTotal"      => $this->beranda->count_all(),
			"recordsFiltered"   => $this->beranda->count_filtered(),
			"data"              => $data,
		);
		echo json_encode($output);
	}
}
