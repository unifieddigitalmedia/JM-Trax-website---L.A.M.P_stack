<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";


$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$receipient_transfers =array();

if ($_SERVER["REQUEST_METHOD"] === "GET" && !$_REQUEST[username])
{


$sql = "SELECT * FROM transfers WHERE recipientfirstname = '$_REQUEST[firstname]' &&  recipientsurname = '$_REQUEST[lastname]'  ";






}else{




$sql = "SELECT * FROM transfers WHERE sendermobile = '$_REQUEST[username]' &&  recipientfirstname = '$_REQUEST[firstname]' &&   recipientsurname= '$_REQUEST[lastname]' ";





}



$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row2 = $result->fetch_assoc()) {

$value =  $row2[date] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."-".$month."-".$year;

$receipient_transfer = array(

     "id"=>$row2[id],
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
"totalngn" => $row2[ngn],
"totalgbp" => $row2[totalgbp],
"fee" => $row2[fee],
"date" => $date,
"shop"=>$row2[shop],
"customerref"=>$row2[customerref],
"rate"=>$row2[rate],
"status"=>$row2[status]



      );


array_push($receipient_transfers,$receipient_transfer);




}
}


echo json_encode($receipient_transfers);


?>