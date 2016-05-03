<?php $servername = "localhost";
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


$getavailable = "SELECT SUM(remittance) AS TotalCashCollected FROM transfers WHERE agentusername = '$_REQUEST[agentusername]' AND (date <= '$date' && date >= $pastdate ) ";

$getavailable = $conn->query($getavailable);

if ($getavailable->num_rows > 0) {
 
 $rowavailable = $getavailable->fetch_assoc();

    		
    }


$checkbalance = "SELECT SUM(amount) AS TotalBanking FROM banking WHERE (date >= '$passdate' AND date <= '$date') AND agent = '$_REQUEST[agentusername]' ";

$resultbalance = $conn->query($checkbalance);


if ($resultbalance->num_rows > 0) {
	$rowbalance = $resultbalance->fetch_assoc();
	
}


$checknewuser = "SELECT * FROM users WHERE BINARY username = '$_REQUEST[agentusername]' ";

$resultNEWSenderDetails = $conn->query($checknewuser);

if ($resultNEWSenderDetails->num_rows > 0) {
$rowNEWSender = $resultNEWSenderDetails->fetch_assoc();

}


$availableamt =  $rowNEWSender[limit] - $rowavailable[TotalCashCollected];

$availableamt = number_format($availableamt, 2, '.', ',');


$out =  $rowavailable[TotalCashCollected] - $rowbalance[TotalBanking];

$out = number_format($out, 2, '.', ',');

$limit =  $rowNEWSender[limit];

$agent_details = array();

echo json_encode(array(



      "LIMIT" => $limit,
      "OUTSTANDING" => $out,
      "AVAILABLE" => $availableamt,
      
     
));





?>