<?php
	ob_start(); 
	session_start();
	$pageTitle = 'Categories';
	if (isset($_SESSION['Username'])) {
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		/*
			** Title  page  manage
			** The page  Mangage Category
		*/
		if ($do == 'Manage') {
			$sort = 'asc';
			$sort_array = array('asc', 'desc');
			if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
				$sort = $_GET['sort'];
			}

			$stmt2 = $con->prepare("SELECT * FROM categories WHERE parent = 0 ORDER BY Ordering $sort");
			$stmt2->execute();
			$cats = $stmt2->fetchAll(); 
			if (! empty($cats)) {
			?>
			<h1 class="text-center">Manage Categories</h1>
			<div class="container categories">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-edit"></i> Manage Categories
						<div class="option pull-right">
							<i class="fa fa-sort"></i> Ordering: [
							<a class="<?php if ($sort == 'asc') { echo 'active'; } ?>" href="?sort=asc">Asc</a> | 
							<a class="<?php if ($sort == 'desc') { echo 'active'; } ?>" href="?sort=desc">Desc</a> ]
							<i class="fa fa-eye"></i> View: [
							<span class="active" data-view="full">Full</span> |
							<span data-view="classic">Classic</span> ]
						</div>
					</div>
					<div class="panel-body">
						<?php
							foreach($cats as $cat) {
								echo "<div class='cat'>";
									echo "<div class='hidden-buttons'>";
										echo "<a href='categories.php?do=Edit&catid=" . $cat['ID'] . "' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> Edit</a>";
										echo "<a href='categories.php?do=Delete&catid=" . $cat['ID'] . "' class='confirm btn btn-xs btn-danger'><i class='fa fa-close'></i> Delete</a>";
									echo "</div>";
									echo "<h3>" . $cat['Name'] . '</h3>';
							      	$childCats = getAllFrom("*", "categories", "where parent = {$cat['ID']}", "", "ID", "ASC");
							      	if (! empty($childCats)) {
								      	echo "<h4 class='child-head'>Child Categories</h4>";
								      	echo "<ul class='list-unstyled child-cats'>";
										foreach ($childCats as $c) {
											echo "<li class='child-link'>
												<a href='categories.php?do=Edit&catid=" . $c['ID'] . "'>" . $c['Name'] . "</a>
												<a href='categories.php?do=Delete&catid=" . $c['ID'] . "' class='show-delete confirm'> Delete</a>
											</li>";
										}
										echo "</ul>";
									}
								echo "</div>";
								echo "<hr>";
							}
						?>
					</div>
				</div>
				<a class="add-category btn btn-primary" href="categories.php?do=Add"><i class="fa fa-plus"></i> Add New Category</a>
			</div>
			<?php } else {
				echo '<div class="container">';
					echo '<div class="nice-message">There\'s No Categories To Show</div>';
					echo '<a href="categories.php?do=Add" class="btn btn-primary">
							<i class="fa fa-plus"></i> New Category
						</a>';
				echo '</div>';

			} ?>

			<?php

      	/*
			** Title  page  Add
			** The page  ADD Category
		*/

		} elseif ($do == 'Add') { ?>
			<h1 class="text-center">Add New Category</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Insert" method="POST">
				<?php  
  	              $element_cat =array('Name','Description','Ordering');
				   inputformadd( $element_cat ); 
				  ?>

					<div class="form-group form-group-lg">
					   <label class="col-sm-3 control-label">Parent?</label>
					     <div class="col-sm-10 col-md-9">
							<select name="parent" class="form-control">
								<option value="0">None</option>
								<?php 
									$allCats = getAllFrom("*", "categories", "where parent = 0", "", "ID", "ASC");
									foreach($allCats as $cat) {
										echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group form-group-lg">
						<label class="col-sm-3 control-label">Visible</label>
						 <div class="col-sm-10 col-md-9">
							<div>
								<input id="vis-yes" type="radio" name="visibility" value="0" checked />
								<label for="vis-yes">Yes</label> 
							</div>
							<div>
								<input id="vis-no" type="radio" name="visibility" value="1" />
								<label for="vis-no">No</label> 
							</div>
						</div>
					</div>
					<div class="form-group form-group-lg">
						<div class="col-sm-offset-3 col-sm-10">
							<input type="submit" value="Add Category" class="btn btn-primary btn-lg" />
						</div>
					</div>
				</form>
			</div>
			<?php
      	/*
			** Title  page  Insert
			** The page  insert Category
		*/

		} elseif ($do == 'Insert') {

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				echo "<h1 class='text-center'>Insert Category</h1>";
				echo "<div class='container'>";
				$name 		= $_POST['Name'];
				$desc 		= $_POST['Description'];
				$parent 	= $_POST['parent'];
				$order 		= $_POST['Ordering'];
				$visible 	= $_POST['visibility'];
				$check = checkelement("Name", "categories", $name);
				if ($check == 1) {
					$theMsg = '<div class="alert alert-danger">Sorry This Category Is Exist</div>';
					redirectHome($theMsg, 'back');
				} else {
					$stmt = $con->prepare("INSERT INTO 
					categories(Name, Description, parent, Ordering, Visibility)
					VALUES(:zname, :zdesc, :zparent, :zorder, :zvisible)");
					$stmt->execute(array(
						'zname' 	=> $name,
						'zdesc' 	=> $desc,
						'zparent' 	=> $parent,
						'zorder' 	=> $order,
						'zvisible' 	=> $visible  ));
					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
					redirectHome($theMsg, 'back');
				}

			} else {
				echo "<div class='container'>";
				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';
				redirectHome($theMsg, 'back');
				echo "</div>";
			}
			echo "</div>";
		} 
		/*
			** Title  edit  Delete
			** The page  Edit Category
		*/
		elseif ($do == 'Edit') {

			$catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
			$stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");
			$stmt->execute(array($catid));
			$cat = $stmt->fetch();
			$count = $stmt->rowCount();
			if ($count > 0) { ?>
				<h1 class="text-center">Edit Category</h1>
				<div class="container">
					<form class="form-horizontal" action="?do=Update" method="POST">
						<input type="hidden" name="catid" value="<?php echo $catid ?>" />
						<?php
						$element_cat =array('Name','Description','Ordering');
						inputformupdate($element_cat , $cat);
						
						?>
						<div class="form-group form-group-lg">
							<label class="col-sm-3 control-label">Parent?</label>
							<div class="col-sm-10 col-md-9">
								<select name="parent" class="form-control">
									<option value="0">None</option>
									<?php 
										$allCats = getAllFrom("*", "categories", "where parent = 0", "", "ID", "ASC");
										foreach($allCats as $c) {
											echo "<option value='" . $c['ID'] . "'";
											if ($cat['parent'] == $c['ID']) { echo ' selected'; }
											echo ">" . $c['Name'] . "</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-3 control-label">Visible</label>
							<div class="col-sm-10 col-md-9">
								<div>
									<input id="vis-yes" type="radio" name="visibility" value="0" <?php if ($cat['Visibility'] == 0) { echo 'checked'; } ?> />
									<label for="vis-yes">Yes</label> 
								</div>
								<div>
									<input id="vis-no" type="radio" name="visibility" value="1" <?php if ($cat['Visibility'] == 1) { echo 'checked'; } ?> />
									<label for="vis-no">No</label> 
								</div>
							</div>
						</div>
						<div class="form-group form-group-lg">
							<div class="col-sm-offset-3 col-sm-10">
								<input type="submit" value="Save" class="btn btn-primary btn-lg" />
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
			** Title  page  Update
			** The page  update Category
		*/
		elseif ($do == 'Update') {
			echo "<h1 class='text-center'>Update Category</h1>";
			echo "<div class='container'>";
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$id 		= $_POST['catid'];
				$name 		= $_POST['Name'];
				$desc 		= $_POST['Description'];
				$order 		= $_POST['Ordering'];
				$parent 	= $_POST['parent'];
				$visible 	= $_POST['visibility'];
				$stmt = $con->prepare("UPDATE categories 
										SET Name = ?, Description = ?, Ordering = ?, parent = ?, Visibility = ?
										WHERE ID = ?");
				$stmt->execute(array($name, $desc, $order, $parent, $visible,$id));
				$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';
				redirectHome($theMsg, 'back');

			} else {
				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';
				redirectHome($theMsg);
			}
			echo "</div>";
		}
      	/*
			** Title  page  Delete
			** The page  Delete Category
		*/
		 elseif ($do == 'Delete') {
			echo "<h1 class='text-center'>Delete Category</h1>";
			echo "<div class='container'>";
				$catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
				deletesql('ID', 'categories', $catid);
			echo '</div>';
		}
		include $tpl . 'footer.php';
	} 
	ob_end_flush();
?>