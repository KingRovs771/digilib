<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('./application/libraries/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

class Kartu_anggota {
	protected $ci;

	public function generate($view, $data = array())
	{
		$CI =& get_instance();
		$dompdf = new Dompdf();
		$html = $CI->load->view($view, $data, TRUE);
		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$ukuran_custom = [0, 0, 794, 1123];
		$dompdf->setPaper($ukuran_custom, 'portrait');
		// $dompdf->setPaper('A4', 'portrait');

		// Render the HTML as PDF
		$dompdf->render();

		/*
			Output the generated PDF to Browser
			1: Download
			0: Preview Web
		*/
		$dompdf->stream('Kartu Anggota', ['Attachment' => 0]);
	}
}
