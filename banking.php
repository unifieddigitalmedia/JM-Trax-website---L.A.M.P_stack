<?php


$servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



if(isset($_GET["excelreport"])) {

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

require_once $root.'/api/PHPExcel/Classes/PHPExcel.php';

require_once $root.'/api/PHPExcel/Classes/PHPExcel/IOFactory.php';

PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator('JM Trax')
->setLastModifiedBy("Victor Amos")
->setTitle("Office 2007 XLSX Test Document")
->setSubject("Office 2007 XLSX Test Document")
->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
->setKeywords("office 2007 openxml php");


$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','AGENT');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','DATE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','AMOUNT');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','PAYMENT REF');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1','BANK');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1','COMMENTS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1','SHOP');



if($_REQUEST[agenttype] == 'supervisor'){


if($_REQUEST[fromdate] && $_REQUEST[todate]) {
  

$split_startdate = explode("-", $_REQUEST[fromdate]); 

$start_date = $split_startdate[2].'-'.$split_startdate[1].'-'.$split_startdate[0]; 


$split_enddate = explode("-", $_REQUEST[todate]); 

$end_date = $split_enddate[2].'-'.$split_enddate[1].'-'.$split_enddate[0]; 


$sql = "SELECT * FROM banking WHERE (date <= '$end_date' && date >= '$start_date') && shop = '$_REQUEST[agentshop]' ORDER BY date";



}
else {
  
$sql = "SELECT * FROM banking WHERE shop = '$_REQUEST[agentshop]' ORDER BY date ";
  
  
}


$result1 = $conn->query($sql);

 $counter = 2 ;
 
 
while($row = $result1->fetch_assoc()) {


$value =  $row[date];
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."/".$month."/".$year;



$first_day_of_month = mktime(0,0,0,date('n'),1,date('Y')); 
$last_day_of_month = mktime(23,59,59,date('n'),date('t'),date('Y')); 

$split_date = explode("-", $row[date]); 


$comp_date = mktime(0,0,0,$split_date[1],$split_date[2],$split_date[0]); 




$value =  $row[date] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."-".$month."-".$year;

$orderID = 'JM'.$row[id];


if($_REQUEST[fromdate] && $_REQUEST[todate]) {
	
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(0).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['agent']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(1).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$date);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(2).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['amount']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(3).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['paymenttype']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(4).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['bank']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(5).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['comments']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(6).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['shop']);

}
else{
  
  if (($comp_date >= $first_day_of_month) && ($comp_date <= $last_day_of_month)) {
  
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(0).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['agent']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(1).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$date);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(2).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['amount']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(3).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['paymenttype']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(4).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['bank']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(5).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['comments']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(6).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['shop']);


}

  
}



$counter = $counter +1;





}







} else if($_REQUEST[agenttype] == 'administrator' )

{



if($_REQUEST[fromdate] && $_REQUEST[todate]) {
  

$split_startdate = explode("-", $_REQUEST[todate]); 

$start_date = $split_startdate[2].'-'.$split_startdate[1].'-'.$split_startdate[0]; 


$split_enddate = explode("-", $_REQUEST[todate]); 

$end_date = $split_enddate[2].'-'.$split_enddate[1].'-'.$split_enddate[0]; 


$sql1 = "SELECT * FROM banking WHERE date <= '$end_date' && date >= '$start_date' ORDER BY date";



}

else {
  
$sql1 = "SELECT * FROM banking ORDER BY date";
  
  
}


$result1 = $conn->query($sql1);
 $counter = 2 ;
 
while($row = $result1->fetch_assoc()) {


$value =  $row[date];
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."/".$month."/".$year;



$first_day_of_month = mktime(0,0,0,date('n'),1,date('Y')); 
$last_day_of_month = mktime(23,59,59,date('n'),date('t'),date('Y')); 

$split_date = explode("-", $row[date]); 


$comp_date = mktime(0,0,0,$split_date[1],$split_date[2],$split_date[0]); 




$value =  $row[date] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."-".$month."-".$year;

$orderID = 'JM'.$row[id];


if($_REQUEST[fromdate] && $_REQUEST[todate]) {
	
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(0).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['agent']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(1).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$date);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(2).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['amount']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(3).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['paymenttype']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(4).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['bank']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(5).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['comments']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(6).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['shop']);

}
else{
  
  if (($comp_date >= $first_day_of_month) && ($comp_date <= $last_day_of_month)) {
  
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(0).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['agent']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(1).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$date);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(2).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['amount']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(3).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['paymenttype']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(4).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['bank']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(5).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['comments']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(6).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['shop']);


}

  
}



