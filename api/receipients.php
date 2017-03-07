 <?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$receipients = array();

if ($_SERVER["REQUEST_METHOD"] === "GET")
{


if($_REQUEST[sendersID])

{

$sql = "SELECT * FROM receipients WHERE sendersID = '$_REQUEST[sendersID]' ";


}

else if($_REQUEST[id])

{

$sql = "SELECT * FROM receipients WHERE sendersID = '$_REQUEST[id]' ";


}

else 

{


  $firstthree = substr($_REQUEST[firstname], 0, 5);
  

  $lastthree  = substr($_REQUEST[lastname], 0, 5);


  $sql = "SELECT * FROM receipients WHERE ReceipientFirstName LIKE '%$firstthree%'  &&  ReceipientLastName LIKE '%$lastthree%'  ";


}


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row2 = $result->fetch_assoc()) {
$receipient = array(

"id" => $row2[id],     
"ReceipientFirstName" => $row2[ReceipientFirstName],
"ReceipientLastName"  => $row2[ReceipientLastName],
"ReceipientBank"  => $row2[ReceipientBank], 
"ReceipientAccountNumber"  => $row2[ReceipientAccountNumber],
"ReceipientReasonForTransfer"  => $row2[ReceipientReasonForTransfer],
"ReceipientPaymentReference"  => $row2[ReceipientPaymentReference],
"ReceipientPhone"  => $row2[ReceipientPhone],
"ReceipientPayPal"   => $row2[ReceipientPayPal],
"ReceipientShopAccount"   => $row2[ReceipientShopAccount],
"ReceipientThirdPartyPaymentComment"  => $row2[ReceipientThirdPartyPaymentComment],
"sendersID"  => $row2[sendersID],



      );


array_push($receipients,$receipient);




}


}

echo json_encode($receipients);


}
else if ($_SERVER["REQUEST_METHOD"] === "POST")
{

$sqlfindrec = "SELECT * FROM receipients WHERE ReceipientFirstName = '$_REQUEST[receipientfname]'  &&  ReceipientLastName = '$_REQUEST[receipientlname]'  &&  ReceipientBank = '$_REQUEST[receipientbank]'   && ReceipientAccountNumber = '$_REQUEST[receipientaccountnumber]' ";

$resultrec = $conn->query($sqlfindrec);


if ($resultrec->num_rows > 0) 
{

echo json_encode(array(



      "ERROR" => "That receipient is already registered. Simply update or search and select to process a transfer."
      
     
));


}
else
{

$sql2 = "INSERT INTO receipients (sendersID, ReceipientFirstName, ReceipientLastName, ReceipientBank ,ReceipientAccountNumber ,ReceipientReasonForTransfer ,ReceipientPaymentReference , ReceipientPhone,ReceipientPayPal,ReceipientShopAccount,ReceipientThirdPartyPaymentComment)

VALUES ('$_REQUEST[id]','$_REQUEST[receipientfname]', '$_REQUEST[receipientlname]', 

        '$_REQUEST[receipientbank]', '$_REQUEST[receipientaccountnumber]', 

       '$_REQUEST[receipientreasonfortransfer]', '$_REQUEST[receipientpaymentreference]', 

       '$_REQUEST[receipientphone]','$_REQUEST[receipientpaypal]' ,

       '$_REQUEST[receipientshopacc]','$_REQUEST[receipientthirdpartycomment]' )";

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
else if ($_SERVER["REQUEST_METHOD"] === "PUT")
{



$sql1 = "UPDATE receipients SET ReceipientFirstName = '$_REQUEST[receipientfname]', ReceipientLastName = '$_REQUEST[receipientlname]', 

          ReceipientBank = '$_REQUEST[receipientbank]' ,ReceipientAccountNumber =  '$_REQUEST[receipientaccountnumber]',

          ReceipientReasonForTransfer = '$_REQUEST[receipientreasonfortransfer]' , 

          ReceipientPaymentReference = '$_REQUEST[receipientpaymentreference]' , ReceipientPhone = '$_REQUEST[receipientphone]', ReceipientPayPal = '$_REQUEST[receipientpaypal]',

          ReceipientShopAccount = '$_REQUEST[receipientshopacc]',

          ReceipientThirdPartyPaymentComment = '$_REQUEST[receipientthirdpartycomment]' WHERE id = ' $_REQUEST[id]' "
;

if ($conn->query($sql1) === TRUE) {

  
  echo json_encode(array(



      "ERROR" => ""
      
     
));




} else {

    
     echo json_encode(array(



      "ERROR" => "There was an error contact administrator"
      
     
));



}



}

else if ($_SERVER["REQUEST_METHOD"] === "DELETE")

{


$sql3 = "DELETE FROM receipients WHERE id = '$_REQUEST[id]' ";

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