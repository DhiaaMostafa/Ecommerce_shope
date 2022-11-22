<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acounts";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT  fluidimg, disc,price_dc,price_sale FROM images";
$result = $conn->query($sql);
$prudimg='<div class="product_image"><div class="img-product">';

$p="";   
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
$prudimg='<div class="product_image"><div class="img-product">'.'<img class="img-fluid" src="'.$row['fluidimg'].'"';
$prudimg.="/>";

$prudimg.="<i class=' ti-trash icon-remove-cheese'></i></div><div class='text_image'><h3><a href='#' class='imginfo'>";
$prudimg.=$row['disc']."</a><a class='fa-icon fa fa-heart active' href='#'></a>";
$prudimg.="<div class='clearflex'></div></h3><div class='pricing'><span class='price-dc'>".$row["price_dc"]."</span><span class='price-sale'>".$row["price_sale"]."</span></div></div></div>";
   $p.=$prudimg;
    }
} echo $p;
$conn->close();
?>