$counter = $counter +1;





}





} else{


if($_REQUEST[fromdate] && $_REQUEST[todate]) {
  

$split_startdate = explode("-", $_REQUEST[fromdate]); 

$start_date = $split_startdate[2].'-'.$split_startdate[1].'-'.$split_startdate[0]; 


$split_enddate = explode("-", $_REQUEST[todate]); 

$end_date = $split_enddate[2].'-'.$split_enddate[1].'-'.$split_enddate[0]; 


$sql2 = "SELECT * FROM banking WHERE (date <= '$end_date' && date >= '$start_date') && agent = '$_REQUEST[agentusername]' ";


}

else {
  
  $sql2 = "SELECT * FROM banking WHERE agent = '$_REQUEST[agentusername]' ";
  

  
}

$result1 = $conn->query($sql2);
 $counter = 2 ;
while($row = $result1->fetch_assoc()) {


$value =  $row[date];
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."/".$month."/".$year;



$first_day_of_month = mktime(0,0,0,date('n'),1,date('Y')); 
$last_day_of_month = mktime(23,59,59,date('n'),date('t'),date('Y')); 

$split_date = explode("-", $row[date]); 


$comp_date = mktime(0,0,0,$split_date[1],$split_date[2],$split_date[0]); 


 


$value =  $row[date] ;
$day =  substr("$value",8,2);
$month = substr("$value",5,2);
$year =  substr("$value",0,4);
$date = $day."-".$month."-".$year;

$orderID = 'JM'.$row[id];


if($_REQUEST[fromdate] && $_REQUEST[todate]) {
	
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(0).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['agent']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(1).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$date);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(2).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['amount']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(3).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['paymenttype']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(4).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['bank']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(5).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['comments']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(6).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['shop']);

}
else{
  
  if (($comp_date >= $first_day_of_month) && ($comp_date <= $last_day_of_month)) {
  
$cellAlias = PHPExcel_Cell::stringFromColumnIndex(0).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['agent']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(1).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$date);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(2).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['amount']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(3).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['paymenttype']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(4).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['bank']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(5).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['comments']);

$cellAlias = PHPExcel_Cell::stringFromColumnIndex(6).$counter;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellAlias,$row['shop']);


}

  
}



$counter = $counter +1;






}




}








$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
ob_end_clean();

header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="report.xls"');
$objWriter->save('php://output');
  
  
  
}




?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="styles/normal.css">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

<link rel="icon" 
      type="image/png" 
      href="images/jmtrax_icon.png">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


<title> Just Money Transfers | Banking </title>


</head>

<body ng-cloak ng-app="justmoneytransfers">

  

 
<header ng-controller="menucontroller">


<ul class="topnav">

<li class="logo_link"> <a href="index.html"><img src="images/logo.png" class="logo" ></a> </li>

<li class="dropdown-link"> <a href="dashboard.php" class="dropbtn"> Dashboard</a>  

</li>  

<li class="dropdown-link" ng-hide="usertype"> <a class="dropbtn" >Administration</a> 

<div class="dropdown-content">

  <a href="banks.html" > Banks </a>  

  <a href="commission-fees.php" > Commission Fees</a>  

  <a href="customers.html" > Customers </a>

  <a href="exchange-rates.html" ng-show="reportrights"> Exchange Rates</a>  

  <a href="shops.html" > Shops </a> 

  <a href="users.html"> Users </a>   

</div>


</li>  

<li class="dropdown-link"> <a class="dropbtn" >Reports</a>  

<nav class="dropdown-content">

  <a href=""> Banking</a> 

   <a href="daily-transactions-receipients.html"> Daily Transactions Receipients </a>

  <a href="daily-transactions-senders.html"> Daily Transactions Senders</a>   
  
  <a href="deleted-transactions.html"> Deleted Transactions </a>  

   <a href="receipients.html"> Recipients </a> 

    <a href="sales-report.html" > Sales Report </a> 

  <a href="senders.html"> Senders </a> 

   <a href="transactions.php"> Transactions </a>   <a href="transferslist.php"  ng-hide="usertype"> Transactions List</a>    

</nav>

</li>  

<li class="dropdown-link"> <a href="index.html" class="dropbtn" >Log Out</a> 


</li>  

<li class="icon">
    <a href="javascript:void(0);" style="font-size:15px;" onclick="showResponsivemenu()">  /a>
</li>



</ul></header>




<div class="container-fluid"  ng-controller='banking' >

&nbsp;

<div class="row"  ng-init="getbanking()">


    <div class="col-sm-4"  style="background-color:black;color:white;padding:10px;" >


