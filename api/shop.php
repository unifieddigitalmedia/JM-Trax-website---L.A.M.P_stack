<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";


$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$shops = array();


if ($_SERVER["REQUEST_METHOD"] === "GET")
{


$sql = "SELECT * FROM shops ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row1 = $result->fetch_assoc()) {

$shop = array(

      "id" => $row1[id],
      "name" => $row1[name], 
      "address" => $row1[address],
     
      );


array_push($shops,$shop);


}

}

echo json_encode(array_values($shops));



}

else if ($_SERVER["REQUEST_METHOD"] === "POST")

{


$sql1 = "INSERT INTO shops (name, address,shop_limit)

VALUES ('$_REQUEST[shop_name]', '$_REQUEST[shop_address]','$_REQUEST[shop_limit]')";

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



$sql3 = "DELETE FROM shops WHERE id = '$_REQUEST[id]' ";

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