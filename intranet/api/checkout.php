<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


if ($_SERVER["REQUEST_METHOD"] === "PUT")

{


$sql = "UPDATE transfers SET cash = '$_REQUEST[cash]' , `change` ='$_REQUEST[change]' WHERE id = '$_REQUEST[id]' ";
 
if ($conn->query($sql) === TRUE) {

     


$sql1 = "SELECT * FROM transfers WHERE id = '$_REQUEST[id]' ";

$result = $conn->query($sql1);

$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
  

$countrycode = 44;
$phone = $row[sendermobile];
$email = "@textmagic.com";
$recipient = $countrycode."".$row[sendermobile]."".$email;


$email = "service@jmtrax.com,justmtransfers@gmail.com" ;
$subject = "New Transaction";
$message =" Transaction No:$row[id] for $row[senderfirstname] $row[senderlasttname] sending to $row[recipientfirstname] $row[recipientsurname] in $row[bankname] Account No. $row[bankac]. The amount being sent is NGN $row[ngn]." ;
mail($email, "Subject: $subject",$message, "From:just-computers@hotmail.com");


if($row[uksms] == 'true' )
{




$subject = "Welcome to JM Trax" ;
$message =" Dear $row[senderfirstname] $row[senderlasttname], This confirm your transfer with us and your reference is JM$row[id] . The amount being sent is NGN  $row[ngn] to $row[recipientfirstname] $row[recipientsurname]" ;



	if(mail($recipient,"Subject: $subject", $message, "From: justmtrax@gmail.com" )){
	
	
	$errormessage = "Record was updated successfully. Confirmation email was sent to $row[sendermobile]" ;
	
}
else {
	
	
	$errormessage = "Record was updated successfully.No confirmation email was sent." ;
	
}
}



if(!empty($row[ngnsms]) || $row[ngnsms] != 'false')
{

$to = "+234".''.$row[receipientphone];


$user = "jmtrax";
$password = "n3L5Hpth";
$api_id = "3511481";
$baseurl ="http://api.clickatell.com";


$text = urlencode("Dear $row[recipientfirstname] $row[recipientsurname],
$row[SendersFirstName] $row[SendersLastName] has processed the sum of $row[ngn] to credit your $row[bankname] using JM-Transfer. This will be processed shortly otherwise allow 24-48hrs before checking your account statement if the bank has not alerted you. Thanks for using JM-Transfer.");

$url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";


$ret = file($url);

$sess = explode(":",$ret[0]);

if ($sess[0] == "OK") {

$sess_id = trim($sess[1]);

$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text&from=447506775414";

$ret = file($url);

$send = explode(":",$ret[0]);

if ($send[0] == "ID") {

} else {

}
} else {

}




}


    

} else {

}




     
      
echo json_encode(array(
    "ERROR" => $errormessage));
    
     



} else {

      echo json_encode(array(



      "ERROR" => "There was an error please contact administrator"
      
     
));



}



}



?>