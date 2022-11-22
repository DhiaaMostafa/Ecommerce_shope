
   
    $(".chece-page").load("php/welcome.php",function(){
      $(".fa-heart,.icon-remove-cheese").click(function(){
       var child;
        if($(this).attr("class").indexOf('icon-remove-cheese')!=-1){
      
          var firstimage=$(this).parent().find(".img-fluid").attr("src");
          var dis=$(this).parent().parent().find(".imginfo").text();
      var pricedc=$(this).parent().parent().find(".price-dc").text()   ;
    var pricesale=$(this).parent().parent().find(".price-sale").text()   ;
  
  $(this).parent().parent().remove(); }
          else{
            var firstimage=$(this).parent().parent().parent().find(".img-fluid").attr("src");
     var pricedc=$(this).parent().parent().find(".price-dc").text()   ;
var pricesale=$(this).parent().parent().find(".price-sale").text()   ;
var dis=$(this).parent().find(".imginfo").text();
         
$(this).parent().parent().parent().remove();}
         
               
      
var scan=0;

$.ajax({
    type:"POST",
url:"./php/addwish.php",
data:"firstimage="+firstimage+"&disc="+dis+"&pricedc="+pricedc+"&pricesale="+pricesale+"&scan="+scan,

});
    });
    
    });
      
    