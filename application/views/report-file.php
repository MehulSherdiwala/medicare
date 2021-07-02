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
$pdf->SetTitle('Medical Report');

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetLineStyle(array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(80, 80, 80)));

/*
 * b74c4c
 * 7c9bbd
 * */
//print_r($patient);

$pdf->setPrintHeader(false);
$pdf->AddPage('p','A4');

$image_file = base_url().'assets/img/MediCareLogo.png';
$pdf->Image($image_file, 67, 7, 70, 15);
$image_file = base_url().'assets/img/sap.png';
$pdf->Image($image_file, 20, 26, 170, 10);

$pdf->SetFont('helvetica', '', 13, '', true);
$front = '
<table>
	<tr>
		<td width="20%">Doctor Name :</td>
		<td style="border-bottom: 1px solid #000;width: 80%">'. $patient['dName'] .'</td>
	</tr>
	<br>
	<br>
	<tr>
		<td width="20%">Doctor Email :</td>
		<td style="border-bottom: 1px solid #000;width: 30%">'. $patient['dEmail'] .'</td>
		<td width="21%"> Doctor Phone :</td>
		<td style="border-bottom: 1px solid #000;width: 29%">'. $patient['dPhone'] .'</td>
	</tr>
	<br>
	<br>
	<tr>
		<td width="22%">Doctor Address :</td>
		<td style="border-bottom: 1px solid #000;width: 78%">'. $patient['dAddress'] .'</td>
	</tr>
	<br>
	<br>
	<tr>
		<td width="20%">Clinic Name :</td>
		<td style="border-bottom: 1px solid #000;width: 80%">'. $patient['clinicName'] .'</td>
	</tr>
	<br>
	<br>
	<tr>
		<td width="22%">Clinic Address :</td>
		<td style="border-bottom: 1px solid #000;width: 78%">'. $patient['clinicAddress'] .'</td>
	</tr>
</table>	
';
$pdf->writeHTMLCell( 160, 0, 25, 43, $front, '',1, 0, true, '', true);


$Y = $pdf->getY();
$pdf->Image($image_file, 20, $Y+10, 170, 10);

$front = '
<table>
	<tr>
		<td width="20%">Patient Name :</td>
		<td style="border-bottom: 1px solid #000;width: 80%">'. $patient['pName'] .'</td>
	</tr>
	<br>
	<br>
	<tr>
		<td width="20%">Patient Email :</td>
		<td style="border-bottom: 1px solid #000;width: 30%">'. $patient['pEmail'] .'</td>
		<td width="21%"> Patient Phone :</td>
		<td style="border-bottom: 1px solid #000;width: 29%">'. $patient['pPhone'] .'</td>
	</tr>
	<br>
	<br>
	<tr>
		<td width="20%">Patient Age :</td>
		<td style="border-bottom: 1px solid #000;width: 30%">'. $patient['age'] .'</td>
		<td width="23%"> Patient Gender :</td>
		<td style="border-bottom: 1px solid #000;width: 27%">'. $patient['gender'] .'</td>
	</tr>
	<br>
	<br>
	<tr>
		<td width="23%">Patient Address :</td>
		<td style="border-bottom: 1px solid #000;width: 77%">'. $patient['pAddress'] .'</td>
	</tr>
</table>	
';
$pdf->writeHTMLCell( 160, 0, 25, $Y+30, $front, '',1, 0, true, '', true);

$Y = $pdf->getY();
$pdf->Image($image_file, 20, $Y+10, 170, 10);

$front = '
<table>
	
	<tr>
		<td width="20%">Date :</td>
		<td style="border-bottom: 1px solid #000;width: 80%">'. $patient['datetime'] .'</td>
	</tr>
	<br>
	<br>
	<tr>
		<td width="20%">Description :</td>
		<td style="border-bottom: 1px solid #000;width: 80%">'. $patient['pmrDescription'] .'</td>
	</tr>
</table>	
';
$pdf->writeHTMLCell( 160, 0, 25, $Y+30, $front, '',1, 0, true, '', true);

$pdf->SetFont('helvetica', '', 10, '', true);
$pdf->setPrintHeader(TRUE);
$pdf->setPrintFooter(TRUE);
$style = '<style>
			tbody{
			page-break-inside: auto;
			}
			table{
				border: 1px solid #7c9bbd;
			}
			table th {
				border-right: 1px solid #fff;
			}
			table,
			table td {
				border: 1px solid #7c9bbd;
			}
			</style>';

if (count($data['pmd']) > 0){
	foreach ($data['pmd'] as $key => $datum)
	{
		$dates = array_keys($data['pre'][$datum['pmdId']]);
		$desc = '
				<div class="description">
					<b>Case Description</b>
					<b style="margin-left: 15px">Date : </b><span>'. $datum['datetime'] .'</span>
					<br>
					<br>
					<table style="padding: 7px;background-color: #f1f1f1;">
						<tr>
							<td style="height: 100px" >'. $datum['description'] .'</td>
						</tr>
					</table>
				</div>
		';
		foreach ($dates as $date)
		{
			$htmlData = $style.'<div>
				<b>Medicine</b>
				<b>Date :</b><span id="preDate">'. $date .'</span>
				<br>
				<br>
				<table class="table" style="padding: 10px">
					<tr style="background-color: #7c9bbd;">
						<th>Medicine Name</th>
						<th>Quantity</th>
						<th style="border-right: 1px solid #7c9bbd;">Dine</th>
					</tr>
				';
			foreach ($data['pre'][$datum['pmdId']][$date] as $dat)
			{
				$htmlData .= '
					<tr>
						<td>'. $dat['medName'] .'</td>
						<td>'. $dat['qty'] .'</td>
						<td>'. (($dat['dineSuggestion']==1)?'Before Dine' : ''). (($dat['dineSuggestion']==2)?'After Dine' : '') .' <br> '. $dat['timesPerDay'] .'</td>
					</tr>';
			}

			$htmlData .= '</table></div>';
			$pdf->AddPage('p','A4');
			$pdf->writeHTML( $desc, 0, 1, 0, true, '');
			$pdf->writeHTML( $htmlData, 0, 1, 0, true, '');

		}
	}
}
// Print text using writeHTMLCell()
//$pdf->setTableHeader();
$pdf->Output('Medical.pdf', 'I');
