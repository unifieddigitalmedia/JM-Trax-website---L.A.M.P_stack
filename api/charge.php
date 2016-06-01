<?php 


$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$servername = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname = substr($url["path"], 1);



$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(!$_REQUEST[ngn] && !$_REQUEST[totalngn] && !$_REQUEST[totalgbp] && !$_REQUEST[amount] && !$_REQUEST[remittance])
{

$fees = array();

$sql = "SELECT * FROM commission ";

$result = $conn->query($sql);

while($row1 = $result->fetch_assoc()) {

$fee = array(

      "id" => $row1[id], 
      "upper" => $row1[upper],
      "lower" => $row1[lower],
      "commission" => $row1[fee],
     
     
      );


array_push($fees,$fee);



}

echo json_encode(array_values($fees));

}
else
{
	


$gbp = 0; 

$ngn = 0; 

$amount = 0 ;

$rate = 0 ;

$rates = array();

$sql = "SELECT * FROM rates ";

$result = $conn->query($sql);

while($row = $result->fetch_assoc())

{

$transaction = array(

      "rate" => $row[rate],
      "code" => $row[code]

      );


array_push($rates,$transaction);
}


     $gbp = $rates[0][rate];

     $ngn = $rates[1][rate];


if($_REQUEST[ngn])

{


$amt = $_REQUEST[ngn];

$amt = str_replace(',','', $amt);


$amt = $amt / $gbp;

$ngn = "SELECT * FROM commission WHERE upper >= $amt  && lower <= $amt ";

$resultngn = $conn->query($ngn);

$rowngn = $resultngn->fetch_assoc() ;

if( $amt >= 1000.01){
	
	$tltamt = (($amt * $rowngn[fee] )/100) + $amt ;
	
	$fee =  (($amt * $rowngn[fee] )/100);
}
else
{
	
	$tltamt = $amt + $rowngn[fee];
	
	$fee = $rowngn[fee];
}


$tltngn = $amt * $gbp; 

echo json_encode(array(


      "REMIITANCE" => $amt,
      "AMOUNT" => $amt,
      "FEES" => $fee,
      "NGN" => $tltngn,
      "TOTALGBP" => $tltamt,
      "RATE" => $gbp,
      
     
));




}

else if($_REQUEST[totalngn])

{

$amt = $_REQUEST[totalngn];

$amt = str_replace(',','', $amt);

$amt = $amt / $gbp;

$totalngn = "SELECT * FROM commission WHERE upper >= $amt  && lower <= $amt ";

$resulttotalngn = $conn->query($totalngn);

$rowtotalngn = $resulttotalngn->fetch_assoc() ;

if( $amt >= 1000.01){
	
	$tltamt = (($amt * $rowtotalngn[fee] )/100) + $amt ;
	
		$fee =  (($amt * $rowtotalngn[fee] )/100);
}
else
{
	
	$tltamt = $amt + $rowtotalngn[fee];
	
	$fee = $rowtotalngn[fee];
	
}


$tltngn = $amt * $gbp; 

echo json_encode(array(


      "REMIITANCE" => $amt,
      "AMOUNT" => $amt,
      "FEES" => $fee,
      "NGN" => $tltngn,
      "TOTALGBP" => $tltamt,
      "RATE" => $gbp,
      
     
));


}

else if($_REQUEST[totalgbp])

{


$amt = $_REQUEST[totalgbp];

$amt = str_replace(',','', $amt);

$totalgbp = "SELECT * FROM commission WHERE upper >= $amt  && lower <= $amt ";

$resulttotalgbp = $conn->query($totalgbp);

$rowtotalgbp = $resulttotalgbp->fetch_assoc();


		
$amt = $_REQUEST[totalgbp] - $rowtotalgbp[fee];
				
$newtotalgbp = "SELECT * FROM commission WHERE upper >= $amt  && lower <= $amt ";

$newresulttotalgbp = $conn->query($newtotalgbp);

$newrowtotalgbp = $newresulttotalgbp->fetch_assoc();


if( $amt >= 1000.01){
	
	$tltamt = (($amt * $newrowtotalgbp[fee] )/100) + $amt ;
	
		$fee =  (($amt * $newrowtotalgbp[fee] )/100);
}
else
{
	
	$tltamt = $amt + $newrowtotalgbp[fee];
	$fee = $newrowtotalgbp[fee];
	
	
}

$change = $_REQUEST[totalgbp] - $tltamt;


$newamt = $amt + $change ;


$newtotalamtgbp = "SELECT * FROM commission WHERE upper >= $newamt  && lower <= $newamt ";

$newresulttotalamtgbp = $conn->query($newtotalamtgbp);

$newrowtotalamtgbp = $newresulttotalamtgbp->fetch_assoc();


if( $newamt >= 1000.01){
	
	$tltamt = (($newamt * $newrowtotalamtgbp[fee] )/100) + $newamt ;
	
		$fee =  (($newamt * $newrowtotalamtgbp[fee] )/100);
}
else
{
	
	$tltamt = $newamt + $newrowtotalamtgbp[fee];
	$fee = $newrowtotalamtgbp[fee];
	
	
}


$tltngn = $newamt * $gbp;


		echo json_encode(array(


      "REMIITANCE" => $newamt,
      "AMOUNT" => $newamt,
      "FEES" => $fee,
      "NGN" => $tltngn,
      "TOTALGBP" =>$tltamt,
      "RATE" => $gbp,
      
     
));





	


  
}

else if($_REQUEST[amount])

{
	
$amt = $_REQUEST[amount];

$amt = str_replace(',','', $amt);
$amount = "SELECT * FROM commission WHERE upper >= $amt  && lower <= $amt ";

$resultamount = $conn->query($amount);

$rowamount = $resultamount->fetch_assoc() ;

if($amt >= 1000.01){
	
	$tltamt = (($amt *$rowamount[fee] )/100) + $amt ;
	
		$fee =  (($amt * $rowamount[fee] )/100);
}
else
{
	
	$tltamt = $amt + $rowamount[fee];
	$fee = $rowamount[fee];
	
	
}


$tltngn = $amt * $gbp; 

echo json_encode(array(

      "REMIITANCE" => $amt,
      "AMOUNT" => $amt,
      "FEES" => $fee,
      "NGN" => $tltngn,
      "TOTALGBP" => $tltamt,
      "RATE" => $gbp,
      
     
));

}

else if($_REQUEST[remittance])

{

$amt = $_REQUEST[remittance];

$amt = str_replace(',','', $amt);

$remittance = "SELECT * FROM commission WHERE upper >=$amt && lower <= $amt ";

$resultremittance = $conn->query($remittance);

$rowremittance = $resultremittance->fetch_assoc() ;

if( $_REQUEST[remittance] >= 1000.01){
	
	$tltamt = (($_REQUEST[remittance] * $rowremittance[fee] ) / 100 ) + $_REQUEST[remittance] ;
	
		$fee =  (($amt * $rowremittance[fee] )/100);
}
else
{
	
	$tltamt = $_REQUEST[remittance] + $rowremittance[fee];
	
	$fee = $rowremittance[fee];
}


$tltngn = $_REQUEST[remittance] * $gbp; 

echo json_encode(array(



      "REMIITANCE" => $_REQUEST[remittance],
      "AMOUNT" => $_REQUEST[remittance],
      "FEES" => $fee,
      "NGN" => $tltngn,
      "TOTALGBP" => $tltamt,
      "RATE" => $gbp,
      
     
));
  
}
}

 