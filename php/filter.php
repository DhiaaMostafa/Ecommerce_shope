<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="acounts";
$arr=array();
$i=0;
$filter="";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
   
    $typ=$_POST["typ"];
    if($typ!=='price'){
        $colors=$_POST["colors"]; 
$d=strtok($colors,";");

while($d!==false &&$d!=";"){
    $i++;
    array_push($arr,$d);
    $d=strtok(";");
}    
    }
    else{
        $lowprice=$_POST['lprice'];
        $highprice=$_POST['hprice'];
    }
    
$conn = new mysqli($servername, $username, $password, $database);
} 
if($typ=='color'){

// Create connection

for($ind=0;$ind<$i;$ind++){
    $sql="SELECT fluidimg, hoverimg,disc,price_dc,price_sale,color,typee,size
    FROM prod 
    WHERE color = '{$arr[$ind]}'";

$res=$conn->query($sql) ;
if($res->num_rows>0){
    while($row=$res->fetch_assoc()){
$filter.="<div class='product_image mix featured'><a class='img-product' href='prodectdetail.html'><img class='img-fluid' src={$row["fluidimg"]} alt='Colorlib Template'>
<div class='overlay'></div><img class='hover-img' src={$row["hoverimg"]} alt='Colorlib Template'></a>
<div class='text_image'>
<h3><a href='#' class='imginfo'>{$row["disc"]}</a><a class='fa-icon fa fa-heart ' href='#'></a>
  <div class='clearflex'></div>
</h3><div class='pricing'><span class='price-dc'>$";
$filter.="{$row["price_dc"]}</span><span class='price-sale'>$";
$filter.="{$row["price_sale"]}</span></div>
</div>
</div>";
    }
}   }}





else if($typ=="typ")
{
    // Create connection

for($ind=0;$ind<$i;$ind++){
    $sql="SELECT fluidimg, hoverimg,disc,price_dc,price_sale,color,typee,size
    FROM prod 
    WHERE typee = '{$arr[$ind]}'";

$res=$conn->query($sql) ;
if($res->num_rows>0){
    while($row=$res->fetch_assoc()){
$filter.="<div class='product_image mix featured'><a class='img-product' href='prodectdetail.html'><img class='img-fluid' src={$row["fluidimg"]} alt='Colorlib Template'>
<div class='overlay'></div><img class='hover-img' src={$row["hoverimg"]} alt='Colorlib Template'></a>
<div class='text_image'>
<h3><a href='#' class='imginfo'>{$row["disc"]}</a><a class='fa-icon fa fa-heart ' href='#'></a>
  <div class='clearflex'></div>
</h3>
<div class='pricing'><span class='price-dc'>{$row["price_dc"]}</span><span class='price-sale'>{$row["price_sale"]}</span></div>
</div>
</div>";
    }
}   }}
else if($typ=="size")
{
    // Create connection

for($ind=0;$ind<$i;$ind++){
    $sql="SELECT fluidimg, hoverimg,disc,price_dc,price_sale,color,typee,size
    FROM prod 
    WHERE size = '{$arr[$ind]}'";

$res=$conn->query($sql) ;
if($res->num_rows>0){
    while($row=$res->fetch_assoc()){
$filter.="<div class='product_image mix featured'><a class='img-product' href='prodectdetail.html'><img class='img-fluid' src={$row["fluidimg"]} alt='Colorlib Template'>
<div class='overlay'></div><img class='hover-img' src={$row["hoverimg"]} alt='Colorlib Template'></a>
<div class='text_image'>
<h3><a href='#' class='imginfo'>{$row["disc"]}</a><a class='fa-icon fa fa-heart ' href='#'></a>
  <div class='clearflex'></div>
</h3>
<div class='pricing'><span class='price-dc'>{$row["price_dc"]}</span><span class='price-sale'>{$row["price_sale"]}</span></div>
</div>
</div>";
    }
}   }}
else{
    $sql="SELECT fluidimg, hoverimg,disc,price_dc,price_sale,color,typee,size
    FROM prod 
    WHERE price_sale BETWEEN '{$lowprice}' AND '{$highprice}'";

$res=$conn->query($sql) ;
if($res->num_rows>0){
    while($row=$res->fetch_assoc()){
$filter.="<div class='product_image mix featured'><a class='img-product' href='prodectdetail.html'><img class='img-fluid' src={$row["fluidimg"]} alt='Colorlib Template'>
<div class='overlay'></div><img class='hover-img' src={$row["hoverimg"]} alt='Colorlib Template'></a>
<div class='text_image'>
<h3><a href='#' class='imginfo'>{$row["disc"]}</a><a class='fa-icon fa fa-heart ' href='#'></a>
  <div class='clearflex'></div>
</h3>
<div class='pricing'><span class='price-dc'>{$row["price_dc"]}</span><span class='price-sale'>{$row["price_sale"]}</span></div>
</div>
</div>";
    }
}   }


echo $filter;
$conn->close();

?>