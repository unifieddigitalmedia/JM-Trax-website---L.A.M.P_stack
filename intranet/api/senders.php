<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$users = array();

if ($_SERVER["REQUEST_METHOD"] === "GET")
{


if($_REQUEST[id])

{

$sql = "SELECT * FROM users WHERE id = '$_REQUEST[id]' ";


}

else 

{
if($_REQUEST[customerusername])
{
	
	
		 $sql = "SELECT * FROM users WHERE username = '$_REQUEST[customerusername]'  ";
		 
		 
}
else if($_REQUEST[username])

{
		 $sql = "SELECT * FROM users WHERE Mobile = '$_REQUEST[username]'  ";
}
else
{
	
	
	
if(!$_REQUEST[firstname] && !$_REQUEST[lastname])

{
	



if($_REQUEST[mobile])
{
	 $sql = "SELECT * FROM users WHERE Mobile = '$_REQUEST[mobile]'  ";

}
else
{
	  $sql = "SELECT * FROM users ";
}





}
else
{
	
	$firstthree = substr($_REQUEST[firstname], 0, 3);
  

  $lastthree  = substr($_REQUEST[lastname], 0, 3);


  $sql = "SELECT * FROM users WHERE SendersFirstName LIKE '%$firstthree%'  &&  SendersLastName && '%$lastthree%'  || Mobile ='$_REQUEST[mobile]' ";


	
}
  
}

}





$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row2 = $result->fetch_assoc()) {

$user = array(

'id'=>$row2[id],
'username' => $row2[username] , 
'password'  =>  $row2[password] , 
'secretquestion'  =>  $row2[secretquestion] , 
'secretanswer'  =>  $row2[answer] , 
'datemodified'  =>  $row2[datemodified], 
'usertype'  =>  $row2[usertype], 
'limit'  =>  $row2[limit], 
'SendersFirstName'  =>  $row2[SendersFirstName] , 
'SendersLastName'  =>  $row2[SendersLastName], 
'Line1'  =>  $row2[Line1] , 
'Line2'  =>  $row2[Line2] , 
'Line3'  =>  $row2[Line3] , 
'Town'  =>  $row2[Town] , 
'Postcode'  =>  $row2[Postcode], 
'County' =>  $row2[County] , 
'Country'  => $_REQUEST[Country] , 
'Mobile'  =>  $row2[Mobile] , 
'Email'  => $row2[Mobile] , 
'Sourceoffunds'  => $row2[Sourceoffunds] ,
'IDtype'  => $row2[IDtype] , 
'Dnumber'  => $row2[IDnumber] , 
'IDexpiry'  => $row2[IDexpiry], 
'IDcountry'  => $row2[IDcountry] , 
'IDURL' =>  $row2[IDURL] ,
'AddressURL'  =>  $row2[AddressURL] ,
'IncomeURL'  => $row2[IncomeURL] ,
'Enabled'  => $row2[Enabled] ,
'Occupation ' =>  $row2[Occupation] ,


      );


array_push($users,$user);




}
}


