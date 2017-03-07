<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";




$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 




 if ($_SERVER["REQUEST_METHOD"] === "PUT")

{

if($_REQUEST['email']){
	
	
	/* $email = $_REQUEST['email'] ;
	
	try
{   
 
 
   require 'pdfcrowd.php';



    $client = new Pdfcrowd("username", "apikey");
    header("Content-Type: application/pdf");
    header("Cache-Control: max-age=0");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename=\"receipt.pdf\"");

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

$target_dir = $root;

$usersURL = '/senders/'.$row[sendermobile].'/'.receipt.'-'.$row[id].'-'.date("Y-m-d h:i:s").'.pdf';

$usersURL = str_replace(" ","-",$usersURL);

$target_users = $target_dir.$usersURL;

$out_file = fopen($target_users, "wb");

$sql2 = "SELECT * FROM transfers WHERE id = '$_REQUEST[id]' ";

$result2 = $conn->query($sql2);

$row2 = $result2->fetch_assoc();

$value =  $row2[date];

$day =  substr("$value",8,2);

$month = substr("$value",5,2);

$year =  substr("$value",0,4);

$date = $day."-".$month."-".$year;



$client->convertHtml("<table border='1' style='font-size:9px;font-family:Arial, Helvetica, sans-serif;  position:relative; top:-10px; width:700px; left:-5px;' ><tr> <td colspan='3' style='font-size:9px;font-weight:bold; text-align:center;' > <p> CLIENT'S COPY<br/> Just Money Transfers <br/> 82 High Street, London, SE25 6EA  <br/>Tel:02087715353 Fax:02087717766 Email:service@jmtransfers.co.uk</p> </td> <td colspan='2' style='font-size:9px;font-weight:bold; text-align:center;'> <img src='http://justcomputersparts.co.uk/logocopy.png' width='180px' height='50px'/></td></tr>

<tr> <td colspan='3' style='font-size:9px;font-weight:bold; text-align:center;'>SENDER DETAILS   </td> <th colspan='2' rowspan='2'> Transaction No: $row2[id]  </th>  </tr>

<tr> <td style='font-size:9px;font-weight:bold; text-align:center;' > FIRST NAME  </td> <td style='font-size:9px;font-weight:bold; text-align:center;' > LAST NAME  </td> <td style='font-size:9px;font-weight:bold; text-align:center;'>ADDRESS </td>   </tr>

<tr> <td style='font-size:9px;font-weight:bold;text-transform:uppercase;' >  $row2[senderfirstname]  </td> <td style='font-size:9px;font-weight:bold;text-transform:uppercase;'>   $row2[senderlastname] </td> <td style='font-size:9px;text-transform:uppercase;'>  $row2[line1 ]  </td> <th rowspan='2' style='font-size:9px;font-weight:bold;'>Cust No.  $row2[sendersID] </th> <th rowspan='2' > Date :   $d </th> </tr>

<tr> <td style='font-size:9px;font-weight:bold; text-align:center;'>  2nd LINE ADDRESS </td> <td style='font-size:9px;font-weight:bold; text-align:center;'> 3RD LINE ADDRESS  </td> <td style='font-size:9px;font-weight:bold; text-align:center;'>TOWN </td>  </tr>

<tr> <td style='font-size:9px;text-transform:uppercase;'>   $row2[line2] </td> <td style='font-size:9px;text-transform:uppercase;'>   $row2[line3] </td> <td style='font-size:9px;text-transform:uppercase;'>  $row2[town] </td> <td >Agency Code:</td> <td class='foreignamount' >  $row2[agency] </td> </tr>

<tr> <td style='font-size:9px;font-weight:bold; text-align:center;'> POSTCODE </td> <td style='font-size:9px;font-weight:bold; text-align:center;'> COUNTRY  </td> <td style='font-size:9px;font-weight:bold; text-align:center;'>MOBILE</td>  <td style='font-size:9px;font-weight:bold; text-align:center;'>  NGN </td> <td>  $row2[paymentlocal] </td>  </tr>

<tr> <td style='font-size:9px;text-transform:uppercase;'>  $row2[postcode] </td> <td style='font-size:9px;text-transform:uppercase;'>  $row2[sendercountry] </td> <td style='font-size:9px;text-transform:uppercase;'> $row2[sendermobile] </td>


<td style='font-size:9px;font-weight:bold;text-align:center; '>Rate </td> <td>  $row2[rate] </td>
</tr>



<tr> <td colspan='3' style='font-size:9px;font-weight:bold; text-align:center;'> BENEFICARY DETAILS  </td>  <td style='font-size:9px;font-weight:bold; text-align:center;'> Amount GBP</td> <td> £ $row2[amount] </td> </tr>

<tr> <td style='font-size:9px;font-weight:bold; text-align:center;'>  FIRST NAME </td> <td style='font-size:9px;font-weight:bold; text-align:center;'>  LAST NAME </td> <td style='font-size:9px;font-weight:bold; text-align:center;' > ADDRESS</td> <td style='font-size:9px;font-weight:bold; text-align:center;'>Commission </td> <td>   £ $row2[fee] </td></tr>

<tr> <td style='font-size:9px;font-weight:bold;text-transform:uppercase;' >  $row2[recipientfirstname] </td> <td style='font-size:9px;font-weight:bold;text-transform:uppercase;' >   $row2[recipientsurname]   </td> <td style='font-size:9px;text-transform:uppercase;'>  $row2[recipientaddress]  </td> <td style='font-size:12px;font-weight:bold;text-align:right;' rowspan='2'>Total Due GBP </td> <td style='font-size:12px;font-weight:bold;text-align:left; ' rowspan='2'>  £ $row2[totalgbp]   </td> </tr>

<tr> <td style='font-size:9px;font-weight:bold; text-align:center;'>  PAYMENT REF </td> <td style='font-size:9px;font-weight:bold; text-align:center;'>  SHOP ACCOUNT </td> <td style='font-size:9px;font-weight:bold; text-align:center;'> PAY PAL EMAIL</td>



</tr>

<tr> <td style='font-size:9px;text-transform:uppercase;'>    $row2[paymentref] </td> <td style='font-size:9px;text-transform:uppercase;'>   $row2[shopacc] </td> <td style='font-size:9px;text-transform:uppercase;'>  $row2[paypalemail]  </td> <td style='font-size:9px;font-weight:bold; text-align:center;'> Cash Tenured </td> <td> £ $row2[cash] </td>



</tr>

<tr> <td style='font-size:9px;font-weight:bold; text-align:center;'>  COUNTRY </td> <td style='font-size:9px;font-weight:bold; text-align:center;'>  MOBILE </td> <td style='font-size:9px;font-weight:bold; text-align:center;'> ADDRESS <td style='font-size:9px;font-weight:bold; text-align:center;'> Change Given </td> <td>  £ $row2[change] </td> </td>



</tr>



<tr> <td style='font-size:9px;text-transform:uppercase;'>   $row2[recipientcountry]  </td> <td style='font-size:9px;text-transform:uppercase;'>  $row2[recipientphone] </td> <td style='font-size:9px;text-transform:uppercase;'>  $row2[destination] </td> <td rowspan='2' style='font-size:12px;font-weight:bold;text-align:right; '><b>TOTAL NGN DUE</b> </td> <td rowspan='2'><b style='font-size:12px;font-weight:bold;text-align:right; '> $row2[ngn]  </b></td> </tr>



<tr> <td  style='font-size:9px;font-weight:bold; text-align:center;'> PAYING AGENT</td> <td style='font-size:9px;font-weight:bold; text-align:center;'> ACCOUNT NO  </td> <td style='font-size:9px;font-weight:bold; text-align:center;'>CUSTOMER REF:</td> </tr>

<tr> <td style='font-size:9px;text-transform:uppercase;' >   $row2[bankname]  </td> <td style='font-size:9px;text-transform:uppercase;'> $row2[bankac]  </td>  <td style='font-size:9px;text-transform:uppercase;'>   $row2[customerref]</td> <td colspan='2'><b> $row2[comment]   </b></td></tr> </table>

<p style='font-size:8px;color:sienna; width:200px; font-family:Arial, Helvetica, sans-serif;position:relative; top:-5px; width:100%;text-align:center '>

PLEASE READ CAREFULLY, BEFORE SIGNING THIS PAYMENT ORDER FORM. (THE FORM) YOU ARE ENTERING INTO IS A LEGAL BINDING AGREEMENT WITH J.M Transfer 

BY SIGNING THE FORM, YOU GIVE YOUR EXPLICIT CONSENT TO THE EXECUTION OF THE TRANSACTION. THIS CONSENT CANNOT BE WITHDRAWN.

You (Sender) agree to provide J.M Transfer with full and accurate information to the best of your knowledge as required for the purposes of the Service, otherwise J.M Transfer may not make the Transfer to the Beneficiary. You (Sender) are strongly advised against sending money to any person that you do not know.
J.M Transfer reserves the right at all times to refuse to process any order, at any stage, which is believed, in its sole discretion, is connected in any manner to money laundering activity or any other unlawful purposes. The sender (You) guarantees that the money to be transferred belongs solely to him/her and is not intended for or derived from any illegal activity.
You (Sender) may contact J.M Transfer through its Customer Services by telephone on 020 8771 5353 during normal business hours 09:00 to 19:00 for the address and hours of operation, by post at 82 High Street, South Norwood, London SE25 6EA or by 
<a href='mailto:service@jmtransfers.co.uk' style='text-decoration: underline;'> email:service@jmtransfers.co.uk</a></p>


<p>I declare that all the information in this order is correct and approved by me</p>



</p>


 
<div style='font-size:9px; border-bottom:#000 solid medium; width:220px; font-family:Arial, Helvetica, sans-serif; font-size:9px; text-align:center; position:relative;  left:10px; top:17px;' >
<p>Sender’s Signature	</p>
<p>  $row2[senderfirstname] $row2[senderlastname]  </p>

</div>


<div style='font-size:9px;border-bottom:#000 solid medium;  width:220px; font-family:Arial, Helvetica, sans-serif; font-size:9px; text-align:center; left:450px; position:relative; top:-35px;' >
<p>Sending Agent Representative Signature	</p>
<p>  $row2[agency] </p>
</div>", $out_file);

fclose($out_file);


}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}
	
$subject = "Transaction Deleted";
$message =" Transaction JM$_REQUEST[id] sending N $ngn to $row2[recipientfirstname] $row2[recipientsurname] has beeen deleted by $_REQUEST[agentusername] ." ;
mail($email, "Subject: $subject",$message, "From:just-computers@hotmail.com");
*/


}
else{
	
	
	


$sql = "UPDATE transfers SET paymentdate = '$_REQUEST[paymentdate]' , sendingbank ='$_REQUEST[sendingbank]' , paymentmethod = '$_REQUEST[paymentmethod]' , status = 'PAID' WHERE id = '$_REQUEST[id]' ";
 
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
"rate"=>$row2[rate],
"paymentdate"=>$row2[paymentdate],
"status"=>$row2[status],
"sendingbank"=>$row2[sendingbank],
"paymentmethod"=>$row2[paymentmethod],
"url"=>$row2[url],

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
                rate,uksms,ngnsms,orderID,reason)

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
          '$row2[ngn]',
          '$row2[amount]',
          '$row2[totalgbp]',
          '$row2[fee]',
          '$row2[date]',
          '$row2[shop]',
          '$row2[customerref]',
          '$_REQUEST[rate]',
          '$_REQUEST[uksms]',
          '$row2[ngnsms]',
          '$_REQUEST[id]','$_REQUEST[reason]')";

if ($conn->query($sql2) === TRUE) {

$ngn = str_replace(',', '' , $row2[ngn]);

$email = "vamoslawanson@gmail.com" ;
$subject = "Transaction Deleted";
$message =" Transaction JM$_REQUEST[id] sending N $ngn to $row2[recipientfirstname] $row2[recipientsurname] has beeen deleted by $_REQUEST[agentusername] ." ;
mail($email, "Subject: $subject",$message, "From:just-computers@hotmail.com");


$countrycode = "44";
$phone = "7506775414";
$email = "@textmagic.com";
$recipient = $countrycode."".$phone."".$email;

mail($recipient,"Subject: $subject", $message, "From: justmtrax@gmail.com" );



$countrycode = "44";
$phone = $row2[sendermobile];
$email = "@textmagic.com";
$recipient = $countrycode."".$phone."".$email;

$message ="Dear $row2[senderfirstname] $row2[senderlasttname] your Transaction JM$_REQUEST[id] has been cancelled or deleted." ;

mail($recipient,"Subject: $subject", $message, "From: justmtrax@gmail.com" );



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



} else {




}







}


?>