
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acounts";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$img=array("img/png/black1.png","img/png/black2.png","img/png/black3.png","img/png/black2.png","img/png/black1.png","img/png/black2.png","img/png/black3.png","img/png/black2.png");
$vmg=array("img/png/11.png","img/png/12.png","img/png/111.png","img/png/112.png","img/png/11.png","img/png/12.png","img/png/111.png","img/png/112.png");
$dis=array("some disc1","some disc2","some disc3","some disc4","some disc5","some disc6","some disc7","some disc8");
$pricedc=array("100","200","300","400","100","200","300","400");
$pricesale=array("100","200","300","400","100","200","300","400");
$color=array("black","black","black","black","black","black","black","black");
$typee=array("t-shirt","t-shirt","t-shirt","t-shirt","t-shirt","t-shirt","t-shirt","t-shirt");
$size=array("xl","xxl","xxxl","s","xl","xxl","xxxl","s");
$i=0;
for($i=0;$i<8;$i++){
$sql = "INSERT INTO prod  (fluidimg, hoverimg,disc,price_dc,price_sale,color,typee,size)
VALUES('$img[$i]','$vmg[$i]','$dis[$i]','$pricedc[$i]','$pricesale[$i]','$color[$i]',
'$typee[$i]','$size[$i]')";
$result = $conn->query($sql);
}
$conn->close();

?>