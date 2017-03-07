<?php $servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";
$conn = new mysqli($servername, $username, $password,$dbname);

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 




$transactionlist =array();

if ($_SERVER["REQUEST_METHOD"] === "GET")
{

if($_REQUEST[agenttype] == 'supervisor'){

if($_REQUEST[startdate] && $_REQUEST[enddate]) {
  

$split_startdate = explode("-", $_REQUEST[startdate]); 

$start_date = $split_startdate[2].'-'.$split_startdate[1].'-'.$split_startdate[0]; 


$split_enddate = explode("-", $_REQUEST[enddate]); 

$end_date = $split_enddate[2].'-'.$split_enddate[1].'-'.$split_enddate[0]; 


$sql3 = "SELECT * FROM banking WHERE (date <= '$end_date' && date >= '$start_date') && shop = '$_REQUEST[agentshop]' ORDER BY date";



}
else {
  
$sql3 = "SELECT * FROM banking WHERE shop = '$_REQUEST[agentshop]' ORDER BY date ";
  
  
}


$result = $conn->query($sql3);

while($row3 = $result->fetch_assoc()) {


$value =  $row3[date];
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."-".$month."-".$year;

$transaction = array(

      "id" => $row3[id], 
      "comments" => $row3[comments],
      "date" => $date,
      "amount" => $row3[amount],
      "paymenttype" => $row3[paymenttype],
      "bank" => $row3[bank],
      "dailysales" => $row3[dailysales],
      "transfers" => $row3[transfers],
      "agent" => $row3[agent],
      "shop" => $row3[shop]

      );

$first_day_of_month = mktime(0,0,0,date('n'),1,date('Y')); 
$last_day_of_month = mktime(23,59,59,date('n'),date('t'),date('Y')); 
$split_date = explode("-", $row3[date]); 
$comp_date = mktime(0,0,0,$split_date[1],$split_date[2],$split_date[0]); 

if($_REQUEST[startdate] && $_REQUEST[enddate]) {
array_push($transactionlist,$transaction);  


}
else{
  
  if (($comp_date >= $first_day_of_month) && ($comp_date <= $last_day_of_month)) {
  
array_push($transactionlist,$transaction);  


}

  
}


}

echo json_encode($transactionlist);


}
else if($_REQUEST[agenttype] == 'administrator' )
{

if($_REQUEST[startdate] && $_REQUEST[enddate]) {
	

$split_startdate = explode("-", $_REQUEST[startdate]); 

$start_date = $split_startdate[2].'-'.$split_startdate[1].'-'.$split_startdate[0]; 


$split_enddate = explode("-", $_REQUEST[enddate]); 

$end_date = $split_enddate[2].'-'.$split_enddate[1].'-'.$split_enddate[0]; 


$sql = "SELECT * FROM banking WHERE date <= '$end_date' && date >= '$start_date' ORDER BY date";



}
else {
	
$sql = "SELECT * FROM banking ORDER BY date";
	
	
}


$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {


$value =  $row[date];
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."-".$month."-".$year;

$transaction = array(

      "id" => $row[id], 
      "comments" => $row[comments],
      "date" => $date,
      "amount" => $row[amount],
      "paymenttype" => $row[paymenttype],
      "bank" => $row[bank],
      "dailysales" => $row[dailysales],
      "transfers" => $row[transfers],
      "agent" => $row[agent],
          "shopname" => $row[shop]

      );

$first_day_of_month = mktime(0,0,0,date('n'),1,date('Y')); 
$last_day_of_month = mktime(23,59,59,date('n'),date('t'),date('Y')); 
$split_date = explode("-", $row[date]); 
$comp_date = mktime(0,0,0,$split_date[1],$split_date[2],$split_date[0]); 

if($_REQUEST[startdate] && $_REQUEST[enddate]) {
array_push($transactionlist,$transaction);	


}
else{
	
	if (($comp_date >= $first_day_of_month) && ($comp_date <= $last_day_of_month)) {
	
array_push($transactionlist,$transaction);	


}

	
}


}

echo json_encode($transactionlist);

}
else
{

if($_REQUEST[startdate] && $_REQUEST[enddate]) {
	

$split_startdate = explode("-", $_REQUEST[startdate]); 

$start_date = $split_startdate[2].'-'.$split_startdate[1].'-'.$split_startdate[0]; 


$split_enddate = explode("-", $_REQUEST[enddate]); 

$end_date = $split_enddate[2].'-'.$split_enddate[1].'-'.$split_enddate[0]; 


$sql1 = "SELECT * FROM banking WHERE (date <= '$end_date' && date >= '$start_date') && agent = '$_REQUEST[agentusername]' ";


}

else {
	
	$sql1 = "SELECT * FROM banking WHERE agent = '$_REQUEST[agentusername]' ";
	

	
}



$result1 = $conn->query($sql1);

while($row1 = $result1->fetch_assoc()) {


$value =  $row1[date];
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."/".$month."/".$year;

$transaction = array(

      "id" => $row1[id], 
      "comments" => $row1[comments],
      "date" => $date,
      "amount" => $row1[amount],
      "paymenttype" => $row1[paymenttype],
      "bank" => $row1[bank],
      "dailysales" => $row1[dailysales],
      "transfers" => $row1[transfers],
      "agent" => $row1[agent],
       "shopname" => $row[shop]

      );



$first_day_of_month = mktime(0,0,0,date('n'),1,date('Y')); 
$last_day_of_month = mktime(23,59,59,date('n'),date('t'),date('Y')); 

$split_date = explode("-", $row1[date]); 


$comp_date = mktime(0,0,0,$split_date[1],$split_date[2],$split_date[0]); 

if($_REQUEST[startdate] && $_REQUEST[enddate]) {
	
array_push($transactionlist,$transaction);	


}
else{
	
	
	if (($comp_date >= $first_day_of_month) && ($comp_date <= $last_day_of_month)){
	


array_push($transactionlist,$transaction);  

}

	
}







}

echo json_encode(array_values($transactionlist));


}
}
else if ($_SERVER["REQUEST_METHOD"] === "POST")

