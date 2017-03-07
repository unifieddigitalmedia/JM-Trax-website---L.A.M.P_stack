<?php 

$servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$pastdate = date('Y-m-d', strtotime('-30 days'));


$date = date("Y-m-d");

$totalbanked = 0;

$totaltransfered = 0;


$getavailable = "SELECT SUM(remittance) AS TotalCashCollected FROM transfers WHERE shop = '$_REQUEST[agentshop]' AND Tdate = '$date' ";

$getavailable = $conn->query($getavailable);

if ($getavailable->num_rows > 0) {
 
 $rowavailable = $getavailable->fetch_assoc();

    		
    }


$checkbalance = "SELECT SUM(amount) AS TotalBanking FROM banking WHERE date = '$date' AND shop = '$_REQUEST[agentshop]' ";

$resultbalance = $conn->query($checkbalance);


if ($resultbalance->num_rows > 0) {
	$rowbalance = $resultbalance->fetch_assoc();
	
}


$checknewuser = "SELECT * FROM shops WHERE BINARY name = '$_REQUEST[agentshop]' ";

$resultNEWSenderDetails = $conn->query($checknewuser);

if ($resultNEWSenderDetails->num_rows > 0) {
$rowNEWSender = $resultNEWSenderDetails->fetch_assoc();

}


$availableamt =  $rowNEWSender[shop_limit] - $rowavailable[TotalCashCollected] + $rowbalance[TotalBanking];

$availableamt = $availableamt ;


$out =  $rowavailable[TotalCashCollected] - $rowbalance[TotalBanking];

$out = $out ;

$limit =  $rowNEWSender[shop_limit];

$agent_details = array();

echo json_encode(array(



      "LIMIT" => $limit,
      "OUTSTANDING" => $out,
      "AVAILABLE" => $availableamt,
      
     
));






?>