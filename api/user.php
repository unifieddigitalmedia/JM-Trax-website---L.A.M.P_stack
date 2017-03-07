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





}else 
{
  $firstthree = substr($_REQUEST[firstname],0, 3);
  

  $lastthree  = substr($_REQUEST[lastname], 0, 3);



  $sql = "SELECT * FROM users WHERE 
  SendersFirstName LIKE '%$firstthree%'  ||  SendersLastName LIKE '%$lastthree%' || Mobile = '$_REQUEST[mobile]'  ";

}

}







$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row2 = $result->fetch_assoc()) {
$user = array(

    "id" => $row2[id], 
'username' => $row2[username] , 
'password'  =>  $row2[password] , 
'secretquestion'  =>  $row2[secretquestion] , 
'secretanswer'  =>  $row2[secretanswer] , 
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
'Email'  => $row2[Email] , 
'Sourceoffunds'  => $row2[Sourceoffunds] ,
'IDtype'  => $row2[IDtype] , 
'Dnumber'  => $row2[IDnumber] , 
'IDexpiry'  => $row2[IDexpiry], 
'IDcountry'  => $row2[IDcountry] , 
'IDURL' =>  $row2[IDURL] ,
'AddressURL'  =>  $row2[AddressURL] ,
'IncomeURL'  => $row2[IncomeURL] ,
'Enabled'  => $row2[Enabled] ,
'Occupation' =>  $row2[Occupation] ,
'shop' =>  $row2[Shop] ,


      );


array_push($users,$user);




}
}


echo json_encode($users);


}
else if ($_SERVER["REQUEST_METHOD"] === "POST")
{


$date = date("Y-m-d");

$sql = "SELECT * FROM users WHERE username = '$_REQUEST[username_field]' ";

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

if(!$_REQUEST[username_field])

{

$username = $_REQUEST[mobile];

}
else 
{
$username = $_REQUEST[username_field] ;

}


$temppassword = str_shuffle("1234567890qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM");

$temppassword = substr($temppassword,0,8);


if(!$_REQUEST[password_field])

{

$password = $temppassword;

}
else 

{

$password = $_REQUEST[password_field] ;

}

if(!$_REQUEST[email])

{

$email = $_REQUEST[mobile];

}
else 

{

$email = $_REQUEST[email] ;

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
                Occupation,Shop )
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
          '$email',
          '',
          '$_REQUEST[IDtype]',
          '$_REQUEST[IDnumber]',
          '$_REQUEST[IDexpiry]',
          '$_REQUEST[IDcountry]',
          '',
          '',
          '',
          'on',
          '$_REQUEST[occupation]','$_REQUEST[shop_name]')";

if ($conn->query($sql2) === TRUE) {

  
  echo json_encode(array(



      "ERROR" => ""
      
     
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


$sql = "SELECT * FROM users WHERE username = '$_REQUEST[username_field]' && id <> '$_REQUEST[id]' ";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

if ($result->num_rows > 0) {

echo json_encode(array(



      "ERROR" => "That username is being used by another user"
      
     
));


}

else

{

$sql1 = "SELECT * FROM users WHERE Mobile = '$_REQUEST[mobile]' && id <> '$_REQUEST[id]'";

$result1 = $conn->query($sql1);

$row1 = $result1->fetch_assoc();

if ($result1->num_rows > 0) {


echo json_encode(array(



      "ERROR" => "That mobile is being used by another user"
      
     
));


}else {
	
	
	
	if(!$_REQUEST[email])

{

$email = $_REQUEST[mobile];

}
else 

{

$email = $_REQUEST[email] ;

}


	
	$sql2 = "UPDATE users SET 

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
                Email = '$email' , 
                Sourceoffunds = '' , 
                IDtype = '$_REQUEST[IDtype]' , 
                IDnumber = '$_REQUEST[IDnumber]' , 
                IDexpiry = '$_REQUEST[IDexpiry]' , 
                IDcountry = '$_REQUEST[IDcountry]' , 
                IDURL = '' , 
                AddressURL = '' , 
                IncomeURL = '' , 
                Enabled = '' , Shop ='$_REQUEST[shop_name]',
                Occupation = '$_REQUEST[occupation]' 
               
                 WHERE id = '$_REQUEST[id]'
                 
                 "
;

if ($conn->query($sql2) === TRUE) {

  
  echo json_encode(array(



      "ERROR" => ""
      
     
));




} else {

    
     echo json_encode(array(



      "ERROR" => "There was an error contact administrator"
      
     
));



}
	
	
	
	
}


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