<form name='transsearchform' >
<table class="table " >
    <thead>
      
    </thead>
    <tbody>
      <tr>
        <td>START DATE (dd/mm/yyyy) </td>
        <td><input type="text" class="form-control" id="datepicker" ng-model='startdate' required ></td>
        <td> 



        </td>
      </tr>
      <tr>
        <td>END DATE (dd/mm/yyyy)</td>
        <td><input type="text" class="form-control" id="datepicker1" required ng-model="enddate"></td>
         <td> 



         </td>
      </tr>
      <tr>
        <td><button type="button" class="form-control" id="" ng-click='clear()' > CLEAR</button></td>
        <td colspan="2"><button type="button" class="form-control" id="" ng-click='gettransactionsbysearch()' > SEARCH</button></td>
 
      </tr>
    </tbody>
  </table>

</form>

  
</div>
 <div class="col-sm-8" >


<div class="row">
  <div class="col-sm-2"> <label for="usr">*DATE</label><input type="text" class="form-control input-sm" id='datepicker2' name='startdate'   ></div>
  <div class="col-sm-2"> <label for="usr">*AMOUNT</label><input type="text" class="form-control input-sm"  id='amount' name='amount' class=''   ng-model='amount'></div>
  <div class="col-sm-2"> <label for="usr">*PAYMENT REF</label><select name='payment' style="background-color:#FCC;" ng-model='payment' class="form-control input-sm"><option value='ONLINE' > ONLINE </option> <option value='CASH' > CASH </option> <option value='BANK' > BANK </option> <option value='CASH PICKUP' > CASH PICKUP </option><option value='CUSTOMER TRANSFER' > CUSTOMER TRANSFER </option></select> </div>
  <div class="col-sm-2"> <label for="usr">BANK</label>
  <select class="form-control input-sm" style="background-color:#FCC;" ng-options="bank as bank.ref for bank in bankslist | filter:bank.type='payee' "  ng-change="bankdropdownfunction()" ng-model="bankdropdown"  id="bank"></select>
</div>
<div class="col-sm-2"> <label for="usr">SHOP</label>

<input type="text" class="form-control input-sm"  id='shop' name='shop' class='' ng-model='shop'>

</div>
  </div>
&nbsp;
<span style='color:red;font-weight:bold;'> {{bankingerrors}} </span>
&nbsp;
<div class="row">
   <div class="col-sm-10">
<label for="comment">*Comment:</label>
  </div>
  <div class="col-sm-2">

  </div>
</div>

<div class="row">
   <div class="col-sm-10">
<textarea class="form-control input-sm" id='comments' name='comments' rows="4" cols="50"  ng-model='comments'></textarea>
  </div>
  <div class="col-sm-2">
  <button type="button" class="btn btn-primary btn-md" ng-click="adddeposit()" >ADD BANKING </button>
  </div>
</div>




</div>
</div>

&nbsp;

<div class="row">
  <div class="col-sm-12" >
    <div style='float:right;'>
  <p>

<a href="banking-reports.html" style="color:red;font-weight:bold;" > Export to PDF </a>
  </p>
 <p>

<form action='banking.php' method="GET" >
<input type='hidden' class='agenttype' name='agenttype' />
<input type='hidden' class='agentusername' name='agentusername' />
<input type='hidden' class='agentshop' name='agentshop' />
<input type='hidden' class='fromdate' name='fromdate' />
<input type='hidden' class='todate' name='todate' />
<input type ='hidden' name='excelreport' value='submit' />

<button type="submit" class="btn btn-link" ng-click="excel()">Export to Excel  </button>
</form>
  </p>
  </div>
 </div>
</div>



&nbsp;


 <table >
   
    <tbody>
      <tr ng-repeat="(key, value) in banklist | groupBy: 'shop' " >

        <td colspan="11">  <b style="cursor: pointer;"> {{key}}</b>  </br> 

<table class="table table-bordered " id="{{key}}" >

 <thead>

      <tr>
        <td>AGENT</td>
        <td>DATE</td>
        <td>AMOUNT</td>
        <td>PAYMENT REFERENCE</td>
        <td>BANK</td>
        <td>COMMENTS</td>
         <td>SHOP</td>
      </tr>



    </thead>
       <tbody>


        <tr ng-repeat='bank in value'>
        <td>{{bank.agent}}</td>        
        <td>{{bank.date}}</td>
        <td>{{bank.amount}}</td>
        <td>{{bank.paymenttype}}</td>
        <td>{{bank.bankname}}</td>
        <td>{{bank.comments}}</td>
        <td>{{bank.shop}}</td>
        <td><button type='button' ng-click='deletedeposit($index)' class="btn btn-link" ng-show="reportrights"> DELETE </button> </td>
        </tr>

