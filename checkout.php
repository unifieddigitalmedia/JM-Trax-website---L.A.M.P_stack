
<?php

$servername = "localhost";
$username = "jmtrax";
$password = "s0na@bebe123";
$dbname = "jmtrax";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$root = realpath($_SERVER["DOCUMENT_ROOT"]);

$target_dir = $root;

if(isset($_POST["customerreceipt"])) {

$target_file = $target_dir .'/receipts/'. $_REQUEST[trandsactionnumber].'-'. basename($_FILES["receipttoupload"]["name"]);


if (move_uploaded_file($_FILES["incomefiletoupload"]["tmp_name"], $target_file)) {

 updatesender(para,'IncomeURL');
       
    
    } else {
    

       

    }


}

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



<title> Just Money Transfers |  Order </title>


</head>

<body ng-cloak ng-app="justmoneytransfers">

	

 


<header ng-controller="menucontroller" ng-hide="usertype">

<ul class="topnav">

<li class="logo_link"> <a href="index.html"><img src="images/logo.png" class="logo" ></a> </li>

<li class="dropdown-link"> <a href="dashboard.php" class="dropbtn"> Dashboard</a>  

</li>  

<li class="dropdown-link" ng-hide="innerusertype"> <a class="dropbtn" >Administration</a> 

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

  <a href="banking.php"> Banking</a> 

 <a href="daily-transactions-receipients.html"> Daily Transactions Receipients</a>

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
    <a href="javascript:void(0);" style="font-size:15px;" onclick="showResponsivemenu()">☰</a>
</li>



</ul></header>


<header ng-controller="menucontroller" ng-show="usertype">


<ul class="topnav">

<li class="logo_link"> <a href="index.html"><img src="images/logo.png" class="logo" ></a> </li>

<li class="dropdown-link"> <a href="money-transfer-calculator.html" class="dropbtn"> Transfer Calculator</a>  

</li>  

<li class="dropdown-link"> <a class="dropbtn" >My Account</a> 

<div class="dropdown-content">

  <a href="personal-details.html"> Personal Details </a>  

   <a href="beneficiary-details.html"> Beneficiaries </a>  

 

</div>


</li>  

<li class="dropdown-link"> <a class="dropbtn"  >Settings</a>  


</li>  

<li class="dropdown-link"> <a href="index.html" class="dropbtn" >Log Out</a> 


</li>  

<li class="icon">
    <a href="javascript:void(0);" style="font-size:15px;" onclick="showResponsivemenu()">☰</a>
</li>



</ul></header>


<div class="container-fluid"  ng-controller='checkout' >


  <div class="row">

    <div class="col-sm-6" >


<div class="row">

<div class="col-sm-6" > <p> TOTAL DUE </p> </div>
<div class="col-sm-6" > <input class="form-control input-sm" id="inputsm" type="text" ng-model="total"> </div>

</div>


    </div>

    <div class="col-sm-6" >



<div class="row">

<div class="col-sm-6" > </div>
<div class="col-sm-6" > </div>

</div>




    </div>
  

</div>

<!-- -->

  <div class="row">

    <div class="col-sm-6" >


<div class="row">

<div class="col-sm-6" > <p> CASH  TENURED </p> </div>
<div class="col-sm-6" >  <input class="form-control input-sm" id="inputsm" type="text" ng-model="cash" ng-change="cashpaid()"></div>

</div>


    </div>

    <div class="col-sm-6" >



<div class="row">

<div class="col-sm-6" > </div>
<div class="col-sm-6" > </div>

</div>




    </div>
  

</div>

<!-- -->


  <div class="row">

    <div class="col-sm-6" >


<div class="row">

<div class="col-sm-6" > <p> CHANGE  DUE </p> </div>
<div class="col-sm-6" >  <input class="form-control input-sm" id="inputsm" type="text" ng-model="change"></div>


</div>


    </div>

    <div class="col-sm-6" >



<div class="row">

