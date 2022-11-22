$(document).ready(function(){
    $(document).ajaxStart(function(){
      $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
      $("#wait").css("display", "none");
    }); var images = [];var dis = [];var price=[];var pricesale=[];
  var z={};
  $.getJSON( "json/prodloadsource.json", function( data ) {
    jQuery.each( data, function( i, val ) {
  z[i]=[];
  jQuery.each( val, function( ii, vall ) {
  z[i].push(vall);});
  });
  jQuery.each( z, function( i, val ) {
  if(i==="dis")
  
    $.each( val, function(  key,vall) {
      dis.push(  vall );
    });
  if(i==="src1")
    $.each( val, function(  key,vall) {
      images.push(  vall );
    });
    if(i==="price")
    $.each( val, function(  key,vall) {
      price.push(  vall );
    });if(i==="pricesale")
    $.each( val, function(  key,vall) {
      pricesale.push(  vall );
    });
    
  }); 
    var srcindex=0;
    var disindex=0;
  
    $(".product_image >a").each(function(){
       
        $(this).find("img").eq(1).attr("src",images [srcindex]);
         srcindex++;
        $(this).find("img").eq(0).attr("src",images [srcindex]);
         srcindex++;
         $(this).parent().find(".imginfo").text(dis[disindex]);

         $(this).parent().find(".price-sale").text("$"+pricesale[disindex]);
         $(this).parent().find(".price-dc").text("$"+price[disindex]);
         disindex++;
      });
     srcindex=0;
   
     srcindex=0;
   
  
  });
  });
  