<tr>  <td colspan='2'> </td>

  <td>{{ value | sumByKey:'amount' }}  </td> 

  <td colspan='4'> </td> 

  
  </tr> 

</table>




      </tbody>

</table>





        </td>
       
      </tr>

    </tbody>
  </table>


</div>


<footer>
<div class="row">

  <div class="col-sm-6" id="footer_column_1">  


<p>Authorised User can log into JM Transfers by entering correct account information on the right hand side. The activity of authorized users may be monitored. If monitoring reveals evidence of criminal activity, systems personnel may provide the evidence to management and/or law enforcement officials. Just Computers trading as JM Transfer and JM Trax have a comprehensive compliance program within the organisation to ensure compliance with government rules, regulations and approved guidance. We do not want JM Transfer and JM Trax services to be used in illegal money laundering activities or terrorist activities. It is our policy that we follow both the letter and the spirit of the law and the regulations of both the United Kingdom and Nigeria in which JM Transfer and JM Trax operates. All remittances processed by JM Transfer and JM Trax are screened with enhanced controls to prevent money laundering and terrorist financing. It is JM Transfer and JM Trax policy to follow both the letter and spirit of the law and regulations. Throughout the world, Governments have reinforced their commitment to the fight against money laundering and terrorist financing. New laws have imposed additional obligations on firms and individuals in the financial services sector to join in the fight. JM Transfer and JM Trax has an extensive training and awareness programme, a rigorous transaction monitoring system and a robust culture of compliance. JM Transfer and JM Trax works closely with regulatory bodies.</p>


 </div>

  <div class="col-sm-6" id="footer_column_2" style="text-align:center;">  

<img src='images/Photo2_small.png' class="footerimage"/>

   </div>

   

</div>

</footer>



<section class="copywright">

<p style='color:white;'>&copy; UNIFIED DIGITAL MEDIA  - http://www.unifieddigitalmedia.co.uk</p>

  </section>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" ></script>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>

<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.15/angular-resource.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-filter/0.5.8/angular-filter.min.js" ></script>

<script src="scripts/main.js"> </script>

<script type="text/javascript">


var app = angular.module('justmoneytransfers', ['ngResource','calfilter','angular.filter']);

app.controller('menucontroller', function($scope,$http,$resource) {


function getCookie(cname) {

    var name = cname + "=";
  
    var ca = document.cookie.split(';');
  
    for(var i=0; i<ca.length; i++) {
  
        var c = ca[i];
  
        while (c.charAt(0)==' ') c = c.substring(1);
  
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
  
    }
  
    return "";

}

var init = function () {
   

if(!getCookie('agentusername') || getCookie('agenttype') == 'customer' )

{


window.location = "index.html" ;


}



if( getCookie('agenttype') == 'user'  )

{ 

$scope.usertype = true;


}
if( getCookie('agenttype') == 'supervisor'  )

{ 

$scope.reportrights = false;


}
if( getCookie('agenttype') == 'user'   )

{ 

$scope.reportrights = false;


}

var counter = 0;

setInterval(function(){ counter = counter + 1 ;


window.addEventListener("mousemove",function getcoords() {


counter = 0;

});

if (counter == '1800')

{




window.location = "index.html" ;



} },1000);


};

init();





});


app.factory('Banking_Service', ['$resource', function($resource) {

var resource = $resource('api/banking.php',{

date:"@date",
amount:"@amount",
payment_ref:"@payment_ref",
bank:"@bank",
agent:"@agent",
comment:"@comment",
agentype:"@agentype",
shop:"@shop"



},{ 'update': { method:'PUT' } } );





return resource;


}]);


