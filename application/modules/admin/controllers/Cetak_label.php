<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cetak_label extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		validasi_login(1);
		$this->load->model('Cetak_label_model', 'cetak_label');
	}

	public function index()
	{
		$data = [
			'main'  => 'cetak-label/data',
		];
		$this->load->view('template/layout', $data);
	}

	public function get_data()
	{
		$list = $this->cetak_label->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();

			$row[] = '<input type="checkbox" value="'.$field->id.'" class="item-label" onclick="jumlah_item_terpilih()">';
			$row[] = $no;
			$row[] = $field->judul;
			$row[] = $field->penulis;
			$row[] = $field->tahun_terbit;
			$row[] = $field->no_buku;
			$data[] = $row;
		}

		$output = array(
			"draw"              => $_POST['draw'],
			"recordsTotal"      => $this->cetak_label->count_all(),
			"recordsFiltered"   => $this->cetak_label->count_filtered(),
			"data"              => $data,
		);
		echo json_encode($output);
	}

	public function cetak($data)
	{
		# code...
	}

	
}
