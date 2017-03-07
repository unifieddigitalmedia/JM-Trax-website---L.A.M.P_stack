<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 




 $sql2 = "SELECT * FROM transfers";


$result2 = $conn->query($sql2);



    while($row2 = $result2->fetch_assoc()) {


      $date = substr($row2[date], 0, -9);

$sql = "UPDATE transfers SET Tdate = '$date' WHERE id='$row2[id]' ";

if ($conn->query($sql) === TRUE) {

    echo " $date";

} else {

    echo "Error updating record: " . $conn->error;

}




   }

?>