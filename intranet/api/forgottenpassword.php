<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



if ($_SERVER["REQUEST_METHOD"] === "GET")
{




$sql = "SELECT * FROM users WHERE email = '$_REQUEST[email]' ";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

$date = date("Y-m-d");



$temppassword = str_shuffle("1234567890qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM");

$temppassword = substr($temppassword,0,8);

$sql1 = "UPDATE users SET password = '$temppassword' , datemodified = '$date' WHERE id = '$row[id]' ";
 
 
if ($conn->query($sql1) === TRUE) {

$message = "Please use the temporary password ".$temppassword." to log in and change";

     echo json_encode(array(

      "ERROR" => $message
      
     
));

} else {

      echo json_encode(array(


      "ERROR" => "New record created successfully"
      
     
));



}


}

?>