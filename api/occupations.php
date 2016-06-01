<?php 


header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

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

$questions =array();

$sql = "SELECT * FROM banks LIMIT 10 ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

$occupation = preg_replace('/[^A-Za-z0-9\-]/',' ',$row[bankname]);

$question = array(

      "occupation" => $occupation, 
     
      );


array_push($questions,$question);




}



}

echo json_encode($questions);
}


?>