<?php

	ob_start(); 
	session_start();
	$pageTitle = 'users';
	if (isset($_SESSION['Username'])) {
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		/*
			** Title  page  MANAGE
			**the page  MANAGE user
		*/
		if ($do == 'Manage') { 
			$query = '';
			if (isset($_GET['page']) && $_GET['page'] == 'Pending') {
				$query = 'AND RegStatus = 0';
			}
			$stmt = $con->prepare("SELECT * FROM users   ORDER BY UserID DESC");
			$stmt->execute();
			$rows = $stmt->fetchAll();
			if (! empty($rows)) {
			?>
			<h1 class="text-center">Manage Members</h1>
			<div class="container">
				<div class="table-responsive">
					<table class="main-table manage-members text-center table table-bordered">
						<tr>
							<td>#ID</td>
							<td>Username</td>
							<td>Email</td>
							<td>Full Name</td>
							<td>Registered Date</td>
							<td>Control</td>
						</tr>
						<?php
							foreach($rows as $row) {
								echo "<tr>";
									echo "<td>" . $row['UserID'] . "</td>";
									echo "<td>" . $row['Username'] . "</td>";
									echo "<td>" . $row['Email'] . "</td>";
									echo "<td>" . $row['FullName'] . "</td>";
									echo "<td>" . $row['Date'] ."</td>";
									echo "<td>
										<a href='users.php?do=Edit&userid=" . $row['UserID'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
										<a href='users.php?do=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
									echo "</td>";
								echo "</tr>";
							}
						?> <tr>
					</table>
				</div>
				<a href="users.php?do=Add" class="btn btn-primary">
					<i class="fa fa-plus"></i> New Member </a>
			</div>

			<?php } else {
			     	echo '<div class="container">';
					echo '<div class="nice-message">There\'s No Members To Show</div>';
					echo '<a href="users.php?do=Add" class="btn btn-primary">';
					echo '<i class="fa fa-plus"></i> New Member</a></div>';
			} ?>
		<?php 

		/*
			** Title  page  ADD 
			**the page  ADD user
		*/
		} elseif ($do == 'Add') { ?>
			<h1 class="text-center">Add New Member</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
				  <?php  
				   $name_flage=array('Username','Password','Email','FullName');
				   inputformadd($name_flage);
                   ?>
					<div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" value="Add Member" class="btn btn-primary btn-lg" />
						</div>
					</div>

				</form>
			</div>

		<?php 
				/*
			** Title  page  INSERT
			**the page  INSERT USER
		*/

		} elseif ($do == 'Insert') {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				echo "<h1 class='text-center'>Insert Member</h1>";
				echo "<div class='container'>";
				filteruser('Insert');
			} else {
				echo "<div class='container'>";
				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';
				redirectHome($theMsg);
				echo "</div>";
			}
			echo "</div>";

		/*
			** Title  page  EDIT 
			**the page  EDIT user
		*/

		} elseif ($do == 'Edit') {
			$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
			$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
			$stmt->execute(array($userid));
			$row = $stmt->fetch();
			$count = $stmt->rowCount();
			if ($count > 0) { ?>

				<h1 class="text-center">Edit Member</h1>
				<div class="container">
					<form class="form-horizontal" action="?do=Update" method="POST">
						<input type="hidden" name="userid" value="<?php echo $userid ?>" />
						<?php  
								$name_flage=array('Username','Password','Email','FullName');
								inputformupdate($name_flage,$row);	
				        ?>
						<div class="form-group form-group-lg">
						
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="Save" class="btn btn-primary btn-lg " />
							</div>
						</div>
					</form>
				</div>
			<?php
			} else {
				echo "<div class='container'>";
				$theMsg = '<div class="alert alert-danger">Theres No Such ID</div>';
				redirectHome($theMsg);
				echo "</div>";
			}
		} 
		
		/*
			** Title  page  UPDATE
			**the page  UPDATE user
		*/
		 elseif ($do == 'Update') { 

			echo "<h1 class='text-center'>Update Member</h1>";
			echo "<div class='container'>";
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				filteruser('Update');
			} else {
				echo "<div class='container'>";
				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';
				redirectHome($theMsg);
			}
			echo "</div>";
		}
		
		/*
			** Title  page DELETE
			**the page  detele user
		*/
		elseif ($do == 'Delete') { 
			echo "<h1 class='text-center'>Delete Member</h1>";
			echo "<div class='container'>";	
			$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
			deletesql('UserID', 'users', $userid);
			echo '</div>';
		} 
		include $tpl . 'footer.php';
	} else {
		header('Location: index.php');
		exit();
	}
	ob_end_flush(); 
?>