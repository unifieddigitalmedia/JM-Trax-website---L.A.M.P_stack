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

$target_dir = $root;


$objPHPExcel->getProperties()->setCreator('JM Trax')
->setLastModifiedBy("Victor Amos")
->setTitle("Transfers Backup");


$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','ID');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','SENDER FIRST NAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','SENDER LAST NAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','LINE 1');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1','LINE 2');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1','LINE 3');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1','TOWN');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','SENDER COUNTY');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1','POSTCODE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1','SENDER PHONE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1','SENDER MOBILE');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1','SENDER EMAIL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1','RECIPIENTS SURNAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1','RECIPIENTS FIRSTNAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1','RECIPIENTS PHONE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1','BANK ACC');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1','BANK NAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1','REC MOBILE PHONE PREX');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S1','PAYMENT REF');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T1','SHOP ACC');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U1','PAY PAL EMAIL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V1','AGENT USERNAME');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W1','REMITTANCE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X1','NGN');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y1','AMOUNT');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z1','TOTAL GBP');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA1','FEE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB1','DATE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC1','SHOP');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD1','CUSTOMER REF');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE1','RATE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF1','STATUS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG1','PAYMENT DATE');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AH1','SENDING BANK');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI1','PAYMENT METHOD');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ1','CASH');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK1','CHANGE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL1','UK SMS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM1','NGN SMS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN1','TDATE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AO1','URL');




$getTransfers = "SELECT * FROM transfers";

$transfers = array();

$resultOfgetTransfers = $conn->query($getTransfers);

$counter = 2 ;

while($rowgetTransfers = $resultOfgetTransfers->fetch_assoc()) {

$value =  $rowgetTransfers[paymentdate] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$paymentdate = $day."-".$month."-".$year;


$value =  $rowgetTransfers[Tdate] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$Tdate = $day."-".$month."-".$year;




$orderID = 'JM'.$rowgetTransfers[id];


$cellAlias = PHPExcel_Cell::stringFromColumnIndex(0).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$orderID);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(1).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['senderfirstname']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(2).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['senderlasttname']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(3).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['line1']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(4).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['line2']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(5).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['line3']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(6).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['town'] );
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(7).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['sendercounty']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(8).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['postcode']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(9).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['senderphone']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(10).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['sendermobile']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(11).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['senderemail']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(12).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['recipientsurname']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(13).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['recipientfirstname']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(14).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['recipientphone']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(15).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['bankac']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(16).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['bankname']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(17).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['recmobilephoneprex']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(18).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['paymentref']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(19).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['shopacc']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(20).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['paypalemail']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(21).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['reasonfortransfer']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(22).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['agentusername']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(23).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['remittance']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(24).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['ngn']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(25).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['  amount']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(26).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['totalgbp']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(27).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['fee']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(28).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['date']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(29).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['shop']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(30).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['customeref']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(31).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['rate']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(32).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['status']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(33).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$paymentdate);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(34).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['sendingbank']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(35).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['paymentmethod']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(36).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['cash']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(37).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['change']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(38).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['uksms']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(39).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['ngnsms']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(40).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$Tdate);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(41).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['url']);

$counter = $counter +1;

}

$transfersURL = '/backup/transfers/'.date("Y-m-d h:i:s").'.xlsx';


$transfersURL = str_replace(" ","-",$transfersURL);

$target_transfers = $target_dir.$transfersURL;


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');

$objWriter->save($target_transfers);




$objPHPExcel = new PHPExcel();

$target_dir = $root;


$objPHPExcel->getProperties()->setCreator('JM Trax')
->setLastModifiedBy("Victor Amos")
->setTitle("Banking Backup");


$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','ID');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','COMMENTS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','DATE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','AMOUNT');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1','PAYMENT TYPE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1','BANK');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1','DAILY SALES');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','TRANSFERS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1','AGENT');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1','SHOP');



$getBanking = "SELECT * FROM banking";

$transfers = array();

$resultOfgetBanking = $conn->query($getBanking);

$counter = 2 ;

while($rowgetBanking = $resultOfgetBanking->fetch_assoc()) {

$value =  $rowgetBanking[date] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."-".$month."-".$year;

$orderID = 'JM'.$rowgetBanking[id];

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(0).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$orderID);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(1).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetBanking['comment']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(2).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$date);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(3).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetBanking['amount']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(4).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetBanking['paymenttype']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(5).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetBanking['bank']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(6).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetTransfers['dailysales']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(7).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetBanking['transfers']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(8).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetBanking['agent']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(9).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetBanking['shop']);

$counter = $counter +1;

}



$bankingURL = '/backup/banking/'.date("Y-m-d h:i:s").'.xlsx';


$bankingURL = str_replace(" ","-",$bankingURL);

$target_banking = $target_dir.$bankingURL;


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');

$objWriter->save($target_banking);






$objPHPExcel = new PHPExcel();

$target_dir = $root;


$objPHPExcel->getProperties()->setCreator('JM Trax')
->setLastModifiedBy("Victor Amos")
->setTitle("Recipients Backup");


