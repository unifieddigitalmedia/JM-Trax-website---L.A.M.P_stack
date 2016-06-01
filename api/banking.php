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




$transactionlist =array();

if ($_SERVER["REQUEST_METHOD"] === "GET")
{


if($_REQUEST[agenttype] == 'administrator')
{


$sql = "SELECT * FROM banking ";

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
else
{


$sql1 = "SELECT * FROM banking WHERE agent = '$_REQUEST[agentusername]' ";

$result1 = $conn->query($sql1);

while($row1 = $result1->fetch_assoc()) {


$value =  $row1[date];
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."/".$month."/".$year;

$transaction = array(

      "id" => $row1[id], 
      "comments" => $row1[comments],
      "date" => $date,
      "amount" => $row1[amount],
      "paymenttype" => $row1[paymenttype],
      "bank" => $row1[bank],
      "dailysales" => $row1[dailysales],
      "transfers" => $row1[transfers],
      "agent" => $row1[agent]

      );


array_push($transactionlist,$transaction);




}


echo json_encode(array_values($transactionlist));

}
}
else if ($_SERVER["REQUEST_METHOD"] === "POST")

{



$value2 = trim($_REQUEST[date]);
$startday=  substr("$value2",0,2);
$startmonth=  substr("$value2",3,2);
$startyear =  substr("$value2",8,2);
$date = "20".$startyear."-".$startmonth."-".$startday;



$sql1 = "INSERT INTO banking (date, amount, paymenttype ,bank ,dailysales ,transfers ,agent,`comments`)

VALUES ('$date', '$_REQUEST[amount]', '$_REQUEST[payment_ref]', '$_REQUEST[bank]', '$_REQUEST[sales]', '$_REQUEST[num_transfers]', '$_REQUEST[agent]','$_REQUEST[comment]')";

if ($conn->query($sql1) === TRUE) {

  
  echo json_encode(array(



      "ERROR" => "New record created successfully"
      
     
));




} else {

    
     echo json_encode(array(



      "ERROR" => "There was an error contact administrator"
      
     
));



}




}
else
{


$sql3 = "DELETE FROM banking WHERE id = '$_REQUEST[id]' ";

if ($conn->query($sql3) === TRUE) {


   echo json_encode(array(



      "ERROR" => "Record was deleted"
      
     
));


} else {
    
  
      echo json_encode(array(



      "ERROR" => "There was an error contact administrator"
      
     
));


}





}



?>