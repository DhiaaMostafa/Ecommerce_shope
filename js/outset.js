var s=false; 
var loginstatus =localStorage; 
function searchfunction(g){
  //applay filter search
  var search=$(g).val();

  $(".product_image").each(function(){
    if($(this).find(".imginfo").text().indexOf(search)==-1)
    {$(this).hide();
   
 } });
}
function prodectdetail(){
  $(".img-product").on('click',function(){
    var a=($(this).find(".img-fluid").attr("src"));
    var b=($(this).parent().find(".imginfo").text());
    var c=($(this).parent().find(".price-dc").text());
    var d=($(this).parent().find(".price-sale").text());
    alert(a+"  "+b);
    localStorage.setItem("productimage",a);
    localStorage.setItem("productdisc",b);
    localStorage.setItem("productsale",c);
    localStorage.setItem("productdcsale",d);
  });
}
function signin(e){  //for check signin and sighnup information
  var user=$("input[name='Username'").val();
  
var password=$("input[name='Password'").val();


$.post("php/sigin.php",{Username:user,Password:password},function(date,status){
if(date==true){//if information found in database
  if(e.id=='login'){//login event applay

$("#loginform").submit();
loginstatus.setItem("scanlogin","true");
s=true;}
else if(e.id=='joinbtn'){//signup error if there is same username found in database
  alert("the user name alreday tokken");
s= false;
loginstatus.setItem("scanlogin","false");}


}
  
else //username not found in database
{ 
  if(e.id=='login')//in signin status
  { alert("the user name or password is incorrect");
s= false;
loginstatus.setItem("scanlogin","false");}
else if(e.id=='joinbtn'){//in signup status
  $("#joinform").submit();
  loginstatus.setItem("scanlogin","true");}
 s=true;
}
});
return s; //for submet the form or unsubmet

}
;
function filterbutton(){//when click in button class inside the filter toggle between angledown and up 
  $(".container").toggleClass('show-filter');
$(".button").on("click",function(event) {
var er= $(this).attr("class");
var f=er.replace("button","");
var fr=f.replace(" ","");
$("."+fr).not(".button").fadeToggle(500);
$(".filteritem").not($("."+fr)).hide();
$(".button").not($("."+fr)).find("span.fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");
  //  $("."+event.target.classList[0]).fadeToggle();
$("."+fr).not(".button").css("z-index", 1);
if ($("."+fr).not(".filteritem").find("span").hasClass("fa-angle-down")) {
$("."+fr).not(".filteritem").find("span").removeClass("fa-angle-down")
; $("."+fr).not(".filteritem").find("span").addClass("fa-angle-up")

} else {
$("."+fr).not(".filteritem").find("span").addClass("fa-angle-down");
$("."+fr).not(".filteritem").find("span").removeClass("fa-angle-up");
}

$("#slider-range").slider({//price slider-range
  range: true,
  min: 30,
  max: 300,
  values: [75, 300],
  slide: function(event, ui) {//select values between to circle in slider
  $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
  }
  });
  $("#amount").val("$" + $("#slider-range").slider("values", 0) +
  " - $" + $("#slider-range").slider("values", 1)); 
 
}); 
  }
  function getlikedprod() {//make the prodect witch we make it in wishlist liked after refresh page
            
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       $('body').append (this.responseText);
      }
    };
    xhttp.open("GET", "./php/liked.php", true);
    xhttp.send();
         
           
         }   
         
         
    function setprodliked()//save the liked prod in database for wishlist page
      
    {
    var faicon = $(".fa-icon");
         
        
    faicon.on('click', function (e) {//when click in a heart
     e.preventDefault();
   
    $(this).toggleClass('active');
     var scan=0;//if the product is liked make it unliked or make it liked
     if($(this).is('.active')) 
      scan=1;
  else
  scan=0;
  
  
  
         
  
         
  
     //get the product's information
     var firstimage=$(this).parent().parent().parent().find(".img-fluid").attr("src");
    var pricedc=$(this).parent().parent().find(".price-dc").text()   ;
  var pricesale=$(this).parent().parent().find(".price-sale").text()   ;
  var dis=$(this).parent().find(".imginfo").text();
  alert(dis);
 
  $.ajax({
      type:"POST",
  url:"php/addwish.php",
  data:"firstimage="+firstimage+"&disc="+dis+"&pricedc="+pricedc+"&pricesale="+pricesale+"&scan="+scan,
  
  });
     
  
  });
    }
