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





if(isset($_POST["incomefiletouploadsubmit"])) {

$target_file = $target_dir .'/identifications/'. $_REQUEST[sendersID].'-'. basename($_FILES["incomefiletoupload"]["name"]);




if (move_uploaded_file($_FILES["incomefiletoupload"]["tmp_name"], $target_file)) {

 updatesender(para,'IncomeURL');
       
    
    } else {
    

       

    }


}
else if(isset($_POST["personalIDtouploadsubmit"])) {


$target_file = $target_dir .'/identifications/'. $_REQUEST[sendersID].'-'. basename($_FILES["personalIDtoupload"]["name"]);

chmod($target_file, 0755);

if (move_uploaded_file($_FILES["personalIDtoupload"]["tmp_name"], $target_file)) {

 updatesender(para,'IDURL');
        
    
    } else {
    

       


    }

}
else if(isset($_POST["addressIDtouploadsubmit"])) {




$target_file = $target_dir .'/identifications/'. $_REQUEST[sendersID].'-'. basename($_FILES["addressIDtoupload"]["name"]);

chmod($target_file, 0755);

if (move_uploaded_file($_FILES["addressIDtoupload"]["tmp_name"], $target_file)) {


      updatesender(para,'AddressURL');

    
    } else {
    

        


    }


}



function updatesender($para,$para1) {

$url = "https://jmtrax.herokuapp.com/".$para;


$sql1 = "UPDATE users SET para1 = '$url'  WHERE Mobile = '$_REQUEST[sendersID]' ";


if ($conn->query($sql1) === TRUE) {

  




} else {

    
 


}


}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="/styles/normal.css">

<link rel="stylesheet" href="/styles/bootstrap/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

<link rel="icon" 
      type="image/png" 
      href="/images/jmtrax_icon.png">


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<title> Just Money Transfers | Dashboard </title>


</head>

<body ng-cloak ng-app="justmoneytransfers" >

	

 


<header ng-controller="menucontroller">


<ul class="topnav">

<li class="logo_link"> <a href="index.html"><img src="/images/logo.png" class="logo" ></a> </li>

<li class="dropdown-link"> <a class="dropbtn"> Dashboard</a>  

</li>  

<li class="dropdown-link" ng-hide="usertype"> <a class="dropbtn" >Administration</a> 

<div class="dropdown-content">

  <a href="banks.html"> Banks </a>  

  <a href="commission-fees.php"> Commission Fees</a>  

  <a href="customers.html"> Customers </a>

  <a href="exchange-rates.html"> Exchange Rates</a>  

  <a href="shops.html"> Shops </a> 

  <a href="users.html"> Users </a>   

</div>


</li>  

<li class="dropdown-link"> <a class="dropbtn" >Reports</a>  

<nav class="dropdown-content">

  <a href="banking.html"> Banking</a> 

   <a href="daily-transactions-receipients.html"> Daily Transactions Receipients </a>

  <a href="daily-transactions-senders.html"> Daily Transactions Senders</a>   
  
  <a href="deleted-transactions.html"> Deleted Transactions </a>  

   <a href="receipients.html"> Recipients </a> 

    <a href="sales-report.html"> Sales Report </a> 

  <a href="senders.html"> Senders </a> 

  <a href="transactions.php"> Transactions </a>  

</nav>

</li>  

<li class="dropdown-link"> <a href="index.html" class="dropbtn" >Log Out</a> 


</li>  

<li class="icon">
    <a href="javascript:void(0);" style="font-size:15px;" onclick="showResponsivemenu()">☰</a>
</li>



</ul></header>

  



<div class="container-fluid"  ng-controller="dashboard" >


<div class="row" >

<div class="col-sm-6" ng-init="getrates()" >

<table class="adgentdetails" style="border:thin black dotted; width:100%; padding-left:10px;background-color:black;color:white; ">
<thead>

</thead>
<tbody>

<tr>
<td class="redtext" style="text-align:right">Id:&nbsp;</td>
<td> {{agentid}}</td>
<td >Todays outstanding balance £ {{outstandingbalance}}</td>
<td> </td>
</tr>

<tr>
<td class="redtext"  style="text-align:right">Username:&nbsp;</td>
<td> {{agentusername}}</td>
<td >Todays agent balance £ {{availablebalance}}</td>
<td> </td>
</tr>

<tr>
<td class="redtext"  style="text-align:right">Email&nbsp;:</td>
<td>{{agentemail}} </td>
<td >Agent credit limit £ {{creditlimit}} </td>
<td> </td>
</tr>

<tr>
<td class="redtext"  style="text-align:right">Access Level:&nbsp;</td>
<td> {{agenttype}}</td>
<td colspan='2'>Click <a href='banking.html' style="colour:red,font-weight:bold;"> here </a> to bank </td>

</tr>



</tbody>
</table>

</div>






<div class="col-sm-6" >


<div class="row">

   <div class="col-sm-12">



      <div class="form-group" ng-init="getrates()">


      <div >

       <h4>  1 GBP =  <span id='homepage'> {{rateslist[0].rate}} </span> NGN  </h4> 
       <h4> <span> {{rateslist[1].rate}} </span> NGN = 1 GBP </h4>
    
      </div>


      </div>


   </div>


 <div class="col-sm-4">


      <div class="form-group">

      </div>


</div>

 <div class="col-sm-4">


      <div class="form-group">
      </div>


</div>


</div>



<div class="row">

   <div class="col-sm-3">


      <div class="form-group">
    
<label for="GBP">AMOUNT GBP £</label>

      </div>


   </div>

   <div class="col-sm-3">


      <div class="form-group">
    

<label for="GBP">TRANSFER FEE £ </label>
      </div>


   </div>


   <div class="col-sm-3">


      <div class="form-group">
    
<label for="GBP">TOTAL NGN </label>
      </div>


   </div>
   
<div class="col-sm-3">


      <div class="form-group">
    
<label for="GBP">TOTAL GBP £ </label>
      </div>


   </div>

</div>


<div class="row">

   <div class="col-sm-3">


      <div class="form-group">
    

    <label for="GBP"></label>

<input type="text" class="form-control input-sm" value="" name="paymentsterling" class="paymentsterling" id="paymentsterling" ng-model="paymentsterling" ng-blur="calAMOUNT(paymentsterling)"   >


      </div>


   </div>

   <div class="col-sm-3">


      <div class="form-group">
    <label for="GBP"></label>

<input type="text" class="form-control input-sm" name="paymentcommission" class="fee" id="fee" ng-model="fee"  >


      </div>


   </div>


   <div class="col-sm-3">


      <div class="form-group">
    

 <label for="GBP"></label>
<input style="color:blue;font-weight:bold;" type="text" class="form-control input-sm" name="paymentlocal" class="NGN" id="NGN" ng-model="NGN" ng-blur="calNGN(NGN)" >


      </div>


   </div>


<div class="col-sm-3">


      <div class="form-group">
    

 <label for="GBP"></label>

<input type="text" class="form-control input-sm"  value="" name="paymentduegbp" class="total" id="total" style="color:red;font-weight:bold;" ng-model="total" ng-blur="calTOTALGBP(total)">


      </div>


   </div>
</div>






</div>



</div>


&nbsp;
<div class="row" >

<div class="col-sm-6" >  &nbsp;

<h3> Total sent by sender within the past 30 days is £ {{periodtotal}} </h3>

&nbsp;
  </div>

<div class="col-sm-6 " > 


<div class="row " >

<div class="col-sm-3 " >AMOUNT GBP £ </div>

<div class="col-sm-3 " >FEE £ </div>

