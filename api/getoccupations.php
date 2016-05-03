<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$banks = array();


if ($_SERVER["REQUEST_METHOD"] === "GET")
{


$sql = "SELECT * FROM occupation ";

$result = $conn->query($sql);

while($row1 = $result->fetch_assoc()) {

$transaction = array(

      "occupation" => $row1[occupation], 
     
     
      );


array_push($banks,$transaction);



}

echo json_encode(array_values($banks));

}








?>