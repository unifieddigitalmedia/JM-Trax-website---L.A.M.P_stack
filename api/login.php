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



if ($_SERVER["REQUEST_METHOD"] === "GET")

{


$sql = "SELECT * FROM users WHERE username = '$_REQUEST[username]' ";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

if ($result->num_rows > 0) {


if($row[password] === $_REQUEST[password])

{


$pastdate = date('Y-m-d', strtotime('-90 days'));

if($pastdate > $row[datemodified])

{


echo json_encode(array(


      "ERROR" => "Your password has expired. Please reset by clicking the fortgot password link below."
      
     
));




}

else

{


echo json_encode(array(


      "ERROR" => "",
      "USERTYPE"=> $row[usertype],
      "EMAIL"=> $row[Mobile],
      "AGENTID"=> $row[id],
      "AGENTUSERNAME"=> $row[username],
      "CREDITLIMIT"=> $row[limit],
    "SENDERFIRSTNAME"=> $row[SendersFirstName],
      "SENDERLASTNAME"=> $row[SendersLastName],
      "sendersID"=> $row[id]
        
    
 
));



}


}
else
{


echo json_encode(array(


      "ERROR" => "That password does not match that user",
      "USERTYPE"=> $row[usertype],
      "EMAIL"=> $row[Mobile],
      "AGENTID"=> $row[id],
      "AGENTUSERNAME"=> $row[username],
      "CREDITLIMIT"=> $row[limit],
      "SENDERFIRSTNAME"=> $row[SendersFirstName],
      "SENDERLASTNAME"=> $row[SendersLastName],
      "sendersID"=> $row[id]
        
    
 
));



}


}
else
{


echo json_encode(array(


      "ERROR" => "That username was not found"
      
     
));



}



}




?>