<div class="col-sm-3 " >TOTAL DUE GBP £ </div>

<div class="col-sm-3 " >TOTAL NGN </div>

</div>


&nbsp;


<div class="row " >

<div class="col-sm-3 " >{{LIMITAMOUNT}}</div>

<div class="col-sm-3 " >{{LIMITFEE}}</div>

<div class="col-sm-3 " >{{LIMITGBP}}</div>

<div class="col-sm-3 " >{{LIMITNGN}} </div>

</div>



</div>

</div>

&nbsp;


<div class="row redotborder" >

<div class="col-sm-3 redotborder" ></div>

<div class="col-sm-3 redotborder" ></div>

<div class="col-sm-3 redotborder" ></div>

<div class="col-sm-3 redotborder" >

</div>

</div>


&nbsp;


<div class="row" ng-init="checkuser();getreceipientsandtransactions()">



<div class="col-sm-6" style="">

<h6>SENDERS DETAILS</h6> 

<form role="form" name="sendersmobileform" >

<div class="form-group" >


  <div class="row">

    <div class="col-sm-6" >

<input type="text"  class="form-control input-sm"   id="customerfirstname" ng-model='FirstName' placeholder="* First Name :" autocomplete="on"  />


</div>
    <div class="col-sm-6" >


<input type="text"  class="form-control input-sm"  id="customerlastname" ng-model='LastName' placeholder="* LAST NAME :" autocomplete="on"  />


</div>
    


  </div>


&nbsp;

  <div class="row">

    <div class="col-sm-3" ><input type="text"  class="form-control input-sm"  value ='+44' disabled style='font-weight:bold;color:red;' ></div>
    <div class="col-sm-2" ><input type="sendersmobile"  class="form-control input-sm"  value ='0'  disabled style='font-weight:bold;color:red;'></div>
    <div class="col-sm-7" ><input type="text"  class="form-control input-sm redtext"   name='sendersmobile' placeholder='Senders Mobile' required  id="customermobile" ng-model='MobilePhone' autocomplete="on" /></div>
  </div>




</div>

&nbsp;

&nbsp;

<span style='color:red;' > search by sender name or mobile to get started. *search is case sensitive </span>

&nbsp;

&nbsp;

&nbsp;

<div class="row">
<div class="col-sm-3"></div>
<div class="col-sm-3"></div>
<div class="col-sm-3" style=""> 

<button type="submit" class="btn btn-primary btn-block" ng-click='getsenderslist()' ng-disabled="sendersmobileform.$invalid" >SEARCH</button>


</div>
<div class="col-sm-3" style="">  

<button type="button" class="btn btn-primary btn-block"  ng-click='addsender()' >ADD NEW </button>

</br>
&nbsp;
<span id="sendererror redtext" class="redtext"> {{sendererror}}  </span>




</div>



</div>

&nbsp;

</form>



</div>


<div class="col-sm-6" style="">


<h6>RECEIPIENTS DETAILS</h6></span>

<form role="form" name="sendersmobileform" >

<div class="form-group" style='height:100px;'>


  <div class="row">

    <div class="col-sm-6" >

<input value="{{recfname}}"  class="form-control input-sm"   id='recfirstnamepop' name="recfirstname" onkeyup="showResult(this.value)" ng-model='recfirstname'  placeholder="* First Name:"  autocomplete="on" />


</div>
    <div class="col-sm-6" >


<input type="text" value="{{reclname}}"  class="form-control input-sm"   id='reclastnamepop' name="recsurname" onkeyup="showresult(this.value)"  ng-model='reclastname'  placeholder="* Last Name:" autocomplete="on" /> 


</div>
    


  </div>

&nbsp;

  <div class="row">

    <div class="col-sm-4" ><input type="text"  class="form-control input-sm redtext"  value ='+234' disabled ></div>
    <div class="col-sm-8" ><input value="{{recphone}}"  class="form-control input-sm"   id='recmobile'  name="recmobilephone" ng-model='recphone' autocomplete="on" ></div>
  </div>

</div>
<div class="row">
<div class="col-sm-3"></div>
<div class="col-sm-3"></div>
<div class="col-sm-3" style="">

  <button type="submit" class="btn btn-primary btn-block" ng-click='beneficiarysearch()'  >SEARCH</button>

</div>
<div class="col-sm-3" style="">  

<button type="button" class="btn btn-primary btn-block"  ng-click='addrec()' >ADD NEW </button>
</br>
&nbsp;
<span id="recerror redtext" class="redtext"> {{recerror}}  </span>


</div>



</div>



</form>



</div>



<div class="col-sm-2" style="">

</div>


</div>



<div class="row">

   <div class="col-sm-6">

<table class="table borderless " >

<tr>

<td> FIRST NAME </td>
<td> LAST NAME </td>
<td> MOBILE </td>
<td> 1st LINE </td>
<td>  </td>

</tr>

</table>


<div class="div_list" >

<table class="table borderless " >
    
    <tbody>



      <tr ng-repeat='sender in senderslist' style='cursor:pointer;' ng-click="selectsender($index)">
        
<td style="text-align:left;">{{sender.SendersFirstName}}</td>

<td> {{sender.SendersLastName}}</td>

<td><span id="mobilecell">{{sender.Mobile}}</span></td>

<td>{{sender.Line1}}</td>

<td><button type='button' ng-click="selectsender($index)" class="btn btn-link redtext">EDIT</button></td>
      
      
      </tr>
    </tbody>
  </table>



</div>
&nbsp;

<span id="sendererror redtext" class="redtext"> {{sendererror}}  </span>



<div class="row">

   <div class="col-sm-4">


      <div class="form-group">
     <label for="usr"></label>
      <input type="text"  class="form-control input-sm"   id="postcode" ng-model='SenderPostcode' placeholder="* POSTCODE :" autocomplete="on" >
      </div>


   </div>

    <div class="col-sm-4">

      <div class="form-group">
     <label for="usr"></label>
      <button type='button'  id='find'  ng-click='searchpostcode()' class="btn btn-primary btn-block" > Find </button>
      
      </div>

   </div>

    <div class="col-sm-4">

      <div class="form-group">
    <label for="usr"></label>
      <select name='building' id='building' ng-change='popform()' style='width:100%;' ng-model='streetvalue' > </select>
      </div>


   </div>


</div>

<div class="row">

   <div class="col-sm-4">

 <div class="form-group">
 <label for="usr"></label>
      <input type="text"  class="form-control input-sm" id="line1" ng-model='line1' placeholder="* 1ST LINE :" autocomplete="on" >
      </div>

   </div>

    <div class="col-sm-4">


<div class="form-group">
  <label for="usr"></label>
      <input type="text" class="form-control input-sm" id="line2" ng-model='line2' placeholder="*2ND LINE :" autocomplete="on" />
      </div>



   </div>

    <div class="col-sm-4">


<div class="form-group">
    <label for="usr"></label>
     <input type="text" class="form-control input-sm" id="line3" ng-model='line3' placeholder="3RD LINE :" autocomplete="on" >
      </div>



   </div>


</div>



<div class="row">

   <div class="col-sm-4">

 <div class="form-group">
 <label for="usr"></label>
      <input type="text" class="form-control input-sm" id="town" ng-model='TOWN' placeholder="* TOWN :" autocomplete="on" >
      </div>


   </div>

    <div class="col-sm-4">

 <div class="form-group">
 <label for="usr"></label>
      <input type="text" class="form-control input-sm" id="county" ng-model='COUNTY' placeholder="COUNTY :" autocomplete="on" >
      </div>

   </div>

    <div class="col-sm-4">

 <div class="form-group">
   <!-- <label for="usr"></label>
      <input type="text" class="form-control input-sm" id="customeremail" ng-model='EMAIL' placeholder="* EMAIL :">-->


