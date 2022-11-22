<?php
 {

include "connect.php";
   


$scan="";
   $username = $_POST['Username'];
   $password = $_POST['Password'];
   
   $hashedPass = sha1($password);
   $stmt = $con->prepare("SELECT Username, Password 
                     FROM users 
                     WHERE Username = '{$username}'
                   
                 
                  ");
   $stmt->execute(array($username, $password));
   $row = $stmt->fetch();
   $count = $stmt->rowCount();
   if ($count>0)
     {
   $scan=true;
      }
       else
   {
    $scan=false;
    
      
   }

 echo ($scan);}
  
  ?>