{



$value2 = trim($_REQUEST[date]);
$startday=  substr("$value2",0,2);
$startmonth=  substr("$value2",3,2);
$startyear =  substr("$value2",8,2);
$date = "20".$startyear."-".$startmonth."-".$startday;


$recipients = array();

if($_REQUEST[agenttype] == 'supervisor'){

$sql = "SELECT * FROM users WHERE usename = '$_REQUEST[agent]' ";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

array_push($recipients, $row[email],"vamoslawanson@gmail.com");



}else{

array_push($recipients,"vamoslawanson@gmail.com");




}
//$headers .= 'Cc: somebody@domain.com' . "\r\n";


$sql1 = "INSERT INTO banking (date, amount, paymenttype ,bank ,dailysales ,transfers ,agent,`comments`,`shop`)

VALUES ('$date', '$_REQUEST[amount]', '$_REQUEST[payment_ref]', '$_REQUEST[bank]', '$_REQUEST[sales]', '$_REQUEST[num_transfers]', '$_REQUEST[agent]','$_REQUEST[comment]','$_REQUEST[shop]')";

if ($conn->query($sql1) === TRUE) {



$email = $receipients ;
$subject = "Banking Deposit";
$message =" $_REQUEST[agent] of $_REQUEST[shop] has made a deposit of £ $_REQUEST[amount] on $_REQUEST[date]. Payment reference is $_REQUEST[payment_ref] Bank $_REQUEST[bank] ." ;
//mail($email, "Subject: $subject",$message, "From:just-computers@hotmail.com");
mail(implode(',', $recipients), "Subject: $subject",$message, "From:just-computers@hotmail.com");


  echo json_encode(array(



      "ERROR" => "New record created successfully"
      
     
));




} else {

    
     echo json_encode(array(



      "ERROR" => "There was an error contact administrator"
      
     
));



}




}
else
{


$recipients = array();

if($_REQUEST[agenttype] == 'supervisor'){

$sql = "SELECT * FROM users WHERE usename = '$_REQUEST[agentusername]' ";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

array_push($recipients, $row[email],"vamoslawanson@gmail.com");



}else{

array_push($recipients,"vamoslawanson@gmail.com");




}


$sql1 = "SELECT * FROM banking WHERE id = '$_REQUEST[id]' ";

$result1 = $conn->query($sql1);

$row1 = $result1->fetch_assoc();


$sql3 = "DELETE FROM banking WHERE id = '$_REQUEST[id]' ";

if ($conn->query($sql3) === TRUE) {


$email = $receipients ;
$subject = "Banking Deposit Deleted";
$message =" $_REQUEST[agentusername] has delted banking deposit of £ $row1[amount] on . Payment reference is $row1[paymenttype] Bank $row1[bank] ." ;
mail(implode(',', $recipients), "Subject: $subject",$message, "From:just-computers@hotmail.com");

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