<label for="usr"></label>

 <select  class="form-control input-sm"  ng-options="occupation as occupation.occupation for occupation in occupations "  ng-model='occupation' style="position:relative; " ></select>



      </div>

   </div>


</div>


<div class="row">

<div class="col-sm-4">

 <div class="form-group">


 <button type="button" class="btn btn-primary btn-block"  ng-click='updatesender()' > UPDATE </button>
     
      </div>


   </div>

   <div class="col-sm-4">

 <div class="form-group">

     <button type="button" class="btn btn-primary btn-block" ng-click='deletesender()'>DELETE</button>
      </div>


   </div>

    <div class="col-sm-4">

 <div class="form-group">

<!-- <button type="button" class="btn btn-primary btn-block" ng-hide="senderdetail.USERID" ng-click='convertcustomer()'> ENABLE CUSTOMER</button> --> 

 <button type='submit' name='printsenders' class="btn btn-primary btn-block"  ng-click="printsenderstransaction()" >PRINT</button> 



      </div>

   </div>

  


</div>



&nbsp;
<h6 ng-hide="senderdiv"> SENDERS ID DETAILS</h6>




<div ng-hide="senderdiv">

<div class="row">
  <div class="col-sm-4"> TYPE OF ID <select name=''  ng-model="IDtype" id="IDtype"  class="form-control input-sm"  >



<option value='' > </option>

<option value='Passport' >Passport </option>

<option value='Drivers' >Drivers License </option>

<option value='NI' >National Insurance Card </option>


</select></div>
  <div class="col-sm-4">  ID NUM <input type="text"  ng-model="IDnumber" id="IDnumber"/> </div>
  <div class="col-sm-4">COUNTRY OF ISSUE <input type="text"  ng-model="IDcountry" id="IDcountry"/></div>
</div>

</br>
</br>
EXPIRY DATE <input type="text"  ng-model="IDexpiry" id="datepicker"/>

</br>
</br>
<div class="row">
  <div class="col-sm-4">PROOF OF INCOME
  <a href='{{senderdetail.INCOME}}' target='_blank'>  <img src='http://www.jmtrax.net/identifications/ic_launcher.png' style='position:relative; width:16px;height:16px' /> </a>
  </div>
  <div class="col-sm-4">TYPE OF ID
  <a href='{{senderdetail.ID}}' target='_blank'> 
<img src='http://www.jmtrax.net/identifications/ic_launcher.png' style='position:relative; width:16px;height:16px' /> </a>
</div>
  <div class="col-sm-4">PROOF OF ADDRESS<a href='{{senderdetail.ADDRESS}}' target='_blank'>  
<img src='http://www.jmtrax.net/identifications/ic_launcher.png' style='position:relative; width:16px;height:16px' /> </a>
</div>
</div>
</br>
</br>

<div class="row">
  <div class="col-sm-4">
<form action="" method="POST" enctype="multipart/form-data">
    Select income ID to upload:
    <input type="file" name="incomefiletoupload" id="incomefiletoupload">
    <input type='hidden' class="sendersid" name='sendersID'/>
    <input type="submit" value="Upload Image" name="incomefiletouploadsubmit" >
</form></div>
  <div class="col-sm-4"><form action="" method="POST" enctype="multipart/form-data">
    Select  ID to upload:
    <input type="file" name="personalIDtoupload" id="personalIDtoupload">
      <input type='hidden' class="sendersid" name='sendersID'/>
    <input type="submit" value="Upload Image" name="personalIDtouploadsubmit" >
</form>
</div>
  <div class="col-sm-4"><form action="" method="POST" enctype="multipart/form-data">
    Select Address ID to upload:
    <input type="file" name="addressIDtoupload" id="addressIDtoupload">
      <input type='hidden' class="sendersid" name='sendersID'/>
    <input type="submit" value="Upload Image" name="addressIDtouploadsubmit" >
</form></div>
</div>




</br>

</br>









<table class="table table-bordered " ng-hide="senderdiv">
<thead>


<th> USERNAME </th>
<th> PASSWORD </th>



</thead>
<tbody>


<tr>

<td><input type="text" disabled ng-model="USERNAME" id="username" /> </td>
<td><input type="text" disabled ng-model="PASSWORD" id="password"/></td></tr>

<tr> <th> SECRET QUESTION </th>
<th> SECRET ANSWER </th></tr>
<tr><td><input type="text" disabled ng-model="SECRETQUESTION" id="secretquestion" autocomplete="on" /></td>
<td><input type="text" disabled ng-model="ANSWER" id="secretanswer" autocomplete="on" /></td>
</tr>


</tbody>
</table>



</div>


&nbsp;



   </div>

    <div class="col-sm-6">


<table class="table borderless ">

<tr> 

<td> FIRST NAME </td> 

<td> LAST NAME </td> 

<td> BANK </td> 

<td> ACCOUNT NUMBER </td> 

</tr>

</table>
<div class="div_list" >

<table class="table borderless ">

<tbody>
<tr ng-repeat="rec in receipentlist" style='cursor:pointer;' ng-click="selectreceipient($index)">

<td >{{rec.ReceipientFirstName}}</td>
<td>{{rec.ReceipientLastName}}</td>
<td>{{rec.ReceipientBank}}</td>
<td>{{rec.ReceipientAccountNumber}}</td>

</tr>


</tbody>
</table>


</div>


&nbsp;
<span id="recerror redtext" class="redtext"> {{recerror}}  </span>
&nbsp;

<div class="row">

   <div class="col-sm-4">



     <div class="form-group">
      <label for="usr"></label>
     <input type="text" name="recbank" class="form-control input-sm" style="position:relative; " value="{{recbank}}"  id='recbank' ng-model='recbank' placeholder="*  Bank:" autocomplete="on" /> 
      </div>



   </div>

   <div class="col-sm-4">


 <div class="form-group">
      <label for="usr"></label>

       <select class="form-control input-sm"  ng-options="bank as bank.bankname for bank in banklist | filter:bank.type='receipient' "  ng-change="bankdropdownfunction()" ng-model="bankdropdown"style="position:relative; " ></select>



    
      </div>




   </div>


   <div class="col-sm-4">



      <div class="form-group">
      <label for="usr"></label>
      <input name='recbankaccount' type='text' class="form-control input-sm"   value="{{recaccount}}"  id='recnumber' ng-model='recaccount'  autocomplete="on"  placeholder="* Bank Account:" /> 
      </div>



   </div>


  </div>


  <div class="row">

   <div class="col-sm-4">


 <div class="form-group">
      <label for="usr"></label>
     <input type="text" id='paymenttextfeild'  class="form-control input-sm"  name="payment"  value="{{recpaymentref}}" id='paymentref' autocomplete="on"  ng-model='recpaymentref' placeholder="*Payment Reference :"/> 
      </div>



   </div>

   <div class="col-sm-4">


<div class="form-group">
      <label for="usr"></label>
    <select  id='paymentdropdown' class="form-control input-sm"  ng-change="paymentdropdownfunction()" ng-model="paymentdropdown">


<option value='Cash' >Cash </option>

<option value='Bank' >Bank </option>

<option value='PayPal' >PayPal </option>

<option value='thirdparty' >Third Party </option>

</select>
      </div>



   </div>


   <div class="col-sm-4">


<div class="form-group" ng-hide="thirdpartydiv">
 
