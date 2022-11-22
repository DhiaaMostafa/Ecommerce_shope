<?php

	ob_start(); 
	session_start();
	if (isset($_SESSION['Username'])) {
		$pageTitle = 'Dashboard';
		include 'init.php';
		$numUsers = 6; 
		$latestUsers = getLatest("*", "users", "UserID", $numUsers); 
		$numprodects = 6;
		$latestprodects = getLatest("*", 'products', 'productsID', $numprodects); 
		$numComments = 4;

		?>

		<div class="home-stats">
			<div class="container text-center">
				<h1>Dashboard</h1>
				<div class="row">
					<div class="col-md-3">
						<div class="stat st-members">
							<i class="fa fa-users"></i>
							<div class="info">
								Total users
								<span>
									<a href="members.php"><?php echo countItems('UserID', 'users') ?></a>
								</span>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="stat st-pending">
							<i class="fa fa-user-plus"></i>
							<div class="info">
							    users/cleint
								<span>
									<a href="members.php?do=Manage&page=Pending">
										<?php echo checkelement("GroupID", "users", 1) ?>
										
									</a>
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stat st-items">
							<i class="fa fa-tag"></i>
							<div class="info">
								Total prodect
								<span>
									<a href="items.php"><?php echo countItems('productsID', 'products') ?></a>
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stat st-comments">
							<i class="fa fa-comments"></i>
							<div class="info">
								Total Comments
								<span>
									<a href="comments.php"><?php echo countItems('c_id', 'comments') ?></a>
								</span>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>



		<div class="latest">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-users"></i> 
								Latest <?php echo $numUsers ?> Registerd Users 
								<span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled latest-users">
								<?php
									if (! empty($latestUsers)) {
										foreach ($latestUsers as $user) {
											echo '<li>';
												echo $user['Username'];
												echo '<a href="users.php?do=Edit&userid=' . $user['UserID'] . '">';
													echo '<span class="btn btn-success pull-right">';
														echo '<i class="fa fa-edit"></i> Edit';
													echo '</span>';
												echo '</a>';
											echo '</li>';
										}
									} else {
										echo 'There\'s No Members To Show';
									}
								?>
								</ul>
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-tag"></i> Latest <?php echo $numprodects ?> prodect
								<span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled latest-users">
									<?php
										if (! empty($latestprodects)) {
											foreach ($latestprodects as $pro) {
												echo '<li>';
													echo $pro['Name'];
													echo '<a href="prodect.php?do=Edit&itemid=' . $pro['productsID'] . '">';
														echo '<span class="btn btn-success pull-right">';
															echo '<i class="fa fa-edit"></i> Edit';
														echo '</span>';
													echo '</a>';
												echo '</li>';
											}
										} else {
											echo 'There\'s No Items To Show';
										}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>



				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-comments-o"></i> 
								Latest <?php echo $numComments ?> Comments 
								<span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>
							</div>
							<div class="panel-body">
								<?php
									$stmt = $con->prepare("SELECT 
																comments.*, users.Username AS Member  
															FROM 
																comments
															INNER JOIN 
																users 
															ON 
																users.UserID = comments.user_id
															ORDER BY 
																c_id DESC
															LIMIT $numComments");

									$stmt->execute();
									$comments = $stmt->fetchAll();

									if (! empty($comments)) {
										foreach ($comments as $comment) {
											echo '<div class="comment-box">';
												echo '<span class="member-n">
													<a href="users.php?do=Edit&userid=' . $comment['user_id'] . '">
														' . $comment['Member'] . '</a></span>';
												echo '<p class="member-c">' . $comment['comment'] . '</p>';
											echo '</div>';
										}
									} else {
										echo 'There\'s No Comments To Show';
									}
								?>
							</div>
						</div>
					</div>
					<!--  ******************************-->
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-tag"></i> Latest <?php echo $numprodects ?> prodects
								<span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled latest-users">
									<?php
										if (! empty($latestprodects)) {
											foreach ($latestprodects as $pro) {
												echo '<li>';
													echo $pro['Name'];
													echo '<a href="prodect.php?do=Edit&itemid=' . $pro['productsID'] . '">';
														echo '<span class="btn btn-success pull-right">';
															echo '<i class="fa fa-edit"></i> Edit';
														echo '</span>';
													echo '</a>';
												echo '</li>';
											}
										} else {
											echo 'There\'s No Items To Show';
										}
									?>
								</ul>
							</div>
						</div>
					</div>
					<!--  ******************************-->
				</div>
			</div>
		</div>
		<?php
		include $tpl . 'footer.php';
	} 
	ob_end_flush(); 
?>