<?php


$servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 





$root = realpath($_SERVER["DOCUMENT_ROOT"]);

require_once $root.'/api/PHPExcel/Classes/PHPExcel.php';

require_once $root.'/api/PHPExcel/Classes/PHPExcel/IOFactory.php';

PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

$objPHPExcel = new PHPExcel();


$objPHPExcel->getProperties()->setCreator('JM Trax')
->setLastModifiedBy("Victor Amos")
->setTitle("Office 2007 XLSX Test Document")
->setSubject("Office 2007 XLSX Test Document")
->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
->setKeywords("office 2007 openxml php");


$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','AGENCY');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','SHOP');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','DATE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','TRANSACTION NO.');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1','SENDER FIRST NAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1','SENDER LAST NAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1','AMOUNT GBP');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','FEES GBP');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1','TOTAL GBP DUE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1','TOTAL NGN DUE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1','STATUS');


$startdate = "2017-02-03";

$enddate = "2017-02-10";
	


$sql2 = "SELECT * FROM transfers WHERE Tdate >= '$startdate' && Tdate <= '$enddate' ";



$transfers = array();



$result2 = $conn->query($sql2);


$counter = 2 ;

    while($row = $result2->fetch_assoc()) {


$value =  $row[date] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."-".$month."-".$year;

$orderID = 'JM'.$row[id];

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(0).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row[agentusername]);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(1).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['shop']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(2).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$date);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(3).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$orderID);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(4).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['senderfirstname']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(5).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['senderlasttname']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(6).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['amount']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(7).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['fee']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(8).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['totalgbp']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(9).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['ngn']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(10).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['status']);


$counter = $counter +1;








}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
ob_end_clean();

$objWriter->save('nameoffile.xls');
	
	





?>