<textarea rows="4" cols="50" ng-model="thirdpartycomment"></textarea>

</div>


<div class="form-group" ng-hide="paypaldiv">
 
<input type="text" class="form-control input-sm"  name="paypal"  id='paypal' ng-model='paypal' placeholder="*Pay Pal Email :" autocomplete="on" /> 
     

</div>


 <div class="form-group" ng-hide="shopaccdiv">
      
      <label for="usr"></label>


 <select  class="form-control input-sm"  ng-options="bank as bank.bankholder for bank in banklist | filter:bank.type='payee'"  ng-model='shopacc' style="position:relative; " ></select>



  </div>


   </div>


  </div>


  <div class="row">

   <div class="col-sm-4">

<div class="form-group">
      <label for="usr"></label>
      <input type="text" id='reasonfortransfer'  name="reasonfortransfer"  class="form-control input-sm" value="{{recreasonfortransfer}}"  class='recreason' ng-model='recreasonfortransfer' placeholder="*Reason:" autocomplete="on" /> 
      </div>



   </div>

   <div class="col-sm-4">


 <div class="form-group">
      <label for="usr"></label>
    <select name='' id='transferreason' class="form-control input-sm"  ng-change="transferreasonfunction()" ng-model="transferreason">

<option value="Family Assistance">Family Assistance</option>
<option value="Commercial">Commercial</option>


<option value="Pret">Pret</option>
<option value="Help">help</option>


<option value="Others">Other</option>


</select>
      </div>



   </div>


   <div class="col-sm-4">

<div class="form-group">

<button type="button" class="btn btn-primary btn-block" ng-click='sendmoney()'>SEND MONEY</button> 
      </div>


   </div>


  </div>


  <div class="row">

   <div class="col-sm-4">

 <div class="form-group">
 <button type="button" class="btn btn-primary btn-block"  ng-click='updaterec()' >UPDATE </button>
 
      </div>



   </div>

<div class="col-sm-4">

 <div class="form-group">
  <button type="button" class="btn btn-primary btn-block" ng-click='deleterec()'>DELETE </button> 
      </div>



   </div>

   <div class="col-sm-4">

<div class="form-group">
     
<button  type="submit" class="btn btn-primary btn-block"  name='printsenders'  ng-click="receipient_summary()">PRINT </button> 

      </div>



   </div>


&nbsp;


<h6 >PREVIOUS TRANSACTIONS <a ng-click="printall()"  ng-hide='senderdetails'> PRINT ALL  <form id="alltransactions" action='senderstransactions.php' method='get' >  <input type='hidden' name='sendersID' value='{{sendersid}}' /> </form> </a> </h6> 


<table class="table borderless ">

<tr>  
<td> DATE </td>
<td> T-NUM </td>
<td> B. FIRST NAME </td>
<td> B. LAST NAME </td>
<td> AMOUNT GBP </td>
<td> FEE </td>
<td> TOTAL GBP DUE </td>

</tr>

</table>
<div  class="div_list" >


<table class="table borderless ">

<tbody>
<tr  ng-repeat="trans in transactionlist" >

<td >{{trans.date}} </td>
 <td >{{trans._id}}</td>
<td>{{trans.recipientfirstname}}</td>
<td>{{trans.recipientsurname}}</td>
<td>{{trans.amount}}</td>
<td>{{trans.fee}}</td>
<td>{{trans.totalgbp}}</td>





</tr>

</tbody>
</table>






</div>

&nbsp;


  </div>



&nbsp;
</div>

</div>





</div>



<footer>
<div class="row">

  <div class="col-sm-6" id="footer_column_1">  


<p>Authorised User can log into JM Transfers by entering correct account information on the right hand side. The activity of authorized users may be monitored. If monitoring reveals evidence of criminal activity, systems personnel may provide the evidence to management and/or law enforcement officials. Just Computers trading as JM Transfer and JM Trax have a comprehensive compliance program within the organisation to ensure compliance with government rules, regulations and approved guidance. We do not want JM Transfer and JM Trax services to be used in illegal money laundering activities or terrorist activities. It is our policy that we follow both the letter and the spirit of the law and the regulations of both the United Kingdom and Nigeria in which JM Transfer and JM Trax operates. All remittances processed by JM Transfer and JM Trax are screened with enhanced controls to prevent money laundering and terrorist financing. It is JM Transfer and JM Trax policy to follow both the letter and spirit of the law and regulations. Throughout the world, Governments have reinforced their commitment to the fight against money laundering and terrorist financing. New laws have imposed additional obligations on firms and individuals in the financial services sector to join in the fight. JM Transfer and JM Trax has an extensive training and awareness programme, a rigorous transaction monitoring system and a robust culture of compliance. JM Transfer and JM Trax works closely with regulatory bodies.</p>


 </div>

  <div class="col-sm-6" id="footer_column_2" style="text-align:center">  

<img src='/images/Photo2_small.png' class="footerimage"alt="Collection of logo representing Nigeria Banks that Jm Trax are associated with" />

   </div>

   

</div>

</footer>


<section class="copywright">

<p style='color:white;'>&copy; UNIFIED DIGITAL MEDIA  - http://www.unifieddigitalmedia.co.uk</p>

</section>

<script src="/scripts/jquery/dist/jquery.min.js" ></script>

<script src="/scripts/bootstrap/dist/js/bootstrap.min.js" ></script>

<script src="/script/angular/angular.min.js" ></script><script src="/script/angular-resource/angular.min.js" ></script>

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
   

if(!getCookie('agentusername') || getCookie('agenttype') == 'customer' )

{


window.location = "https://jmtrax.herokuapp.com/index.html" ;


}



if( getCookie('agenttype') == 'user'  )

{ 

$scope.usertype = true;


}


var counter = 0;

setInterval(function(){ counter = counter + 1 ;


window.addEventListener("mousemove",function getcoords() {


counter = 0;

});

if (counter == '1800')

{




window.location = "https://jmtrax.herokuapp.com/index.html" ;



} },1000);



  
   // $('input#sendersid').val("asdasd");
};

init();





});

app.factory('Senders_Service', ['$resource', function($resource) {

var resource = $resource('https://jmtrax.herokuapp.com/api/senders',{

id:"@id",
firstname:"@firstname",
lastname:"@lastname",
mobile:"@mobile",
postcode:"@postcode",
line1:"@line1",
line2:"@line2",
line3:"@line3",
town:"@town",
county:"@county",
email:"@email",
username_field:"@username",
password_field:"@password",
user_limit:"@user_limit",
shop_name:"@shop_name",
answer:"@answer",
secretquestion:"@secretquestion",
user_type:"@user_type",
IDtype:"@IDtype",
IDnumber:"@IDnumber",
IDexpiry:"@IDexpiry",
IDcountry:"@IDcountry",
occupation:"@occupation"






},{ 'update': { method:'PUT' } } );





return resource;


}]);



