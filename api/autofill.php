<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

} 


$container_array =array();

$sender_array =array();

$receipient_array =array();

$shop_arra =array();


$sql = "SELECT * FROM users WHERE id = '$_REQUEST[username]' ";

$result = $conn->query($sql);


while($row = $result->fetch_assoc()) {



$sender_array = array( "SendersFirstName"=> $row[SendersFirstName] ,
                "SendersLastName"=> $row[SendersLastName],
                "Line1"=> $row[Line1],
                "Line2"=> $row[Line2],
                "Line3"=> $row[Line3],
                "Town"=> $row[Town],
                "Postcode"=> $row[Postcode],
                "County"=> $row[County],
                "Country"=> $row[Country],
                "Mobile"=> $row[Mobile],
                "Email"=> $row[Email] );


array_push($container_array ,$sender_array );
}



$sql1 = "SELECT * FROM receipients WHERE ReceipientFirstName = '$_REQUEST[receipient_firstname]' && ReceipientLastName = '$_REQUEST[receipient_lastname]' && ReceipientBank = '$_REQUEST[receipient_bank]' && ReceipientAccountNumber = '$_REQUEST[receipient_banknumber]'   ";

$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
	
while($row1 = $result1->fetch_assoc()) {

$receipient_array = array(



                "ReceipientFirstName"=> $row1[ReceipientFirstName] ,
                "ReceipientLastName"=> $row1[ReceipientLastName],
                "ReceipientBank"=> $row1[ReceipientBank],
                "ReceipientAccountNumber"=> $row1[ReceipientAccountNumber],
                "ReceipientReasonForTransfer"=> $row1[ReceipientReasonForTransfer],
                "ReceipientPaymentReference"=> $row1[ReceipientPaymentReference],
                "ReceipientPhone"=> $row1[ReceipientPhone],
                "ReceipientPayPal"=> $row1[ReceipientPayPal],
                "ReceipientShopAccount"=> $row1[ReceipientShopAccount],
                "ReceipientThirdPartyPaymentComment"=> $row1[ReceipientThirdPartyPaymentComment],

      
     
);


array_push($container_array, $receipient_array);

}
}
                

$sql2 = "SELECT * FROM users WHERE username = '$_REQUEST[agentusername]' ";

$result2 = $conn->query($sql2);

$row2 = $result2->fetch_assoc();

$shop_array = array(  "Shop"=> $row2[Shop]  );
               





array_push($container_array,$shop_array );


echo json_encode($container_array);


?>