echo json_encode($users);


}
else if ($_SERVER["REQUEST_METHOD"] === "POST")
{



if(!$_REQUEST[username])

{

$username = $_REQUEST[mobile];

}
else 
{
$username = $_REQUEST[username] ;

}

$date = date("Y-m-d");

$sql = "SELECT * FROM users WHERE username = '$username' ";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

if ($result->num_rows > 0) {


echo json_encode(array(



      "ERROR" => "That username is being used by another user"
      
     
));


}

else

{

$sql1 = "SELECT * FROM users WHERE Mobile = '$_REQUEST[mobile]' ";

$result1 = $conn->query($sql1);

$row1 = $result1->fetch_assoc();

if ($result1->num_rows > 0) {


echo json_encode(array(



      "ERROR" => "That mobile is being used by another user"
      
     
));


}

else

{

if(!$_REQUEST[username])

{

$username = $_REQUEST[mobile];

}
else 
{
$username = $_REQUEST[username] ;

}

/*QWERTYUIOPLKJHGFDSAZXCVBNM*/

$temppassword = str_shuffle("1234567890qwertyuioplkjhgfdsazxcvbnm");

$temppassword = substr($temppassword,0,5);


if(!$_REQUEST[password])

{

$password = $temppassword;

}
else 

{

$password = $_REQUEST[password] ;

}




$sql2 = "INSERT INTO users (
                username,
                password,
                secretquestion,
                secretanswer,
                datemodified,
                datecreated,
                usertype,
                `limit`,
                SendersFirstName,
                SendersLastName,
                Line1,
                Line2,
                Line3,
                Town,
                Postcode,
                County,
                Country,
                Mobile,
                Email,
                Sourceoffunds,
                IDtype,
                IDnumber,
                IDexpiry,
                IDcountry,
                IDURL,
                AddressURL,
                IncomeURL,
                Enabled,
                Occupation )
VALUES ('$username',
          '$password',
          '$_REQUEST[secretquestion]',
          '$_REQUEST[answer]',
          '$date',
          '$date',
          '$_REQUEST[user_type]',
          '$_REQUEST[user_limit]',
          '$_REQUEST[firstname]',
          '$_REQUEST[lastname]',
          '$_REQUEST[line1]',
          '$_REQUEST[line2]',
          '$_REQUEST[line3]',
          '$_REQUEST[town]',
          '$_REQUEST[postcode]',
          '$_REQUEST[county]',
          '$_REQUEST[country]',
          '$_REQUEST[mobile]',
          '$_REQUEST[mobile]',
          '',
          '$_REQUEST[IDtype]',
          '$_REQUEST[IDnumber]',
          '$_REQUEST[IDexpiry]',
          '$_REQUEST[IDcountry]',
          '',
          '',
          '',
          'on',
          '$_REQUEST[occupation]')";

if ($conn->query($sql2) === TRUE) {

$sqlMOBILE = "SELECT * FROM users WHERE Mobile ='$_REQUEST[mobile]' ";

$resultMobile = $conn->query($sqlMOBILE);


$rowMobile = $resultMobile->fetch_assoc();

$countrycode = 44;
$phone = $_REQUEST[mobile];
$email = "@textmagic.com";
$recipient = $countrycode."".$_REQUEST[mobile]."".$email;




$subject = "Welcome to JM Transfers" ;
$message =" This is an email to confirm that you are newly register customer of JM Transfers can can now make transfers from the convince of your home. Please see you login details below. You can change this at anytime from the settings menu.

USERNAME: $username

PASSWORD: $password

";


mail($recipient,"Subject: $subject", $message, "From: justmtrax@gmail.com" );



  echo json_encode(array(



      "ERROR" => "","id"=>$rowMobile[id]
      
     
));




} else {

    
     echo json_encode(array(



      "ERROR" => "There was an error contact administrator"
      
     
));



}



}



}






}
else if ($_SERVER["REQUEST_METHOD"] === "PUT")
{

$date = date("Y-m-d");




$sql1 = "UPDATE users SET 

                username = '$_REQUEST[username_field]' , 
                password = '$_REQUEST[password_field]' , 
                secretquestion = '$_REQUEST[secretquestion]' , 
                secretanswer = '$_REQUEST[answer]' , 
                datemodified = '$date', 
                usertype = '$_REQUEST[user_type]' , 
                `limit` = '$_REQUEST[user_limit]' , 
                SendersFirstName = '$_REQUEST[firstname]' , 
                SendersLastName = '$_REQUEST[lastname]' , 
                Line1 = '$_REQUEST[line1]' , 
                Line2 = '$_REQUEST[line2]' , 
                Line3 = '$_REQUEST[line3]' , 
                Town = '$_REQUEST[town]' , 
                Postcode = '$_REQUEST[postcode]' , 
                County = '$_REQUEST[county]' , 
                Country = '$_REQUEST[country]' , 
                Mobile = '$_REQUEST[mobile]' , 
                Email = '$_REQUEST[mobile]' , 
                Sourceoffunds = '' , 
                IDtype = '$_REQUEST[IDtype]' , 
                IDnumber = '$_REQUEST[IDnumber]' , 
                IDexpiry = '$_REQUEST[IDexpiry]' , 
                IDcountry = '$_REQUEST[IDcountry]' , 
                IDURL = '' , 
                AddressURL = '' , 
                IncomeURL = '' , 
                Enabled = '' , 
                Occupation = '$_REQUEST[occupation]' 
               
                 WHERE id = '$_REQUEST[id]'
                 
                 ";


if ($conn->query($sql1) === TRUE) {

  
  echo json_encode(array(



      "ERROR" => ""
      
     
));




} else {

    
     echo json_encode(array(



      "ERROR" => "There was an error contact administrator"
      
     
));



}



}

else if ($_SERVER["REQUEST_METHOD"] === "DELETE")

{


$sql3 = "DELETE FROM users WHERE id = '$_REQUEST[id]' ";

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


