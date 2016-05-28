<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$rates = array();

if ($_SERVER["REQUEST_METHOD"] === "GET")
{



$sql = "SELECT * FROM rates ";

$result = $conn->query($sql);

while($row = $result->fetch_assoc())

{

$rate = array(

      "rate" => $row[rate],
      "code" => $row[code]

      );

array_push($rates,$rate);

}


echo json_encode($rates);


}
else if ($_SERVER["REQUEST_METHOD"] === "POST")
{




$sql1 = $sql = "UPDATE rates SET rate ='$_REQUEST[gbp]' WHERE code ='GBP/NGN'";
 
if ($conn->query($sql1) === TRUE) {



$sql2 =  "UPDATE rates SET rate ='$_REQUEST[ngn]' WHERE code ='NGN/GBP'";
 
if ($conn->query($sql2) === TRUE) {


$sql3 = "SELECT * FROM rates ";

$result3 = $conn->query($sql3);

while($row3 = $result3->fetch_assoc())

{

$rate = array(

      "rate" => $row3[rate],
      "code" => $row3[code]

      );

array_push($rates,$rate);

}


echo json_encode($rates);


} else {


       echo json_encode(array(


      "ERROR" => "There was an error please contact administrator"
      
        
       ));



}




} else {


       echo json_encode(array(


      "ERROR" => "There was an error please contact administrator"
      
        
       ));



}




}

?>