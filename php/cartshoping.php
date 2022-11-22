<?php
include "connect.php";
$Image=$_POST['Image'];
$Disc=$_POST['Disc'];
$Price=$_POST['Price'];
$Oldprice=$_POST['Oldprice'];
$Count=$_POST['Count'];


$stmt=$con->prepare("SELECT cartdisc ,cartcount FROM cartshoping WHERE cartdisc = '{$Disc}'");
$stmt->execute();
   $row = $stmt->fetchall();
   $p=0;
   $count = $stmt->rowCount();
if($count>0){
    foreach($row as $r){

        $p=$r['cartcount'];}
    

$p+=$Count;
$stmt=$con->prepare("UPDATE  cartshoping  SET cartcount = '{$p}' WHERE cartdisc = '{$Disc}'");
$stmt->execute();
    }else{
    $stm="INSERT INTO   cartshoping (cartimage, cartdisc, cartprice, cartoldprice, cartcount)
    VALUES('{$Image}','{$Disc}' ,'{$Price}' , '{$Oldprice}'
, '{$Count}') ";
$con->exec($stm);


}

?>