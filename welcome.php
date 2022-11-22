<?php

if(isset($_POST['sinin']))
{
	//first number
$user=$_POST["user"];
$pass=$_POST["password"];	//second number
if($user=="ghamdan"&&$pass=="ghamdan"){
    header('location:https://www.phptpoint.com');
}

else{
    echo "fails";
}
	
	}
?>

<form method="post">
<table align="center">
	<tr>
		<td>Enter First number</td>
		<td><input type="text" name="user"/></td>
	</tr>
	<tr>
		<td>Enter Second number</td>
		<td><input type="text" name="password"/></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type="submit" value="sinin" name="sinin"/></td>
	</tr>
</table>
</form>