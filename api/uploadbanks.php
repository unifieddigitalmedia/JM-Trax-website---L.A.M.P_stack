<?php


$to = "2348093183139";

$to = "447809183907";

$text = urlencode("Dear $row[recipientfirstname] $row[recipientsurname],
$row[SendersFirstName] $row[SendersLastName] has processed the sum of $row[ngn] to credit your $row[bankname] using JM-Transfer. This will be processed shortly otherwise allow 24-48hrs before checking your account statement if the bank has not alerted you. Thanks for using JM-Transfer.");

$url = "http://api.clickatell.com/http/auth?user=jmtrax&password=Olori123&api_id=3511481";

$ret = file($url);

$sess = explode(":",$ret[0]);

if ($sess[0] == "OK") {

$sess_id = trim($sess[1]);

$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text&from=447506775414";

$url = "http://api.clickatell.com/http/sendmsg?session_id=$sess_id&to=$to&text=$text&from=447506775414";

$ret = file($url);

$send = explode(":",$ret[0]);

if ($send[0] == "ID") {



} else {


}

} else {


}



?>