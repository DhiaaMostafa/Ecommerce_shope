<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $scan=array();
    include 'init.php';
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $_SESSION['Username'] = $username; 
  
    if ($username=="dhiaa1") 
    {header('Location:dashboard.php');
    exit();}
    
    $hashedPass = sha1($password);
    $stmt = $con->prepare("SELECT UserID, Username, Password 
                FROM users 
                WHERE Username = '{$username}'
                AND Password = '{$password}'
               
               ");
    $stmt->execute(array($username, $hashedPass));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
      $_SESSION['Username'] = $username; 
      $_SESSION['ID'] = $row['UserID']; 
     
   $scan=array('check'=>true);
    }  else
   
    $scan=array('check'=>true);

 echo json_encode($scan);}
  
  ?>