app.controller('dashboard', function($scope,Senders_Service,$http,$resource) {


$scope.shopaccdiv = true;

$scope.thirdpartydiv = true;

$scope.paypaldiv = true;

$scope.senderdiv = true;

var init = function () {
   
$scope.agentid = getCookie('agentid') ;

$scope.agentusername = getCookie('agentusername') ;

$scope.agentemail = getCookie('agentemail') ;

$scope.agenttype = getCookie('agenttype') ;


$http.get("https://jmtrax.herokuapp.com/api/agent_balance.php?agentusername="+getCookie('agentusername')).then(function(response) {


$scope.outstandingbalance = $scope.tocurrency(response.data.OUTSTANDING) ; 


$scope.availablebalance = $scope.tocurrency(response.data.AVAILABLE) ; 


$scope.creditlimit = $scope.tocurrency(response.data.LIMIT) ; 

if(Number(response.data.AVAILABLE) <= 100 )

{

alert("You are approaching your daily credit limit and need to bank.");

}


});

};

init();

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



$scope.transferreasonfunction = function () {



$scope.recreasonfortransfer = $scope.transferreason ;  

  }

  $scope.paymentdropdownfunction = function () {



$scope.recpaymentref = $scope.paymentdropdown ;  

  }

  $scope.bankdropdownfunction = function () {

$scope.recbank = $scope.bankdropdown.bankname ; 


  }


$scope.getrates = function () {


$http.get("https://jmtrax.herokuapp.com/api/rates").then(function(response) {



 $scope.rateslist = response.data;



    });

$http.get("https://jmtrax.herokuapp.com/api/banks").then(function(response) {



 $scope.banklist = response.data;

 

    });


$http.get("https://jmtrax.herokuapp.com/api/getoccupations.php").then(function(response) {



 $scope.occupations = response.data;

 

    });

}


$scope.getreclist = function () {
	

$http.get("https://jmtrax.herokuapp.com/api/receipients.php?sendersID="+$scope.sendersid).then(function(response) {


$scope.receipentlist = response.data;


});


}


$scope.getsenderslist = function () {


//$http.get("https://jmtrax.herokuapp.com/api/senders.php?firstname="+$scope.FirstName+"&lastname="+$scope.LastName+"&mobile="+$scope.MobilePhone).then(function(response) {

$http.get("https://jmtrax.herokuapp.com/api/user.php?firstname="+document.getElementById("customerfirstname").value+"&lastname="+
document.getElementById("customerlastname").value+"&mobile="+$scope.MobilePhone).then(function(response) {


if(response.data.length == 0 )
{

alert('Sender is not found.');

}else{

$scope.senderslist = response.data;

}


//$scope.sendersid = undefined;

//if($scope.index !== undefined){ $scope.selectsender($scope.index); };

    });



  }


$scope.printsenderstransaction = function () {

window.location = "https://jmtrax.herokuapp.com/senderstransactions.php" ;

}


$scope.selectsender = function (para) {


$scope.index = para;

$scope.FirstName = $scope.senderslist[para].SendersFirstName;
document.cookie = "sender_firstname=" + $scope.senderslist[para].SendersFirstName;
$scope.LastName = $scope.senderslist[para].SendersLastName;
document.cookie = "sender_lastname=" + $scope.senderslist[para].SendersLastName;
$scope.MobilePhone = $scope.senderslist[para].Mobile;
$scope.SenderPostcode = $scope.senderslist[para].Postcode;
$scope.line1 = $scope.senderslist[para].Line1;
$scope.line2 = $scope.senderslist[para].Line2;
$scope.line3 = $scope.senderslist[para].Line3;
$scope.TOWN = $scope.senderslist[para].Town;
$scope.COUNTY = $scope.senderslist[para].County;
$scope.EMAIL = $scope.senderslist[para].Email;
$scope.sendersid = $scope.senderslist[para].id;
document.cookie = "sendersid=" + $scope.senderslist[para].id;
document.cookie = "sender_username=" + $scope.senderslist[para].username;
$scope.USERNAME = $scope.senderslist[para].username;
$scope.PASSWORD = $scope.senderslist[para].password;
$scope.SECRETQUESTION = $scope.senderslist[para].secretquestion;
$scope.ANSWER = $scope.senderslist[para].secretanswer;
$scope.occupation = $scope.senderslist[para].Occupation;
$scope.recipientsID = undefined;
$scope.IDtype= $scope.senderslist[para].IDtype;
$scope.IDnumber= $scope.senderslist[para].IDnumber;
$scope.IDexpiry= $scope.senderslist[para].IDexpiry;
$scope.IDcountry= $scope.senderslist[para].IDcountry;
$scope.transactionlist = $scope.senderslist[para].transactions;


document.getElementsByClassName("sendersid")[0].setAttribute("value",$scope.senderslist[para].Mobile);
document.getElementsByClassName("sendersid")[1].setAttribute("value",$scope.senderslist[para].Mobile);
document.getElementsByClassName("sendersid")[2].setAttribute("value", $scope.senderslist[para].Mobile);


$scope.getreclist();

$http.get("https://jmtrax.herokuapp.com/api/transactions.php?sendersMobile="+$scope.senderslist[para].Mobile).then(function(response) {


$scope.transactionlist = response.data;



$scope.calculatetotals($scope.transactionlist);


$scope.periodtotal = $scope.calculate30daytotals($scope.transactionlist);

});


/*
$scope.receipentlist = $scope.senderslist[para].receipients;

$scope.bankinglist = $scope.senderslist[para].banking;

$scope.calculatetotals($scope.transactionlist);

$scope.periodtotal = $scope.calculate30daytotals($scope.transactionlist);*/




}


$scope.calculate30daytotals = function (para) {


$scope.periodtotal = 0;

var pastdate = new Date();

pastdate.setDate(pastdate.getDate() - 30);



var monthIndex = pastdate.getMonth();
    

if(monthIndex === 12)
{

monthIndex = 1; 

}else {

monthIndex = monthIndex + 1 ; 

}

pastdate = pastdate.getDate()+'-'+monthIndex+'-'+ pastdate.getFullYear() ;

var todaysdate = new Date();

var monthIndex = todaysdate.getMonth();
    
if(monthIndex === 12)

{

monthIndex = 1; 

} else {

monthIndex = monthIndex + 1 ; 

}

//todaysdate = todaysdate.getDate() +'-'+ monthIndex +'-'+ todaysdate.getFullYear();

  
      var date = new Date();
    
  var DateString;


 var monthIndex = date.getMonth();
    
    if(monthIndex === 12)
{

monthIndex = 1; 

}else {

monthIndex = monthIndex + 1 ; 

}


DateString = ('0' + date.getDate()).slice(-2) + '-'+ ('0' + monthIndex).slice(-2) + '-'+ date.getFullYear();

        
             
var log = [];


angular.forEach(para, function(value, key) {


if (value.date >= pastdate || value.date  <= DateString)  { 


$scope.periodtotal += parseInt(value.amount.replace(",", "")) ;



 }


}, log );

$scope.periodtotal = $scope.tocurrency(Number($scope.periodtotal).toFixed(2));

return $scope.periodtotal;

}


$scope.calculatetotals = function (para) {
 

$scope.LIMITAMOUNT = 0 ;

$scope.LIMITFEE = 0 ;

$scope.LIMITGBP = 0 ;

$scope.LIMITNGN  = 0 ;

 var date = new Date();
    
  var DateString;


 var monthIndex = date.getMonth();
    
    if(monthIndex === 12)
{

monthIndex = 1; 

}else {

monthIndex = monthIndex + 1 ; 

}


DateString = ('0' + date.getDate()).slice(-2) + '-'+ ('0' + monthIndex).slice(-2) + '-'+ date.getFullYear();


var log = [];

angular.forEach(para, function(value, key) {



if (value.date === DateString )  { 



$scope.LIMITAMOUNT += parseInt(value.amount.replace(",", "")) ;

$scope.LIMITFEE += parseInt(value.fee.replace(",", ""));

$scope.LIMITGBP += parseInt(value.totalgbp.replace(",", "")) ;

$scope.LIMITNGN += parseInt(value.totalngn.replace(",", "")) ;


 }


}, log );




$scope.LIMITAMOUNT = $scope.tocurrency(Number($scope.LIMITAMOUNT).toFixed(2));

$scope.LIMITFEE = $scope.tocurrency(Number($scope.LIMITFEE).toFixed(2));

$scope.LIMITGBP = $scope.tocurrency(Number($scope.LIMITGBP).toFixed(2));

$scope.LIMITNGN = $scope.tocurrency(Number($scope.LIMITNGN).toFixed(2));


}


$scope.addsender = function() {

$scope.sendersid = undefined;

$scope.savesender();

}

$scope.updatesender = function() {



$scope.savesender();

  }


$scope.savesender = function() {



if (angular.isUndefined($scope.MobilePhone))

{

  $scope.sendererror = 'This is not a valid UK number. Must be 10 digits without the leading zero';

}

else
{

var occupation = $scope.occupation;


if(occupation == undefined)

{


$scope.sendererror = 'Senders occupation is needed';


}

else

{




if($scope.MobilePhone.length < 10    ) 

{


$scope.sendererror = 'This is not a valid UK number. Must be 10 digits without the leading zero';


}

else
{


var line1 = document.getElementById("line1").value;

var line2 = document.getElementById("line2").value;

var line3 = document.getElementById("line3").value;

var town = document.getElementById("town").value;

var county = document.getElementById("county").value;

var postcode = document.getElementById("postcode").value;

if(line1 == '' || line2 =='' || town=='' || postcode =='')

{




$scope.sendererror = 'All fields are required marked with an asterick * are requiered '; 



}
else

{


$scope.sendererror = '';


if(angular.isUndefined($scope.sendersid))

{


var log = Senders_Service.save(


{



firstname:$scope.FirstName,
lastname:$scope.LastName,
mobile:$scope.MobilePhone,
postcode:document.getElementById("postcode").value,
line1:document.getElementById("line1").value,
line2:document.getElementById("line2").value,
line3:document.getElementById("line3").value,
town:document.getElementById("town").value,
county:document.getElementById("county").value,
email:"",
user_limit:"",
shop_name:"",
answer:"",
secretquestion:"",
user_type:"customer",
IDtype:$scope.IDtype,
IDnumber:$scope.IDnumber,
IDexpiry:document.getElementById("datepicker").value,
IDcountry:$scope.IDcountry,
occupation:$scope.occupation.occupation,

}, function() {


if(log.ERROR){ alert(log.ERROR);}

$scope.sendersid = log.id;

document.cookie = "sendersid=" + log.id;

$scope.getsenderslist();

  });



}

else


{






var log = Senders_Service.update(

{

id:$scope.sendersid,
firstname:$scope.FirstName,
lastname:$scope.LastName,
mobile:$scope.MobilePhone,
postcode:document.getElementById("postcode").value,
line1:document.getElementById("line1").value,
line2:document.getElementById("line2").value,
line3:document.getElementById("line3").value,
town:document.getElementById("town").value,
county:document.getElementById("county").value,
email:"",
username:document.getElementById("username").value,
password:document.getElementById("password").value,
secretquestion:document.getElementById("secretquestion").value,
answer:document.getElementById("secretanswer").value,
user_limit:"",
shop_name:"",
user_type:"customer",
IDtype:$scope.IDtype,
IDnumber:$scope.IDnumber,
IDexpiry:document.getElementById("datepicker").value,
IDcountry:$scope.IDcountry,
occupation:$scope.occupation.occupation,



}, function() {


if(log.ERROR){ alert(log.ERROR);}

$scope.getsenderslist();

  });





}






}







}


}


}










}



$scope.clearsender = function () {

$scope.FirstName = "";
$scope.LastName = "";
$scope.MobilePhone = "";
$scope.SenderPostcode = "";
$scope.line1 = "";
$scope.line2 = "";
$scope.line3 = "";
$scope.TOWN = "";
$scope.COUNTY = "";
$scope.EMAIL = "";
$scope.sendersid = "";
$scope.receipentlist = [];
$scope.transactionlist = [];
$scope.senderslist= [];
$scope.USERNAME = "";
$scope.PASSWORD = "";
$scope.SECRETQUESTION = "";
$scope.ANSWER = "";

document.getElementById("IDtype").value = "";
$scope.IDnumber = "";
document.getElementById("IDexpiry").value = "";
$scope.IDcountry = "";
  

}



$scope.deletesender = function () {



var r = confirm("You are about to delete this sender");


if (r == true) {


if($scope.sendersid !== undefined || $scope.sendersid  != "" )

{




$http.delete("https://jmtrax.herokuapp.com/api/senders.php?id="+$scope.sendersid).then(function(response) {



});



}
else
{

alert("You need to select a sender to delete");

}





}
else
{



}

}



$scope.sendmoney = function () {


if($scope.periodtotal >= 800 )

{


var r = confirm("This sender has sent more than £800.00 with the last 30 days and needs to provide their ID to continue.");


if (r == true) {
   $scope.senderdiv = false;
   
} else {
   window.location = "https://jmtrax.herokuapp.com/order.html" ;
}





}

else

{

if($scope.LIMITAMOUNT >= 650 )

{


var r = confirm("This sender is approaching the daily limit. Ask the amount they would like to send . If this amount brings their daily limit to £800.00 or more. an ID is required to continue");
if (r == true) {
   $scope.senderdiv = false;
   
} else {
   window.location = "https://jmtrax.herokuapp.com/order.html" ;
}




}
else
{

window.location = "https://jmtrax.herokuapp.com/order.html" ;



}




}



}



$scope.receipient_summary = function () {


window.location = "https://jmtrax.herokuapp.com/receipient-statement.html" ;


}

$scope.beneficiarysearch = function () {


$http.get("https://jmtrax.herokuapp.com/api/receipients.php?firstname="+$scope.recfirstname+"&lastname="+$scope.reclastname).then(function(response) {

$scope.receipentlist = response.data;

});

}


$scope.selectreceipient = function (para) {

$scope.recipientsID = para;
$scope.recid =  $scope.receipentlist[para].id;
$scope.reclastname = $scope.receipentlist[para].ReceipientLastName ;
$scope.recfirstname = $scope.receipentlist[para].ReceipientFirstName ;
document.getElementById("recbank").value = $scope.receipentlist[para].ReceipientBank ;

document.getElementById("recnumber").value = $scope.receipentlist[para].ReceipientAccountNumber ;

document.getElementById("reasonfortransfer").value = $scope.receipentlist[para].ReceipientReasonForTransfer ;
document.getElementById("paymenttextfeild").value = $scope.receipentlist[para].ReceipientPaymentReference ;
$scope.recphone = $scope.receipentlist[para].ReceipientPhone ;
$scope.paypal = $scope.receipentlist[para].ReceipientPayPal ;
$scope.shopacc = $scope.receipentlist[para].ReceipientShopAccount ;
$scope.thirdpartycomment = $scope.receipentlist[para].ReceipientThirdPartyPaymentComment ;

$scope.updatedreceipientbank = $scope.receipentlist[para].ReceipientBank;
$scope.updatedreceipientaccountnumber = $scope.receipentlist[para].ReceipientAccountNumber;



document.cookie = "receipient_pos=" + para;
document.cookie = "receipient_lastname=" + $scope.reclastname;
document.cookie = "receipient_bank=" + document.getElementById("recbank").value;
document.cookie = "receipient_firstname=" + $scope.recfirstname;
document.cookie = "receipient_banknumber=" + document.getElementById("recnumber").value;

};




$scope.deleterec = function () {


var resource = $resource('https://jmtrax.herokuapp.com/api/receipients',{

receipientfname : "@receipientfname",
receipientlname : "@receipientlname",
receipientbank : "@receipientbank",
receipientaccountnumber : "@receipientaccountnumber",
receipientreasonfortransfer : "@receipientreasonfortransfer",
receipientpaymentreference : "@receipientpaymentreference",
receipientphone : "@receipientphone",
receipientpaypal : "@receipientpaypal",
receipientshopacc : "@receipientshopacc",
receipientthirdpartycomment : "@receipientthirdpartycomment",
username : "@username",
rec_pos : "@rec_pos"


},{ 'update': { method:'PUT' } } );


var r = confirm("You are about to delete this receipient");


if (r == true) {

if($scope.recipientsID !== undefined || document.getElementById("username").value !== "" || document.getElementById("username").value !== undefined)

{



$http.delete("https://jmtrax.herokuapp.com/api/receipients.php?id="+$scope.recid).then(function(response) {

alert(response.data.ERROR);


$scope.getreclist();

});



}
else
{

alert("You need to select a receipient to delete");

}





}

else

{




}



}



$scope.addrec = function() {

$scope.recipientsID = undefined;

$scope.saverec();

}

$scope.updaterec = function() {

$scope.saverec();


}

$scope.saverec = function() {



if(document.getElementById("paymenttextfeild").value == 'PayPal' && ($scope.paypal == undefined || $scope.paypal == "" )) 

{

$scope.recerror = 'Enter your pay pal email. This will be used to pay your beneficiary.';

$scope.paypaldiv = false;

$scope.shopaccdiv = true;

$scope.thirdpartydiv = true;

}

else if(document.getElementById("paymenttextfeild").value == 'Bank' && ($scope.shopacc == undefined || $scope.shopacc == "" )) 

{



$scope.bankref= false;


$scope.recerror = 'Select a bank account to make your payment. This will be used to pay your beneficiary.';

$scope.shopaccdiv = false;

$scope.paypaldiv = true;

$scope.thirdpartydiv = true;


}
else if (document.getElementById("paymenttextfeild").value == 'thirdparty' && ( $scope.thirdpartycomment == undefined || $scope.thirdpartycomment == "" )) 
{

$scope.recerror = 'Write a comment saying who paid and method of payment.';


$scope.thirdpartydiv = false;

$scope.paypaldiv = true;

$scope.shopaccdiv = true;



}
else if(


document.getElementById("recfirstnamepop").value == '' || document.getElementById("reclastnamepop").value == '' || document.getElementById("recmobile").value == '' || document.getElementById("recbank").value =='' || document.getElementById("recnumber").value == '' ||document.getElementById("reasonfortransfer").value =='' || document.getElementById("paymenttextfeild").value == '' 


)

{


$scope.recerror = 'All field are required';

}

else if(document.getElementById("recnumber").value.length < 10 )
{


$scope.recerror = 'Bank account must be 10 characters in length';


}

else

{

$scope.recerror = '';






if(angular.isUndefined($scope.recipientsID))

{


if(angular.isUndefined($scope.sendersid))

{


alert('A sender has to be selected before this recipient can be added to the database.');


}
else {


<!-- -->



var resource = $resource('https://jmtrax.herokuapp.com/api/receipients',{

id:"@id",
receipientfname : "@receipientfname",
receipientlname : "@receipientlname",
receipientbank : "@receipientbank",
receipientaccountnumber : "@receipientaccountnumber",
receipientreasonfortransfer : "@receipientreasonfortransfer",
receipientpaymentreference : "@receipientpaymentreference",
receipientphone : "@receipientphone",
receipientpaypal : "@receipientpaypal",
receipientshopacc : "@receipientshopacc",
receipientthirdpartycomment : "@receipientthirdpartycomment",
username : "@username",
rec_pos : "@rec_pos"


},{ 'update': { method:'PUT' } } );



if($scope.shopacc != undefined)

{

var shopacc = $scope.shopacc.bankholder;

}


var log = resource.save(

{


id:$scope.sendersid,
receipientfname : $scope.recfirstname,
receipientlname : $scope.reclastname,
receipientbank : document.getElementById("recbank").value,
receipientaccountnumber : document.getElementById("recnumber").value,
receipientreasonfortransfer : document.getElementById("reasonfortransfer").value,
receipientpaymentreference : document.getElementById("paymenttextfeild").value,
receipientphone : $scope.recphone,
receipientpaypal : $scope.paypal,
receipientshopacc : shopacc,
receipientthirdpartycomment : $scope.thirdpartycomment,
username : document.getElementById("username").value,
rec_pos : ""



}, function() {


if(log.ERROR){ alert(log.ERROR);}

document.cookie = "receipient_lastname=" + $scope.reclastname;
document.cookie = "receipient_bank=" + document.getElementById("recbank").value;
document.cookie = "receipient_firstname=" + $scope.recfirstname;
document.cookie = "receipient_banknumber=" + document.getElementById("recnumber").value;


$scope.recipientsID = "";
$scope.recfirstname = "";
$scope.reclastname = "";
document.getElementById("recbank").value = "";
document.getElementById("recnumber").value = "";
document.getElementById("reasonfortransfer").value = "";
document.getElementById("paymenttextfeild").value = "";
$scope.recphone = "";
$scope.paypal = "";
$scope.shopacc = "";
$scope.thirdpartycomment = "";

$scope.getreclist();

$scope.getsenderslist();


//document.cookie = "receipient_pos=" + para;


//selectsender($scope.index);


  });





}



}

else 


{


var resource = $resource('https://jmtrax.herokuapp.com/api/receipients',{

id:"@id",
receipientfname : "@receipientfname",
receipientlname : "@receipientlname",
receipientbank : "@receipientbank",
receipientaccountnumber : "@receipientaccountnumber",
receipientreasonfortransfer : "@receipientreasonfortransfer",
receipientpaymentreference : "@receipientpaymentreference",
receipientphone : "@receipientphone",
receipientpaypal : "@receipientpaypal",
receipientshopacc : "@receipientshopacc",
receipientthirdpartycomment : "@receipientthirdpartycomment",
username : "@username",
rec_pos : "@rec_pos",
updatedreceipientbank : "@updatedreceipientbank",
updatedreceipientaccountnumber :  "@updatedreceipientaccountnumber",


},{ 'update': { method:'PUT' } } );



if($scope.shopacc != undefined)

{

var shopacc = $scope.shopacc.bankholder

}


var log = resource.update(

{


id:$scope.recid,
receipientfname : $scope.recfirstname,
receipientlname : $scope.reclastname,
receipientbank : document.getElementById("recbank").value,
receipientaccountnumber : document.getElementById("recnumber").value,
updatedreceipientbank : $scope.updatedreceipientbank,
updatedreceipientaccountnumber :  $scope.updatedreceipientaccountnumber,
receipientreasonfortransfer : document.getElementById("reasonfortransfer").value,
receipientpaymentreference : document.getElementById("paymenttextfeild").value,
receipientphone : $scope.recphone,
receipientpaypal : $scope.paypal,
receipientshopacc : shopacc,
receipientthirdpartycomment : $scope.thirdpartycomment,
username : document.getElementById("username").value,
rec_pos : $scope.recipientsID



}, function() {

if(log.ERROR){ alert(log.ERROR);}

document.cookie = "receipient_lastname=" + $scope.reclastname;
document.cookie = "receipient_bank=" + document.getElementById("recbank").value;
document.cookie = "receipient_firstname=" + $scope.recfirstname;
document.cookie = "receipient_banknumber=" + document.getElementById("recnumber").value;



$scope.recipientsID = "";
$scope.recfirstname = "";
$scope.reclastname = "";
document.getElementById("recbank").value = "";
document.getElementById("recnumber").value = "";
document.getElementById("reasonfortransfer").value = "";
document.getElementById("paymenttextfeild").value = "";
$scope.recphone = "";
$scope.paypal = "";
$scope.shopacc = "";
$scope.thirdpartycomment = "";

$scope.getsenderslist();
$scope.getreclist();


  });





}






}



}


$scope.popform = function ()

{


var sendermobile = document.getElementById("building").value;



PostcodeAnywhere_Interactive_RetrieveById_v1_30Begin ('JJ14-GM21-XW16-FU78',sendermobile,'');


}

$scope.searchpostcode = function ()

{

var sendermobile = document.getElementById("postcode").value;



PostcodeAnywhere_Interactive_Find_v1_10Begin('JJ14-GM21-XW16-FU78',sendermobile);

}




$scope.calNGN = function(para) {

     

$http.get("https://jmtrax.herokuapp.com/api/charge.php?ngn="+para).then(function(response) {

$scope.fee = $scope.tocurrency(Number(response.data.FEES).toFixed(2));
$scope.NGN = $scope.tocurrency(Number(response.data.NGN).toFixed(2));
$scope.paymentsterling = $scope.tocurrency(Number(response.data.AMOUNT).toFixed(2));
$scope.paymenttotalngn = $scope.tocurrency(Number(response.data.NGN).toFixed(2));
$scope.total = $scope.tocurrency(Number(response.data.TOTALGBP).toFixed(2));
  });

  
    };

    $scope.calTOTALNGN = function(para) {

 $http.get("https://jmtrax.herokuapp.com/api/charge.php?totalngn="+para).then(function(response) {


$scope.fee = $scope.tocurrency(Number(response.data.FEES).toFixed(2));
$scope.NGN = $scope.tocurrency(Number(response.data.NGN).toFixed(2));
$scope.paymentsterling = $scope.tocurrency(Number(response.data.AMOUNT).toFixed(2));
$scope.paymenttotalngn = $scope.tocurrency(Number(response.data.NGN).toFixed(2));
$scope.total = $scope.tocurrency(Number(response.data.TOTALGBP).toFixed(2));

    });

  
    };

    $scope.calTOTALGBP = function(para) {
  
     $http.get("https://jmtrax.herokuapp.com/api/charge.php?totalgbp="+para).then(function(response) {

$scope.fee = $scope.tocurrency(Number(response.data.FEES).toFixed(2));
$scope.NGN = $scope.tocurrency(Number(response.data.NGN).toFixed(2));
$scope.paymentsterling = $scope.tocurrency(Number(response.data.AMOUNT).toFixed(2));
$scope.paymenttotalngn = $scope.tocurrency(Number(response.data.NGN).toFixed(2));
$scope.total = $scope.tocurrency(Number(response.data.TOTALGBP).toFixed(2));

   });
    };



    $scope.calAMOUNT = function(para) {

       $http.get("https://jmtrax.herokuapp.com/api/charge.php?amount="+para).then(function(response) {

$scope.fee = $scope.tocurrency(Number(response.data.FEES).toFixed(2));
$scope.NGN = $scope.tocurrency(Number(response.data.NGN).toFixed(2));
$scope.paymentsterling = $scope.tocurrency(Number(response.data.AMOUNT).toFixed(2));
$scope.paymenttotalngn = $scope.tocurrency(Number(response.data.NGN).toFixed(2));
$scope.total = $scope.tocurrency(Number(response.data.TOTALGBP).toFixed(2));


    });
       
    };


$scope.tocurrency = function (para) {


var number = para.toString();

var dollars = number.split('.')[0];

var  cents = (number.split('.')[1] || '') +'00';

var dollars = dollars.split('').reverse().join('').replace(/(\d{3}(?!$))/g, '$1,').split('').reverse().join('');

var cent = cents.slice(0, 2);

var decimal = ".";

var cent2 = decimal.concat(cent);

var dollars = dollars.concat(cent2);

return dollars;




}




});


