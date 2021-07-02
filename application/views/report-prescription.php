<?php
class MYPDF extends TCPDF {

	public function Header() {
		$image_file = base_url().'assets/img/MediCareLogo.png';
		$this->Image($image_file, 10, 5, 50, 10);
		$this->SetXY(190, 10);
		$this->Line(10, 17.5, 200, 17.5);
	}

	public function Footer() {
		$this->Line(10, 282, 200, 282);
		$this->SetY(-15);
		$this->SetFont('helvetica', 'B', 8);
		$this->Cell(0, 10, $this->getAliasNumPage(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}

}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetFont('helvetica', '', 10, '', true);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setFontSubsetting(true);
//$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);
$pdf->SetTitle('Prescription');

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage('p','A4');
$pdf->SetLineStyle(array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(80, 80, 80)));

$pdf->SetXY(10, 20);
$pdf->SetFont('helvetica', 'B', 13, '', true);

$pdf->Cell(190, 8, 'Prescription', 0, 0, 'C');
$pdf->SetXY(12, 26);
$pdf->SetFont('helvetica', '', 12, '', true);
$pdf->Cell(10, 8, 'Doctor Name : '.$data['patient']['dName'], 0, 0, 'L');
$pdf->SetXY(12, 33);
$pdf->Cell(10, 8, 'Patient Name : '.$data['patient']['pName'], 0, 0, 'L');
$pdf->SetXY(158, 33);
$pdf->Cell(10, 8, 'Date : '.$this->uri->segment(4), 0, 0, 'L');
$pdf->SetXY(12, 42	);
$pdf->SetFont('helvetica', '', 10, '', true);
/*
 * b74c4c
 * 7c9bbd
 * */
$pageno = $pdf->PageNo();
$htmlData = '
			<style>
			tbody{
			page-break-inside: auto;
			}
				table th {
					border-right: 1px solid #fff;
				}
				table,
				table td {
					border: 1px solid #7c9bbd;
				}
			</style>

			<table width="100%" style="padding:10px;border: 1px solid #7c9bbd;">
				<tr style="background-color: #7c9bbd;">
					<th>Medicine Name</th>
					<th>Quantity</th>
					<th style="border-right: 1px solid #7c9bbd;">Dine</th>
				</tr>
			';
foreach ($data['pre'] as $datum)
{
	$htmlData .= '<tr style="background-color: #f8f8f8;">
					<td>'. $datum['medName'] .'</td>
					<td>'. $datum['qty'] .'</td>
					<td>'. (($datum['dineSuggestion']==1)?'Before Dine' : ''). (($datum['dineSuggestion']==2)?'After Dine' : '') .' <br> '. $datum['timesPerDay'] .'</td>
				</tr>';
}
$htmlData .= '</table>';

// Print text using writeHTMLCell()
//$pdf->setTableHeader();
$pdf->writeHTML( $htmlData, 0, 1, 0, true, '');

$pdf->Output('Prescription.pdf', 'I');