(function($) {
    "use strict"
    // in home page animateion image header 
    $(".header").load("HTML/pug/header.html",function (){//load header content
    
    
$("#home_txt_search").keyup(function(e){//show search suggest when keyup
 	var search = $(this).val();

	if(search != ""){

		$.ajax({
			url: './php/search.php',
			type: 'post',
			data: {search:search, type:1},
			dataType: 'json',
			success:function(response){
			
				var len = response.length;
				$("#home_searchResult").empty();
				for( var i = 0; i<len; i++){
				
					var name = response[i]['name'];
var s=1;
$("#home_searchResult option").each(function(){//duplicated not allowed
  if($(this).val()==name)
  s=0;
            });
            if(s)
					$("#home_searchResult").append("<option value='"+name+"'>"+"</option>");

				}

				// binding click event to li
				$("#home_searchResult option").on("click",function(){
          $("#home_txt_search").val($(this).val());
    
          $("#home_searchResult").empty();
          
				});

			}
		});
  }
  else{
    $("#home_searchResult").empty();
  }


});
$("#home_search_button").click(function(){//applay the genaral search 

  var search=$("#home_txt_search").val();
	$.ajax({
    url: 'php/search.php',
    type: 'post',
    data: {search:search, type:2},
    dataType: 'json',
    success:function(response){
    
      var len = response.length;
      $(".image-section-prodect.featured__filter").empty();
  
      for( var i = 0; i<len; i++){
        var data="<div class='product_image mix featured'><a class='img-product' href='prodectdetail.html'><img class='img-fluid' src='"+response[i]['fluidimg']+ "'alt='Colorlib Template'><div class='overlay'></div><img class='hover-img' src='"+response[i]['hoverimg']+"' alt='Colorlib Template'></a><div class='text_image'><h3><a href='#' class='imginfo'>"+response[i]['disc']+"</a><a class='fa-icon fa fa-heart ' href='#'></a><div class='clearflex'></div></h3><div class='pricing'><span class='price-dc'>"+response[i]['pricedc']+"</span><span class='price-sale'>"+response[i]['pricesale']+"</span></div></div></div>";
        $(".image-section-prodect.featured__filter").append(data);
  
      }}
});
;
 setprodliked();
  getlikedprod();
  });
 
$("#filter_search_button").click(function(){//applay filter search
  searchfunction("#filter_txt_search");});
var x=0;
$("#filter_txt_search").keyup(function(e){
 //show a filter search suggest when keyup
 if(e.keyCode==13){
  searchfunction("#filter_txt_search");
  return;}
 
 var search = $(this).val().toLowerCase();

if(search != ""){
$(".imginfo").each(function(){
  if(($(this).text()).toLowerCase().search(search)!=-1)
  var disc=$(this).text();
        var s=1;
$("#filter_searchResult option").each(function(){
  if($(this).val()==disc)
  s=0;
            });
            if(s)
					$("#filter_searchResult").append("<option value='"+disc+"'>"+disc+"</option>");

			
  
  
          });
          $("#filter_searchResult option").bind('click',function(){
            $("#filter_txt_search").val($(this).val());
            $("#filter_searchResult").empty();
            searchfunction("#filter_txt_search");
          
      });}

      // binding click event to li
    
    

  


else{
$("#filter_searchResult").empty();
}


});







      $(".footer").load("HTML/pug/footer.html");//load footer content
       $('.search_box-home').on('click',function (){
        $('.inp-search_box-home').slideToggle(400);
        $(".search_icon").slideToggle(200);
        });
        $('.icon-card').on('click',function (){
        
    $('.popup_small_card').fadeIn();
    });

    $('.popup-close').on('click',function(e){
        e.preventDefault();
        $('.popup_small_card').fadeOut();
        });
       $("#acountform").click(function (){
         if(loginstatus.getItem("scanlogin")=='false'){
  




          //load signin page
    $("#signinform").load("HTML/pug/sigin.html", function(responseTxt, statusTxt, xhr){
    if(statusTxt == "success")
       {   $("#signinform").show();
        $("#signinform").on('click', function(e) {
        if(e.target !== e.currentTarget)
          return;
          $("#signinform").empty(); 
          $("#signinform").hide();
      });
    
           $("#signuppage").click(function (){
        
        
        $("#signupform").load("HTML/pug/signup.html", function(responseTxt, statusTxt, xhr){
          if(statusTxt == "success")
       {   $("#signinform").empty(); 
       $("#signinform").hide();
        $("#signupform").show();
        $("#signupform").on('click', function(e) {
          if(e.target !== e.currentTarget)
            return;
            $("#signupform").empty(); 
            $("#signupform").hide();
        });
       }
       if(statusTxt == "error")
       alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
       
     });}
      if(statusTxt == "error")
        alert("Error: " + xhr.status + ": " + xhr.statusText);
    });}

    else
{
    $("#signinform").load("HTML/pug/logout.html", function(responseTxt, statusTxt, xhr){
      if(statusTxt == "success")
         {   $("#signinform").show();
          $("#signinform").on('click', function(e) {
          
          if(e.target.id=='logout'){
          loginstatus.setItem("scanlogin","false");
          
          $("#signinform").empty(); 
          $("#signinform").hide();}
            if(e.target !== e.currentTarget)
            return;
          
            $("#signinform").empty(); 
            $("#signinform").hide();
            
        });
     
      
          }
        if(statusTxt == "error")
          alert("Error: " + xhr.status + ": " + xhr.statusText);
      });

     


    }













  });
  
 getlikedprod();
       
       
       
  $('.btn_sml_head').on('click',function (){
    $('.js_nav_small').slideToggle();
    });
  prodectdetail();
       
       
 





/*filter function






















8888888
8
8
8
8

8*/
 


   

$('.js-show-filter').on('click',function (){
    
  $(this).toggleClass('show-filter');
  if($('.js-show-search_box').hasClass('show-search_box')) {
    $('.js-show-search_box').removeClass('show-search_box');
    $('.panel-search_box-section').slideUp(400);
}
  $('.panel-filter').load("filter.html",function (){
  
    $("input[type=checkbox]").click(function(){
      
      var g=$(this).parent().parent().parent().find("i");

      if($(this).is(":checked"))
      g.text((parseInt(g.text())+1).toString()+ " selected");
    
    else
    g.text((parseInt(g.text())-1).toString()+ " selected");

  });





     
$(".selectall").click(function(){//select button inside filter
  var i=0;
    $(this).parent().parent().find("input[type=checkbox]").attr("checked","checked");
    $(this).parent().parent().find("input[type=checkbox]").each(function(){
      i++;
    });
    $(this).parent().find("i").text(i.toString()+ " selected");
  });


  var col=""; //save selected filter values
    $("#colorbtn").click(function(){//when click applay in color filter
      
      $("input[name=color]").each(function(){
        if($(this).is(":checked"))
      {
        col+=$(this).attr("value")+";";
      }
      });
      var f=col.substring(0,col.length-1);
    var t="color";
      $.post("php/filter.php",{colors:f,typ:t},function(date,status){
      
       $(".image-section-prodect.featured__filter").empty();
       $(".image-section-prodect.featured__filter").append(date);
       setprodliked();
       getlikedprod();
       prodectdetail();
      });
      $(this).parent().parent().hide();
      $(".button.filtercolor").find("span").removeClass("fa-angle-up");
      
      $(".button.filtercolor").find("span").addClass("fa-angle-down");
    
}); 
 
$("#typebtn").click(function(){ //when click applay in type filter
      
  $("input[name=type]").each(function(){
    if($(this).is(":checked"))
  {
    col+=$(this).attr("value")+";";
  }
  });
  var f=col.substring(0,col.length-1);
var t="typ";
  $.post("php/filter.php",{colors:f,typ:t},function(date,status){
  
   $(".image-section-prodect.featured__filter").empty();
   $(".image-section-prodect.featured__filter").append(date);

   setprodliked();
   getlikedprod();
   prodectdetail();

  });
  $(this).parent().parent().hide();
  $(".button.filtertype").find("span").removeClass("fa-angle-up");
  
  $(".button.filtertype").find("span").addClass("fa-angle-down");

}); 

$("#sizebtn").click(function(){ //when click applay in type filter
      
  $("input[name=size]").each(function(){
    if($(this).is(":checked"))
  {
    col+=$(this).attr("value")+";";
  }
  });
  var f=col.substring(0,col.length-1);
var t="size";
  $.post("php/filter.php",{colors:f,typ:t},function(date,status){
  
   $(".image-section-prodect.featured__filter").empty();
   $(".image-section-prodect.featured__filter").append(date);
   
   
   
   setprodliked();
   getlikedprod();
   prodectdetail();

  });
  $(this).parent().parent().hide();
  $(".button.filtersize").find("span").removeClass("fa-angle-up");
  
  $(".button.filtersize").find("span").addClass("fa-angle-down");

});
$("#pricebtn").click(function(){
  var lowprice=$("#slider-range").slider("values", 0);
  var highprice= $("#slider-range").slider("values", 1);
  var t="price";
  $.post("php/filter.php",{typ:t,hprice:highprice,lprice:lowprice},function(date,status){
  
   $(".image-section-prodect.featured__filter").empty();
   $(".image-section-prodect.featured__filter").append(date);
   
   
   
   setprodliked();
   getlikedprod();
   prodectdetail();

  });
  $(this).parent().parent().hide();
  $(".button.filtersize").find("span").removeClass("fa-angle-up");
  
  $(".button.filtersize").find("span").addClass("fa-angle-down");


});








$('.panel-filter').slideToggle(400); 
filterbutton();
        }); 
      
  });
      

setprodliked();
});


 
     var owl_image = $('.slider ');
     owl_image.owlCarousel({
     loop:true,
     margin:10,
     nav: true,
     navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
     autoplay:true,
     animateOut: 'fadeOut',
     animateIn: 'fadeIn',
     autoplayTimeout:6000,
     smartSpeed: 1500,
     nav_offset_top:true,
     autoplayHoverPause:true,
     dots:false,
     responsive: {
    100: {
      items: 1
       }
              }
     });

// in home  animation  image section
  var owl = $('.image_anim_home_Clothes');
  owl.owlCarousel({
loop:true,
margin:10,
autoplay:true,
autoplayTimeout:2000,
autoplayHoverPause:true,
nav: true,
navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
autoplay:true,
dots:false, 
smartSpeed: 1500,
nav_offset_top:true,
responsive: {
  0: {
      items: 1
  },
  576: {
      items: 2
  },
  768: {
      items: 3
  },
  992: {
      items: 4
  }
 }
});
      

      
// in prodect pag cheese image without menu
        $(window).on('load', function () {
            $(".loader").fadeOut();
            $("#preloder").delay(200).fadeOut("slow");
        $('.featured__controls li').on('click', function () {
                $('.featured__controls li').removeClass('active');
                $(this).addClass('active');
            });
            if ($('.featured__filter').length > 0) {
                var containerEl = document.querySelector('.featured__filter');
                var mixer = mixitup(containerEl);
            }
    
            });
 
//all page the function do display or hide small page card

    

          // nav active
          $('.nav-sec ul li').on('click', function () {
            $('.nav-sec li').removeClass('active');
            $(this).addClass('active');
     });

    //-----------------------------------------------------------


    //--------------------------------------------------------------
  // filter
  
    // filter 2
   
        
           
         

    
      })(jQuery)
