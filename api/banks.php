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


$sql = "SELECT * FROM banks ";

$result = $conn->query($sql);

while($row1 = $result->fetch_assoc()) {

$transaction = array(

      "id" => $row1[id], 
      "bankname" => $row1[bankname],
      "bankholder" => $row1[bankholder],
      "accountnumber" => $row1[accountnumber],
      "sortcode" => $row1[sortcode],
      "ref" => $row1[ref],
      "type" => $row1[type],
     
      );


array_push($banks,$transaction);



}

echo json_encode(array_values($banks));

}

else if ($_SERVER["REQUEST_METHOD"] === "POST")

{


$sql1 = "INSERT INTO banks (bankname, bankholder, accountnumber , sortcode , ref , type)

VALUES ('$_REQUEST[bank_name]', '$_REQUEST[bank_holder]', '$_REQUEST[accountnumber]', '$_REQUEST[sortcode]', '$_REQUEST[ref]','$_REQUEST[type]')";

if ($conn->query($sql1) === TRUE) {

  
  echo json_encode(array(



      "ERROR" => "New record created successfully"
      
     
));




} else {

    
     echo json_encode(array(



      "ERROR" => "There was an error contact administrator"
      
     
));



}

}
else
{



$sql3 = "DELETE FROM banks WHERE id = '$_REQUEST[id]' ";

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