<?php $servername = "localhost";
$username = "rootuser";
$password = "root";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 




$transactionlist =array();

if ($_SERVER["REQUEST_METHOD"] === "GET")

{


$pastdate = date('Y-m-d', strtotime('-1825 days'));


$sql = "SELECT * FROM banking WHERE date >= '$pastdate' ORDER BY date";
	
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {



$value =  $row[date];

$day =  substr("$value",8,2);

$month = substr("$value",5,2);

$year =  substr("$value",0,4);

$date = $day."-".$month."-".$year;

$transaction = array(

      "id" => $row[id], 
      "comments" => $row[comments],
      "date" => $date,
      "amount" => $row[amount],
      "paymenttype" => $row[paymenttype],
      "bank" => $row[bank],
      "dailysales" => $row[dailysales],
      "transfers" => $row[transfers],
      "agent" => $row[agent]

      );

array_push($transactionlist,$transaction);	


}




echo json_encode($transactionlist);

	
}




?>