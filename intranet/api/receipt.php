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


$transactions = array();

$sql2 = "SELECT * FROM transfers WHERE id = '$_REQUEST[id]' ";

$result2 = $conn->query($sql2);

$row2 = $result2->fetch_assoc();

$value =  $row2[date];

$day =  substr("$value",8,2);

$month = substr("$value",5,2);

$year =  substr("$value",0,4);

$date = $day."-".$month."-".$year;



$t = array(
	
"tnum" => $row2[id],
"tdate" => $date,
"senderfirstname" => $row2[senderfirstname],
"senderlasttname" => $row2[senderlasttname],
"line1" => $row2[line1],
"line2" => $row2[line2],
"line3" => $row2[line3],
"town" => $row2[town],
"sendercountry" => $row2[sendercountry],
"postcode" => $row2[postcode],
"senderphone" => $row2[senderphone],
"sendermobile" => $row2[sendermobile],
"senderemail" => $row2[senderemail],
"recipientsurname" => $row2[recipientsurname],
"recipientfirstname" => $row2[recipientfirstname],
"recipientphone" => $row2[recipientphone],
"bankac" => $row2[bankac],
"bankname" => $row2[bankname],
"recmobilephoneprex" => $row2[recmobilephoneprex],
"paymentref" => $row2[paymentref],
"shopacc" => $row2[shopacc],
"paypalemail" => $row2[paypalemail],
"reasonfortransfer" => $row2[reasonfortransfer],
"agentusername" => $row2[agentusername],
"remittance" => $row2[remittance],
"ngn" => $row2[ngn],
"amount" => $row2[amount],
"totalngn" => $row2[totalngn],
"totalgbp" => $row2[totalgbp],
"fee" => $row2[fee],
"date" => $date,
"shop"=>$row2[shop],
"customerref"=>$row2[customeref],
"rate"=>$row2[rate],
"cash"=>$row2[cash],
"change"=>$row2[change],


      );



array_push($transactions,$t);


echo json_encode($transactions);

}




?>