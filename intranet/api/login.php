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



$sqlLoggedinUser = "SELECT * FROM loggedinusers WHERE username = '$_REQUEST[username]' ";

$resultLoggedinUser = $conn->query($sqlLoggedinUser);

$rowLoggedinUser = $resultLoggedinUser->fetch_assoc();

if ($resultLoggedinUser->num_rows > 0) {

echo json_encode(array(
      "ERROR" => "You are logged in elsewhere. You will need to answer your secret question to log in",
      "ERRORTYPE"=> "1",
      "SECRETQUESTION"=> $row[secretquestion],
      "SECRECTANSWER"=> $row[secretanswer],
      "USERTYPE"=> $row[usertype]
      ));


}
else
{

$sql2 = "INSERT INTO loggedinusers (username) VALUES ('$_REQUEST[username]') ";


if ($conn->query($sql2) === TRUE) {

echo json_encode(array(


      "ERROR" => "",
      "USERTYPE"=> $row[usertype],
      "SHOP"=> $row[Shop],
      "EMAIL"=> $row[Mobile],
      "AGENTID"=> $row[id],
      "AGENTUSERNAME"=> $row[username],
      "CREDITLIMIT"=> $row[limit],
      "SENDERFIRSTNAME"=> $row[SendersFirstName],
      "SENDERLASTNAME"=> $row[SendersLastName],
      "sendersID"=> $row[id]
));


}
else{


echo json_encode(array(


      "ERROR" => "There was an error.Please contact web administrator."
      
     
));


}




}



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