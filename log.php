<!DOCTYPE html> 
<html> 

<head> 
	<title> 
		JavaScript 
	| Detecting arrow key presses. 
	</title> 
</head> 
<body>
<form action='log.php' method="POST">
username<input type="text" name='username'>
PASSWORD<input type="password" name='password'>
<input type="submit" value="log"></form></body> 

</html> 
<?php 

function sdf(){
	$hostname="localhost";
	$usern="root";
	$passwd="";
	$dname="first";
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$username=$_POST['username'];$password=$_POST['password'];$md=new mysqli($hostname,$usern,$passwd,$dname);
	$username=$username;
		$qu="INSERT INTO users (username , password) VALUES('$username','$password')";
	$qs="SELECT username FROM users where username='k54'";

	$result=$md->query($qs);
	$bool=true;
	if($result->num_rows>0)	
	{while($rows=$result->fetch_assoc())
	if($rows['username']==$password)
	{$bool=false;
	
	}} 
		if($bool){
		$md->query($qu);
			echo '<script>alert("sucsufulll")</script>'	;
		}
		else
		{echo "username already token";
			}
			$md->close();
	
	}
}

$hostname="localhost";
$usern="root";
$passwd="";
$dname="first";
if($_SERVER['REQUEST_METHOD']=="POST"){
	$username=$_POST['username'];$password=$_POST['password'];$md=new mysqli($hostname,$usern,$passwd,$dname);
$username=$username;
	$qu="INSERT INTO users (username , password) VALUES('$username','$password')";
$qs="SELECT username FROM users where username=$username";
//$qd="delete from users where id=0";
//$md->query($qd


$result=$md->query($qs);
$bool=true;
if($result->num_rows>0)	
{while($rows=$result->fetch_assoc())
if($rows['username']==$password)
{$bool=false;

}} 
	if($bool){
	$md->query($qu);
		echo '<script>alert("sucsufulll")</script>'	;
	}
	else
	{echo "username already token";
		}
		$md->close();}

?>