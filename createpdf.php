<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost/riskmanagement/companyreport.php?id=1249642977');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$html = curl_exec($ch);
curl_close($ch);

// include autoloader
require_once 'dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
function pdf_create ($html,$filename,$paper,$orientation,$stream= True){
	$dompdf=new DOMPDF();
	$dompdf->set_paper($paper,$orientation);
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream($filename.".pdf");
}
$filename='file_name';
$dompdf=new DOMPDF();
$html=file_get_contents('companyreport.php');
pdf_create($html,$filename,'A4','landscape');
?>

?>