<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$transfers = array();

if ($_SERVER["REQUEST_METHOD"] === "GET")

{
	
	if($_REQUEST[firstname] && $_REQUEST[lastname])
	
	
	{
		$sql2 = "SELECT * FROM deletedtransfers WHERE recipientfirstname = '$_REQUEST[firstname]' && recipientsurname ='$_REQUEST[lastname]' ";

	}
else
if ($_REQUEST[agenttype] === 'administrator')

{

$sql2 = "SELECT * FROM deletedtransfers ";


}

else if ($_REQUEST[agenttype] === 'user')

{


$sql2 = "SELECT * FROM deletedtransfers WHERE agentusername = '$_REQUEST[agentusername]' ";


}
else if($_REQUEST[sendersMobile])
{
	
	
	$sql2 = "SELECT * FROM deletedtransfers WHERE sendermobile = '$_REQUEST[sendersMobile]' ";


	
	
}


$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {

    while($row2 = $result2->fetch_assoc()) {


$value =  $row2[date] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."-".$month."-".$year;

$transfer = array(

     "id"=>$row2[orderID],
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
"date" =>$date,
"shop"=>$row2[shop],
"customerref"=>$row2[customerref],
"rate"=>$row2[rate],
"status"=>$row2[status]
);

array_push($transfers , $transfer );



}




}

echo json_encode($transfers);


}
else if ($_SERVER["REQUEST_METHOD"] === "POST")

{

$date = date("Y-m-d");

$ngn = str_replace(',', '' , $_REQUEST[ngn]);

$sql2 = "INSERT INTO transfers (

                senderfirstname,
                senderlasttname,
                line1,
                line2,
                line3,
                town,
                sendercounty,
                postcode,
                senderphone,
                sendermobile,
                senderemail,
                recipientsurname,
                recipientfirstname,
                recipientphone,
                bankac,
                bankname,
                recmobilephoneprex,
                paymentref,
                shopacc,
                paypalemail,
                reasonfortransfer,
                agentusername,
                remittance,
                ngn,
                amount,
                totalgbp,
                fee,
                date,
                shop,
                customeref,
                rate,uksms,ngnsms)

VALUES ('$_REQUEST[senderfirstname]',
          '$_REQUEST[senderlasttname]',
          '$_REQUEST[line1]',
          '$_REQUEST[line2]',
          '$_REQUEST[line3]',
          '$_REQUEST[town]',
          '$_REQUEST[sendercounty]',
          '$_REQUEST[postcode]',
          '$_REQUEST[senderphone]',
          '$_REQUEST[sendermobile]',
          '$_REQUEST[senderemail]',
          '$_REQUEST[recipientsurname]',
          '$_REQUEST[recipientfirstname]',
          '$_REQUEST[recipientphone]',
          '$_REQUEST[bankac]',
          '$_REQUEST[bankname]',
          '$_REQUEST[recmobilephoneprex]',
          '$_REQUEST[paymentref]',
          '$_REQUEST[shopacc]',
          '$_REQUEST[paypalemail]',
          '$_REQUEST[reasonfortransfer]',
          '$_REQUEST[agentusername]',
          '$_REQUEST[remittance]',
          '$ngn',
          '$_REQUEST[amount]',
          '$_REQUEST[totalgbp]',
          '$_REQUEST[fee]',
          '$date',
          '$_REQUEST[shop]',
          '$_REQUEST[customerref]',
          '$_REQUEST[rate]',
          '$_REQUEST[uksms]',
          '$_REQUEST[ngnsms]')";

if ($conn->query($sql2) === TRUE) {

  
$last_id = $conn->insert_id;

  echo json_encode(array(



      "ERROR" => "Transaction has been posted. Proceed to checkout.","orderID"=>$last_id
      
     
));







} else {

    
     echo json_encode(array(



      "ERROR" => "There was an error contact administrator"
      
     
));





}

}
else if ($_SERVER["REQUEST_METHOD"] === "DELETE")

{


$sql3 = "DELETE FROM transfers WHERE id = '$_REQUEST[id]' ";

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