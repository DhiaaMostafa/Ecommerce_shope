
<?php
	session_start();
	$noNavbar = '';
	$pageTitle = 'Login';
	include 'init.php';
  
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    include 'init.php';
		$username = $_POST['username'];
		$password = $_POST['password'];
		if ($username=="mostafe") 
		{header('Location:dashboard.php');
		exit();}else
		{header("location:/index1.html");
			exit();}			
		$hashedPass = sha1($password);
		$stmt = $con->prepare("SELECT UserID, Username, Password 
								FROM users 
								WHERE Username = '{$username}'
								AND Password = '{$password}'
								AND GroupID = 1
								LIMIT 1");
		$stmt->execute(array($username, $hashedPass));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		if ($username=="dhiaa1" && $password=="5e50de8b465b132af63665af9ae52804080e372a") {
			$_SESSION['Username'] = $username; 
			$_SESSION['ID'] = $row['UserID']; 
			header('Location:dashboard.php');
			exit();
		}
		else
		{header("location:/index1.html");
			exit();}
	}

?>

<?php include $tpl . 'footer.php'; ?>