function PostcodeAnywhere_Interactive_Find_v1_10Begin(Key,Postcode)

{


var scriptTag = document.getElementById("PCAe4b2e7e1d8a241dead6229b29fb22327");
var headTag = document.getElementsByTagName("head").item(0);
var strUrl = "";

strUrl = "http://services.postcodeanywhere.co.uk/PostcodeAnywhere/Interactive/Find/v1.10/json.ws?";
strUrl += "&Key=" + encodeURI(Key);
strUrl += "&SearchTerm=" + encodeURI(Postcode);
strUrl += "&CallbackFunction=PostcodeAnywhere_Interactive_Find_v1_10End";


if (scriptTag)
{
try
{
headTag.removeChild(scriptTag);
}
catch (e)
{
//Ignore
}
}
scriptTag = document.createElement("script");
scriptTag.src = strUrl
scriptTag.type = "text/javascript";
scriptTag.id = "PCAe4b2e7e1d8a241dead6229b29fb22327";
headTag.appendChild(scriptTag);

}



function PostcodeAnywhere_Interactive_Find_v1_10End(response)
{
var i = 0;


//Test for an error
if (response.length==1 && typeof(response[0].Error) != 'undefined')
{
//Show the error message
alert(response[0].Description);
}
else
{
//Check if there were any items found
if (response.length==0)
{
alert("Sorry, no matching items found");
}
else
{
document.getElementById('building').options.length= response.length;
while (i < response.length)
{
document.getElementById('building').options[i].label= response[i].StreetAddress;
document.getElementById('building').options[i].value= response[i].Id;
i++;                }
}
}
}


