
!DOCTYPE html> 
<html> 

<head> 
	<title> 
		JavaScript 
	| Detecting arrow key presses. 
	</title> 
</head> 
<body>
<form action='reg.php' method="POST">
username<input type="text" name='username'>
PASSWORD<input type="password" name='password'>
<input type="submit" value="reg"></form></body> 

</html> 
<?php 
if($_SERVER['REQUEST_METHOD']=="POST"){
	$username=mysql_real_escape_string($_POST['username']);
	$password=mysql_real_escape_string($_POST['password']);}
	
?>