<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$users = array();

if ($_SERVER["REQUEST_METHOD"] === "DELETE")

{


$sql3 = "DELETE FROM loggedinusers WHERE username = '$_REQUEST[username]' ";

if ($conn->query($sql3) === TRUE) {


   echo json_encode(array(



      
     
));


} else {
    
  
      echo json_encode(array(



      "ERROR" => "There was an error contact administrator"
      
     
));


}



}


?>


