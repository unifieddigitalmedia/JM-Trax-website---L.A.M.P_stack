<?php 

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$servername = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname = substr($url["path"], 1);

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 




if ($_SERVER["REQUEST_METHOD"] === "PUT")

{




$sql = "UPDATE transfers SET paymentdate = '$_REQUEST[paymentdate]' , sendingbank ='$_REQUEST[sendingbank]' , paymentmethod = '$_REQUEST[paymentmethod]' , status = 'paid' WHERE id = '$_REQUEST[id]' ";
 
if ($conn->query($sql) === TRUE) {

     echo json_encode(array(


      "ERROR" => "Record was updated successfully"
      
     
));

} else {

      echo json_encode(array(



      "ERROR" => "New record created successfully"
      
     
));



}






}

else if ($_SERVER["REQUEST_METHOD"] === "GET")

{
	
	$transfers = array();
	

$sql2 = "SELECT * FROM transfers WHERE id = '$_REQUEST[transaction_number]' ";

$result2 = $conn->query($sql2);

$row2 = $result2->fetch_assoc();

$value =  $row2[date];

$day =  substr("$value",8,2);

$month = substr("$value",5,2);

$year =  substr("$value",0,4);

$date = $day."-".$month."-".$year;

$t = array(

"id" => $row2[id],
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
"rate"=>$row2[rate]

      );

array_push(	$transfers,$t);


echo json_encode($transfers);



}

else

{



$sql1 = "SELECT * FROM transfers WHERE id = '$_REQUEST[id]' ";

$result1 = $conn->query($sql1);

$row2 = $result1->fetch_assoc();

$sql2 = "INSERT INTO deletedtransfers (

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
                `date`,
                shop,
                customeref,
                rate,uksms,ngnsms,orderID)

VALUES ('$row2[senderfirstname]',
          '$row2[senderlasttname]',
          '$row2[line1]',
          '$row2[line2]',
          '$row2[line3]',
          '$row2[town]',
          '$row2[sendercounty]',
          '$row2[postcode]',
          '$row2[senderphone]',
          '$row2[sendermobile]',
          '$row2[senderemail]',
          '$row2[recipientsurname]',
          '$row2[recipientfirstname]',
          '$row2[recipientphone]',
          '$row2[bankac]',
          '$row2[bankname]',
          '$row2[recmobilephoneprex]',
          '$row2[paymentref]',
          '$row2[shopacc]',
          '$row2[paypalemail]',
          '$row2[reasonfortransfer]',
          '$row2[agentusername]',
          '$row2[remittance]',
          '$row2[date]',
          '$row2[amount]',
          '$row2[totalgbp]',
          '$row2[fee]',
          '$row2[date]',
          '$row2[shop]',
          '$row2[customerref]',
          '$_REQUEST[rate]',
          '$_REQUEST[uksms]',
          '$row2[ngnsms]',
          '$_REQUEST[id]')";

if ($conn->query($sql2) === TRUE) {


$sql3 = "DELETE FROM transfers WHERE id = '$_REQUEST[id]' ";

if ($conn->query($sql3) === TRUE) {


$email = "service@jmtrax.com,justmtransfers@gmail.com" ;
$subject = "Transaction Deleted";
$message =" $_REQUEST[agentusername] deleted transaction JM$_REQUEST[id]. That was sending to $row2[senderfirstname] $row2[senderlasttname] in the amount of £ $row2[amount] - $row2[ngn] NGN." ;
mail($email, "Subject: $subject",$message, "From:just-computers@hotmail.com");



   echo json_encode(array(



      "ERROR" => "Record was deleted"
      
     
));


} else {
    
  
      echo json_encode(array(



      "ERROR" => "There was an error contact administrator"
      
     
));


}



} else {




}







}


?>