$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','ID');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','RECEIPIENT FIRST NAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','RECEIPIENT LAST NAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','RECEIPIENT BANK');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1','RECEIPIENT ACCOUNT NUMBER');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1','RECEIPIENT REASON FOR TRANSFER');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1','RECEIPIENT PAYMENT REFERENCE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','RECEIPIENT PHONE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1','RECEIPIENT PAY PAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1','RECEIPIENT SHOP ACCOUNT');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1','RECEIPIENT THRID PARTY PAYMENT COMMENT');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1','RECEIPIENT SENDERS ID');




$getReceipients = "SELECT * FROM receipients";

$transfers = array();

$resultOfgetReceipients = $conn->query($getReceipients);

$counter = 2 ;

while($rowgetgetReceipients = $resultOfgetReceipients->fetch_assoc()) {

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(0).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients[id]);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(1).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients['ReceipientFirstName']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(2).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients['ReceipientLastName']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(3).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients['ReceipientBank']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(4).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients['ReceipientAccountNumber']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(5).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients['ReceipientReasonForTransfer']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(6).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients['ReceipientPaymentReference']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(7).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients['ReceipientPhone']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(8).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients['ReceipientPayPal']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(9).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients['ReceipientShopAccount']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(10).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients['ReceipientThirdPartyPaymentComment']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(11).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetgetReceipients['sendersID']);
$counter = $counter +1;

}



$recipientsURL = '/backup/recipients/'.date("Y-m-d h:i:s").'.xlsx';


$recipientsURL = str_replace(" ","-",$recipientsURL);

$target_recipients = $target_dir.$recipientsURL;


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');

$objWriter->save($target_recipients);


$objPHPExcel = new PHPExcel();

$target_dir = $root;


$objPHPExcel->getProperties()->setCreator('JM Trax')
->setLastModifiedBy("Victor Amos")
->setTitle("Users Backup");


$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','ID');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','USERNAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','PASSWORD');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','SECRET QUESTION');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1','SECRET ANSWER');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1','DATE MODIFIED');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1','DATE CREATED');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','USER TYPE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1','LIMIT');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1','SENDERS FIRST NAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1','SENDERS LAST NAME');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1','LINE 1');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1','LINE 2');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1','LINE 3');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1','TOWN');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1','POSTCODE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1','COUNTY');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1','COUNTRY');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S1','MOBILE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T1','EMAIL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U1','SOURCE OF FUNDS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V1','ID TYPE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W1','ID NUMBER');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X1','ID EXPIRY');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y1','ID COUNTRY');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z1','ID URL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA1','ADDRESS URL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB1','INCOME URL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC1','ENABLED');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD1','OCCUPATION');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE1','SHOP');


$getUsers = "SELECT * FROM users";

$transfers = array();

$resultOfgetUsers = $conn->query($getUsers);

$counter = 2 ;






while($rowgetUsers = $resultOfgetUsers->fetch_assoc()) {




$value =  $rowgetUsers[datemodified] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$dateCreated = $day."-".$month."-".$year;


$value =  $rowgetUsers[datecreated] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$dateModified = $day."-".$month."-".$year;



$cellAlias = PHPExcel_Cell::stringFromColumnIndex(0).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers[id]);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(1).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['username']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(2).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['password']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(3).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['secretquestion']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(4).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['secretanswer']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(5).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$dateCreated);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(6).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$dateModified );
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(7).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['usertype']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(8).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['limit']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(9).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['SendersFirstName']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(10).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['SendersLastName']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(11).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Line1']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(12).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Line2']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(13).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Line3']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(14).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Town']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(15).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Postcode']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(16).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['County']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(17).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Country']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(18).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Mobile']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(19).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Email']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(20).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Sourceoffunds']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(21).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['IDtype']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(22).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['IDnumber']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(23).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['IDexpiry']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(24).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['IDcountry']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(25).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['IDURL']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(26).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['AddressURL']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(27).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['IncomeURL']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(28).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Enabled']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(29).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Occupation']);
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(30).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$rowgetUsers['Shop']);

$counter = $counter +1;

}

$usersURL = '/backup/users/'.date("Y-m-d h:i:s").'.xlsx';

$usersURL = str_replace(" ","-",$usersURL);

$target_users = $target_dir.$usersURL;


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');

$objWriter->save($target_users);



$transfersURL = 'http://www.jmtrax.com'.$transfersURL;
$bankingURL = 'http://www.jmtrax.com'.$bankingURL;
$recipientsURL = 'http://www.jmtrax.com'.$recipientsURL;
$usersURL = 'http://www.jmtrax.com'.$usersURL;




$email = "vamoslawanson@gmail.com" ;
$subject = "DATABASE BACKUP";
$message = "Your backup files can be accessed at via the links below and will be backed up every day at 8:00pm.

Transfers : $transfersURL

Banking: $bankingURL

Recipients: $recipientsURL

Users: $usersURL
" ;

mail($email, "Subject: $subject",$message, "From:just-computers@hotmail.com");




ob_end_clean();


	

	




?>