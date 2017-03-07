$(document).ready(function(){


   var FirstChildHeight = $("header").height();

     $( function() {
    $( document ).tooltip();
     } );

   $(".slideshow-container,.container-fluid").css("top", FirstChildHeight + 30);

   $("footer").css("margin-top", FirstChildHeight + 30);

 

});

function showResponsivemenu()   {



    document.getElementsByClassName("topnav")[0].classList.toggle("responsive");









}

