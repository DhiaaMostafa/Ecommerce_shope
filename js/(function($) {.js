(function($) {
    "use strict"
    // in home page animateion image header 
    $(".header").load("./HTML/pug/header.html",function (){
      $(".footer").load("./HTML/pug/footer.html");
       $('.search-home').on('click',function (){
        $('.inp-search-home').slideToggle(400);
        });
        $('.icon-card').on('click',function (){
    $('.popup_small_card').fadeIn();
    });

    $('.popup-close').on('click',function(e){
        e.preventDefault();
        $('.popup_small_card').fadeOut();
        });
       $("#signinpage").click(function (){
  
    $("#id01").load("./HTML/pug/sigin.html", function(responseTxt, statusTxt, xhr){
    if(statusTxt == "success")
       {   $("#id01").show();
        $("#id01").on('click', function(e) {
        if(e.target !== e.currentTarget)
          return;
          $("#id01").empty(); 
          $("#id01").hide();
      });
           $("#signuppage").click(function (){
        
        
        $("#id02").load("./HTML/pug/signup.html", function(responseTxt, statusTxt, xhr){
          if(statusTxt == "success")
       {   $("#id01").empty(); 
       $("#id01").hide();
        $("#id02").show();
        $("#id02").on('click', function(e) {
          if(e.target !== e.currentTarget)
            return;
            $("#id02").empty(); 
            $("#id02").hide();
        });
       }
       if(statusTxt == "error")
       alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
       
     });}
      if(statusTxt == "error")
        alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
  });
  
    
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     $('body').append (this.responseText);
    }
  };
  xhttp.open("GET", "./php/liked.php", true);
  xhttp.send();
       
       
       
       
  $('.btn_sml_head').on('click',function (){
    $('.js_nav_small').slideToggle();
    })
       
       
       
    
  var faicon = $(".fa-icon");
       
      
  faicon.on('click', function (e) {
   e.preventDefault();
 
  $(this).toggleClass('active');
   var scan=0;
   if($(this).is('.active'))
    scan=1;
else
scan=0;



       

       

   
   var firstimage=$(this).parent().parent().parent().find(".img-fluid").attr("src");
  var pricedc=$(this).parent().parent().find(".price-dc").text()   ;
var pricesale=$(this).parent().parent().find(".price-sale").text()   ;
var dis=$(this).parent().find(".imginfo").text();
alert(typeof dis);
$.ajax({
    type:"POST",
url:"./php/wish.php",
data:"firstimage="+firstimage+"&disc="+dis+"&pricedc="+pricedc+"&pricesale="+pricesale+"&scan="+scan,

});
   

});
    });


 
     var owl_image = $('.image_animation_home_head ');
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
   
        $('.js-show-filter').on('click',function (){
      
          $(this).toggleClass('show-filter');
          if($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search-section').slideUp(400);
        }
          $('.panel-filter').load("filter.html",function (){
            var col="";
            $("#colorbtn").click(function(){
            
            $("input[name=color]").each(function(){
              if($(this).is(":checked"))
            {
              col+=$(this).attr("value");
            }
            });
            
  });  
            $('.panel-filter').slideToggle(400);  $(".button").click(function(event) {
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
      
            $("#slider-range").slider({
                range: true,
                min: 30,
                max: 300,
                values: [75, 300],
                slide: function(event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                }
                });
                $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));  });
              });
            
        });
            
           
         

    
      })(jQuery)
