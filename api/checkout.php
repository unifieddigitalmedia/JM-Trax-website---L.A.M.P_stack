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


if ($_SERVER["REQUEST_METHOD"] === "PUT")

{


$sql = "UPDATE transfers SET cash = '$_REQUEST[cash]' , `change` ='$_REQUEST[change]' WHERE id = '$_REQUEST[id]' ";
 
if ($conn->query($sql) === TRUE) {

     


echo json_encode(array(
    "ERROR" => "Record was updated successfully" ));
    
$sql1 = "SELECT * FROM transfers WHERE id = '$_REQUEST[id]' ";

$result = $conn->query($sql1);

$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
  



$phone1 = substr($row[sendermobile],0,1);

if ($phone1 == 0 )

{

$countrycode = 44;
$phone = substr($row[sendermobile],1);
$email = "@textmagic.com";
$recipient = $countrycode."".$phone."".$email;
$a = $countrycode."".$phone;
}
else

{

$countrycode = 44;
$phone = $row[sendermobile];
$email = "@textmagic.com";
$recipient = $countrycode."".$row[sendermobile]."".$email;
$a = $countrycode."".$row[sendermobile];

}


$email = "service@jmtrax.com,justmtransfers@gmail.com" ;
$subject = "New Transaction";
$message =" Transaction No:$row[id] for $row[senderfirstname] $row[senderlasttname] sending to $row[recipientfirstname] $row[recipientsurname] in $row[bankname] Account No. $row[bankac]. The amount being sent is NGN $row[ngn]." ;
mail($email, "Subject: $subject",$message, "From:just-computers@hotmail.com");


if(!empty($row[uksms]) || $row[uksms] != 'false' )
{





$subject = "Welcome to JM Trax" ;
$message =" Dear $row[senderfirstname] $row[senderlasttname], This confirm your transfer with us and your reference is JM$row[id] . The amount being sent is NGN $TotalDueNGN to $row[recipientfirstname] $row[recipientsurname]" ;
mail($recipient, "Subject: $subject",
$message, "From:service@ifixedcomputers.com" );


}




if(!empty($row[ngnsms]) || $row[ngnsms] != 'false')
{


$to = "234". $row[recipientphone];


$text = urlencode("Dear $row[recipientfirstname] $row[recipientsurname],
$row[SendersFirstName] $row[SendersLastName] has processed the sum of $row[ngn] to credit your $row[bankname] using JM-Transfer. This will be processed shortly otherwise allow 24-48hrs before checking your account statement if the bank has not alerted you. Thanks for using JM-Transfer.");

$url = "http://api.clickatell.com/http/auth?user=jmtrax&password=Olori123&api_id=3511481";

$ret = file($url);

$sess = explode(":",$ret[0]);

if ($sess[0] == "OK") {

$sess_id = trim($sess[1]);


$url = "http://api.clickatell.com/http/sendmsg?session_id=$sess_id&to=$to&text=$text&from=447506775414";

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




     
      
     



} else {

      echo json_encode(array(



      "ERROR" => "There was an error please contact administrator"
      
     
));



}



}



?>