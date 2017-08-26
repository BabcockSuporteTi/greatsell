<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function pdf_create($html, $filename) {

    require_once(APPPATH . 'helpers/mpdf/mpdf.php');

    $mpdf = new mPDF();

    $mpdf->SetDisplayMode('fullpage');

    $css = file_get_contents(base_url() . "assets/css/bootstrap.min.css");

    $mpdf->WriteHTML($css, 1);

    $mpdf->WriteHTML($html);

    $mpdf->Output($filename, 'I');
}
