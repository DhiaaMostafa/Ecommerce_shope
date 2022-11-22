<?php
include "connect.php";


$crad_array=array();
$stmt=$con->prepare("SELECT cartimage, cartdisc, cartprice, cartoldprice, cartcount FROM cartshoping ");
$stmt->execute();
   $row = $stmt->fetchall();
   $p=0;
   $count = $stmt->rowCount();
if($count>0){
    foreach($row as $r){
        $cartimage=$r['cartimage'];
    $cartdisc=$r['cartdisc'];
    $cartprice=$r['cartpric'];
    $cartoldprice=$r['cartoldpric'];
      $cartcount=$r['cartcount'];
    
        $card_array=array("image"=>    $cartimage
        , "disc"=>$cartdisc,
        "price"=>$cartprice
        ,"oldprice"=>$cartoldprice 
        ,"count" => $cartcount);}
    echo(json_encode($card_array));}
    


?>