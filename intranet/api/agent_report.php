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



$bankingdetails = "SELECT * FROM banking WHERE BINARY `agent` = '$_REQUEST[agentusername]' ORDER BY date DESC";

$resultbanking = $conn->query($bankingdetails);

$rowbanking = $resultbanking->fetch_assoc();


$value =  $rowbanking[date] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."-".$month."-".$year;

//$email = $rowNEWSender[Email] ;

$email = "udigitallondon@hotmail.com";
$headers .= 'From:just-computers@hotmail.com'. "\r\n";

$headers .= 'Cc:service@jmtrax.com,justmtransfers@gmail.com' . "\r\n";

$subject = "User Report - 30 day period";

$message =" User $_REQUEST[agentusername] $rowNEWSender[Email]

            Credit limit : £ $rowNEWSender[limit]

            Available balance : £ $availableamt 

            Outstanding balance : £ $out

            Last payment details below

            Date - $date

            Amount banked - $rowbanking[amount]

" ;

mail("$email", "Subject: $subject",$message,$headers);

echo json_encode(array(



      "ERROR" => "Email sent to user",
  
      
     
));

?>