function PostcodeAnywhere_Interactive_RetrieveById_v1_30Begin(Key,Id, UserName)
{

var scriptTag = document.getElementById("PCAb9b445072c50417b82ad4204c2ec66c1");
var headTag = document.getElementsByTagName("head").item(0);
var strUrl = "";




strUrl = "http://services.postcodeanywhere.co.uk/PostcodeAnywhere/Interactive/RetrieveById/v1.30/json.ws?";
strUrl += "&Key=" + encodeURI(Key);
strUrl += "&Id=" + encodeURI(Id);
strUrl += "&UserName=" + encodeURI(UserName);
strUrl += "&CallbackFunction=PostcodeAnywhere_Interactive_RetrieveById_v1_30End";
//Make the request
if (scriptTag)
{
try
{
headTag.removeChild(scriptTag);
}
catch (e)
{
//Ignore
}
}



scriptTag = document.createElement("script");
scriptTag.src = strUrl
scriptTag.type = "text/javascript";
scriptTag.id = "PCAb9b445072c50417b82ad4204c2ec66c1";
headTag.appendChild(scriptTag);
}

function PostcodeAnywhere_Interactive_RetrieveById_v1_30End(response)
{
//Test for an error
if (response.length==1 && typeof(response[0].Error) != 'undefined')
{
//Show the error message
alert(response[0].Description);
}
else
{
//Check if there were any items found
if (response.length==0)
{
alert("Sorry, no matching items found");
}
else
{

document.getElementById("line1").value= response[0].Line1;
document.getElementById("line2").value= response[0].Line2;
document.getElementById("line3").value= response[0].Line3;
document.getElementById("town").value= response[0].PostTown;
document.getElementById("county").value= response[0].County;
document.getElementById("postcode").value= response[0].Postcode;

}

}

}

</script>


<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">

$(function() {

    $( "#datepicker" ).datepicker({ minDate: -0 });

   
  
  });


</script>


</body>

</html>