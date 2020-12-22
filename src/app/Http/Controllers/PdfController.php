<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
	//
	public function download() {
		$data = ['text' => 'text value'];
		$pdf = PDF::loadView('pdf.sample', $data)->setPaper('A4', 'landscape');
		return $pdf->download('sample.pdf');
	}
}