<div class="col-sm-6" > </div>
<div class="col-sm-6" >  </div>

</div>




    </div>
  

</div>

<!-- -->

  <div class="row">

    <div class="col-sm-6" >


<div class="row">

<div class="col-sm-6" ></div>
<div class="col-sm-6" > </div>

</div>


    </div>

    <div class="col-sm-6" >



<div class="row">

<div class="col-sm-6" > </div>
<div class="col-sm-6" >  <button type="button" class="btn btn-primary btn-block" ng-click="checkout()"> Checkout with cash </button>  </div>

</div>




    </div>
  

</div>



<!-- -->


  <div class="row">

    <div class="col-sm-6" >


<div class="row">

<div class="col-sm-6" >  </div>
<div class="col-sm-6" > </div>

</div>


    </div>

    <div class="col-sm-6" >



<div class="row">

<div class="col-sm-6" > </div>
<div class="col-sm-6" > -- or -- </div>

</div>

<div clas='row'>

<div class="col-sm-6"> </div>
<div class="col-sm-6" style="text-align:center;"> Pay via PayPal; you can pay with your credit card if you do not have a PayPal account. 
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input alt="PayPal - The safer, easier way to pay online." name="submit" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_checkout_pp_142x27.png" type="image" ng-click='completetransfer(<?php echo $_SESSION[neworder]; ?>)'/>
<img src="https://www.paypal.com/en_AU/i/scr/pixel.gif" alt="" width="1" height="1" border="0" />
<input name="cmd" type="hidden" value="_xclick" />
<input name="business" type="hidden" value="vamoslawanson@hotmail.com" />
<input name="item_name" type="hidden" class="tnum"  />

<input name="amount" type="hidden" class="gbptotal" />
<input name="return" type="hidden" value="http://www.192.168.0.90/intranet/receipt.html" />
<input name="no_shipping" type="hidden" value="0" />
<input name="currency_code" type="hidden" value="GBP" />
<input name="callback_url" type="hidden" value="http:/192.168.0.90/intranet/" />

</form></div>

</div>



    </div>
  

</div>

<!-- -->
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

<script src="scripts/main.js"> </script>

<script type="text/javascript">


var app = angular.module('justmoneytransfers', ['ngResource']);



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
   
if( getCookie('agenttype') == 'user'  )

{ 

$scope.innerusertype = true;


}


if( getCookie('agenttype') == 'customer'  )

{ 

$scope.usertype = true;


}




};

init();





});



app.factory('Checkout_Service', ['$resource', function($resource) {

var resource = $resource('api/checkout',{


username:"@username",
cash:"@cash",
change:"@change",
id:"@id",
agentusername:"@agentusername"





},{ 'update': { method:'PUT' } } );





return resource;


}]);


app.controller('checkout', function($scope,Checkout_Service,$http,$resource) {


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


$scope.cashpaid = function() {

var change = $scope.cash - $scope.total;


$scope.change = Number(change).toFixed(2); 


}


var init = function () {
   

$scope.total  = getCookie('gbp_total');


document.getElementsByClassName("gbptotal")[0].setAttribute("value",getCookie('gbp_total'));

$scope.tnum = "JM"+getCookie('transaction_number');

document.getElementsByClassName("tnum")[0].setAttribute("value",$scope.tnum);


if(!getCookie('agentusername') )

{


window.location = "index.html" ;


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



$scope.checkout = function() {

alert('Order being updated . Please wait.');

if($scope.total == undefined || $scope.cash  == undefined ||  $scope.change == undefined)

{


alert("Cash tenured is needed");

}

else

{


var log = Checkout_Service.update (

{

//username : getCookie('sender_username'),

username : getCookie('sendersid'),
id:getCookie('transaction_number'),
agentusername:getCookie('agentusername'),
cash : $scope.cash,
change : $scope.change,

} , function() {


if(log.ERROR){ alert(log.ERROR);}

window.location = "receipt.html" ;


  });


}



}


});






</script>


</body>

</html>