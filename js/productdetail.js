var image=localStorage.getItem("productimage");
var disc=localStorage.getItem("productdisc");
var price=localStorage.getItem("productdcsale");
var oldprice=localStorage.getItem("productsale");
$(".image-detail").find("img").attr("src",image);
$(".detail-size-color-text").find("h2").text(disc);
var f=price+"<span>"+oldprice+"</span>";

$(".price-detail").append(f);
price=price.replace('$','');
oldprice=oldprice.replace('$','');
price=Number(price);oldprice=Number(oldprice);

$("button").click(function(){
   var count= $(".input_card_number").find("input[type=text]").val();


   $.post("php/cartshoping.php",{Image:image,Disc:disc,Price:price,Oldprice:oldprice,Count:count},function(date,status){
    $(".row-detail").append(date);
    alert(date);
});});