app.controller('banking', function($scope,Banking_Service,$http,$resource) {


var init = function () {
   
document.getElementsByClassName("agenttype")[0].setAttribute("value",getCookie('agenttype'));
document.getElementsByClassName("agentshop")[0].setAttribute("value",getCookie('agentshop'));
document.getElementsByClassName("agentusername")[0].setAttribute("value", getCookie('agentusername'));


$scope.startdate = document.getElementById('datepicker').value;

$scope.enddate = document.getElementById('datepicker1').value;




document.getElementsByClassName("fromdate")[0].setAttribute("value",$scope.startdate);
document.getElementsByClassName("todate")[0].setAttribute("value",$scope.enddate);


$scope.agentid = getCookie('agentid') ;

$scope.agentusername = getCookie('agentusername') ;

$scope.agentemail = getCookie('agentemail') ;

$scope.agenttype = getCookie('agenttype') ;

$scope.creditlimit = getCookie('agentcredit') ;

$scope.shop = getCookie('agentshop') ;

$http.get("api/banks.php").then(function(response) {



 $scope.bankslist = response.data;

 

    });
    

$http.get("api/banking.php?agentshop="+getCookie('agentshop')+"&agentusername="+ getCookie('agentusername')+"&agenttype="+getCookie('agenttype')).then(function(response) {



$scope.banklist = response.data;



    });


};

init();

$scope.clear = function () {

document.getElementsByClassName("fromdate")[0].setAttribute("value","");
document.getElementsByClassName("todate")[0].setAttribute("value","");

$scope.startdate = null;

$scope.enddate = null;

document.cookie = "fromdate=";
document.cookie = "enddate=";



document.getElementsByClassName("fromdate")[0].setAttribute("value","");



}

$scope.gettransactionsbysearch = function () {


$scope.startdate = document.getElementById('datepicker').value;

$scope.enddate = document.getElementById('datepicker1').value;

document.getElementsByClassName("fromdate")[0].setAttribute("value",document.getElementById('datepicker').value);
document.getElementsByClassName("todate")[0].setAttribute("value",document.getElementById('datepicker1').value);







document.cookie = "fromdate=" + document.getElementById('datepicker').value;
document.cookie = "enddate=" + document.getElementById('datepicker1').value;


$http.get("api/banking.php?agentshop="+getCookie('agentshop')+"&agentusername="+ getCookie('agentusername')+"&agenttype="+getCookie('agenttype')+"&startdate="+$scope.startdate+"&enddate="+$scope.enddate).then(function(response) {

$scope.banklist = response.data;




    });



}



function getCookie(cname) {

    var name = cname + "=";
  
    var ca = document.cookie.split(';');
  
    for(var i=0; i<ca.length; i++) {
  
        var c = ca[i];
  
        while (c.charAt(0)==' ') c = c.substring(1);
  
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
  
    }
  
    return "";

}



$scope.adddeposit = function () {

var agent = $scope.agentusername;


var date = document.getElementById("datepicker2").value;


if(date == "" ||
$scope.amount == undefined || $scope.payment == undefined ||  $scope.comments == undefined || agent == "")

{

$scope.bankingerrors = 'Fields with an asterisk are mandatory';

}
else
{

var r = confirm("You are about to add this deposit");


if (r == true) {



var log = Banking_Service.save(

{




date:document.getElementById("datepicker2").value,
amount:$scope.amount,
payment_ref:$scope.payment,
bank:$scope.bankdropdown.bankname,
agent:$scope.agentusername,
agenttype:$scope.agenttype,
comment:$scope.comments,
shop:getCookie('agentshop')



}, function() {



alert(log.ERROR);

document.getElementById("datepicker2").value = "";
$scope.amount = "";
$scope.payment = "";
document.getElementById("bank").value = "";
$scope.comments = "";

init();

  });


}else{
	
	
	
	
}




}




}



$scope.deletedeposit = function (para) {


  
var r = confirm("You are about to delete this deposit");


if (r == true) {




$http.delete(

"api/banking.php?agentusername="+getCookie('agentusername')+"&agenttype="+getCookie('agenttype')+"&id="+$scope.banklist[para].id).then(function(response) {
alert(response.data.ERROR);

init();

});







}
else
{



}

}



});


angular.module('calfilter', [])
    .filter('sumByKey', function() {
        return function(data, key) {
        
            var sum = 0;

            for (var i = data.length - 1; i >= 0; i--) {
            
                sum += parseInt(data[i][key].replace(",", ""));
            
            }
            
      
            var number = sum.toString();

            var dollars = number.split('.')[0];

            var  cents = (number.split('.')[1] || '') +'00';

            var dollars = dollars.split('').reverse().join('').replace(/(\d{3}(.php?!$))/g, '$1,').split('').reverse().join('');

            var cent = cents.slice(0, 2);

            var decimal = ".";

            var cent2 = decimal.concat(cent);

            var dollars = dollars.concat(cent2);
            
            return dollars;
        };
    });


</script>


<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">

$(function() {

 

    $( "#datepicker2" ).datepicker({ dateFormat: "dd-mm-yy" });
  
  });


</script>

<script type="text/javascript">

$(function() {

    $( "#datepicker" ).datepicker({ dateFormat: "dd-mm-yy" });

    $( "#datepicker1" ).datepicker({ dateFormat: "dd-mm-yy" });
  
  });


</script>
</body>

</html>