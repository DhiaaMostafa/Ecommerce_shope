<?php

	ob_start(); 
	session_start();
	$pageTitle = 'prodect';
	if (isset($_SESSION['Username'])) {
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		if ($do == 'Manage') {
				$stmt = $con->prepare("SELECT products.*, categories.Name AS category_name
										FROM products
										INNER JOIN categories 
										ON categories.ID = products.Cat_ID 
										ORDER BY productsID DESC");
				$stmt->execute();
				$prods = $stmt->fetchAll();
				if (! empty($prods)) {
								?>
<h1 class="text-center">Manage prodect</h1>
<div class="container">
	<div class="table-responsive">
	<table class=" text-center table table-bordered">
		  <tr>
			<td>
			   <a href="prodect.php?do=Add" class="btn btn-sm btn-primary">
		         <i class="fa fa-plus"></i> New prodect
		       </a>
			</td>
			<td>
			<input 
				type="search" name="search"  class="form-control live"  
				placeholder="search of The prodect"
			/>
			</td>
			<td>
			    <a href="prodect.php?do=search" class="btn btn-sm btn-primary">
		           <i class="fa fa-search"></i> search
		        </a>
		  	</td>ؤ
		  </tr>
	 </table>
		<table class="main-table text-center table table-bordered">
		  <tr>
			<td>#ID</td>
			<td>Image</td>
			<td> Name</td>
			<td>Description</td>
			<td>Price</td>
			<td>Adding Date</td>
			<td>Category</td>
		  	<td>Color</td>
		  	<td>type</td>
		  	<td>size</td>
			<td>Control</td>
		  </tr>
			<?php
				foreach($prods as $pro) {
					echo "<tr>";
					    echo "<td>" . $pro['productsID'] . "</td>";
						echo "<td>";
					   	if (empty($pro['Image'])) {
							echo 'No Image';
						} else {
							echo "<img src='".$pro['Image']."' alt='' style='width: 79px; height: 50px;'/>";
						}    
						//echo "<img src='img.png' alt='' style='width: 79px; height: 50px;'/>";
						echo "</td>";
						echo "<td>" . $pro['Name'] . "</td>";
						echo "<td>" . $pro['Description'] . "</td>";
						echo "<td>" . $pro['Price'] . "</td>";
						echo "<td>" . $pro['Add_Date'] ."</td>";
						echo "<td>" . $pro['category_name'] ."</td>";	
						echo "<td>" . $pro['Color'] ."</td>";	
						echo "<td>" . $pro['Type'] ."</td>";
						echo "<td>" . $pro['Size'] ."</td>";		
						echo "<td>
							<a href='prodect.php?do=Edit&itemid=" . $pro['productsID'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
							<a href='prodect.php?do=Delete&itemid=" . $pro['productsID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
						echo "</td>";
					echo "</tr>";
				  }?>
		  <tr>
		</table>
	</div>
	</div>

		<?php } else {
				echo '<div class="container">';
				echo '<div class="nice-message">There\'s No prodect To Show</div>';
				echo '<a href="prodect.php?do=Add" class="btn btn-sm btn-primary">';
				echo '<i class="fa fa-plus"></i> New prodect </a></div>';
		} 

		/*
			** Title  page  Edit
			** the page  Edit  prodect
		*/

		} elseif ($do == 'Add') { 
			 formitems( );
		/*
			** Title  page  Edit
			** the page  Edit  prodect
		*/
		} elseif ($do == 'Insert') {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				echo "<h1 class='text-center'>Insert prodect</h1>";
				echo "<div class='container'>";
				fiteritem( );
			} else {
				echo "<div class='container'>";
				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';
				redirectHome($theMsg);
				echo "</div>";
			}
			echo "</div>";
		
		/*
			** Title  page  Edit
			** the page  Edit  prodect
		*/
		} elseif ($do == 'Edit') {
			$prodectid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
		$stmt = $con->prepare("SELECT * FROM products WHERE productsID  = '{$prodectid}'");
			$stmt->execute(array($prodectid));
			$pro = $stmt->fetch();
			$count = $stmt->rowCount();
			if ($count > 0) { 
				 formitems( $pro , $prodectid );
			} else {
				echo "<div class='container'>";
				$theMsg = '<div class="alert alert-danger">Theres No Such ID</div>';
				redirectHome($theMsg);
				echo "</div>";
			}		
			
		/*
			** Title  page  Update
			** the page  Update  prodect
		*/	
		} elseif ($do == 'Update') {
			echo "<h1 class='text-center'>Update prodect</h1>";
			echo "<div class='container'>";
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				fiteritem();
			} else {
				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';
				redirectHome($theMsg);
			}
			echo "</div>";
		/*
			** Title  page  detele
			** the page  detele  prodect
		*/			
		} elseif ($do == 'Delete') {

			echo "<h1 class='text-center'>Delete prodet</h1>";
			echo "<div class='container'>";
			$prodectid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
			deletesql('productsID', 'products', $prodectid);
			echo '</div>';
		}
		include $tpl . 'footer.php';
	} else {
		header('Location: index.php');
		exit();
	}
	ob_end_flush(); 
?>