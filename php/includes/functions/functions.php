<?php

	/* Function To Get All Records From Any Database Table */

	function getAllFrom($field, $table, $where = NULL, $and = NULL, $orderfield, $ordering = "DESC") {
		global $con;
		$getAll = $con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering");
		$getAll->execute();
		$all = $getAll->fetchAll();
		return $all;
	}

	/*  Title Function That Echo The Page Title In Case The Page   */
	function getTitle() {
		global $pageTitle;
		if (isset($pageTitle)) {
			echo $pageTitle;
		} else {
			echo 'Default';
		}
	}

	/*  This Function Accept Parameters  */

	function redirectHome($theMsg, $url = null, $seconds = 3) {
		if ($url === null) {
			$url = 'index.php';
			$link = 'Homepage';
		} else {
			if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
				$url = $_SERVER['HTTP_REFERER'];
				$link = 'Previous Page';
			} else {
				$url = 'index.php';
				$link = 'Homepage';
			}
		}
		echo $theMsg;
		echo "<div class='alert alert-info'>You Will Be Redirected to $link After $seconds Seconds.</div>";
		header("refresh:$seconds;url=$url");
		exit();
	}


	/* Function to Check Item In Database [ Function Accept Parameters ]  */
	function checkelement($select, $from, $value) {
		global $con;
		$statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
		$statement->execute(array($value));
		$count = $statement->rowCount();
		return $count;
	}

	/*  Function To Count Number Of Items Rows  */
	function countItems($item, $table) {
		global $con;
		$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
		$stmt2->execute();
		return $stmt2->fetchColumn();
	}

	/*  Function To Get Latest Items From Database [ Users, prodect, Comments]  */

	function getLatest($select, $table, $order, $limit = 5) {

		global $con;
		$getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
		$getStmt->execute();
		$rows = $getStmt->fetchAll();
		return $rows;

	}

		/*  Function To delete From Database [ Users, prodect, Comments]  */
	function deletesql($id , $table, $numid )
	{
		global $con;
		$check = checkelement($id, $table , $numid);
		if ($check > 0) {
			$stmt = $con->prepare("DELETE FROM  $table  WHERE $id = :zuser");
			$stmt->bindParam(":zuser", $numid);
			$stmt->execute();
			$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';
			redirectHome($theMsg, 'back');
			} else {
				$theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';
				redirectHome($theMsg);
			}
    }
	
/*  Function To CHECK THE ITEMS TO CORRECT OR NOT [ Users, prodect, Comments]  */
		function checkfiter($flage )
		{  foreach( $flage as $filter){ 
				if(gettype($filter)== 'string'){
				  if (empty($filter)) {
					return  $filter .' Can\'t be <strong>Empty</strong>';
				}
				}elseif(gettype($filter)== 'integer'){
					if ($filter == 0) {
						 return 'You Must Choose the <strong>'.$filter.'</strong>';
					}
				}else{
					exit();
				}
		   }
			
		}
	
		/*  Function To from to used to insert From Database [ Users, prodect]  */
	
	function inputformadd( $name_flag ){
		foreach( $name_flag as $x){ 
				 echo '<div class="form-group form-group-lg ">';
				 echo '<label class="col-sm-3 control-label">'.$x.'</label>';
				 echo '<div class="col-sm-10 col-md-9">';
					if($x =='Password')
					{	
				    echo '<input type="Password" name="'.$x.'" class="form-control" 
						required placeholder="'.$x.'" />';
					}elseif($x == 'Email'){
					echo '<input type="email" name="'.$x.'" class="form-control" 
						required placeholder="'.$x.'" />';
					}else{
					echo '<input type="text" name="'.$x.'" class="form-control"
					required placeholder="'.$x.'" data-class=".live-price" />';
					}
				echo '</div> </div>';
		} 
	}
	
	/*  Function To from to used to update From Database [ Users, prodect]  */
	function inputformupdate($name_flage , $row){
		foreach( $name_flage as $x)
		{ 
			echo '<div class="form-group form-group-lg">';
			echo '<label class="col-sm-3 control-label">'.$x .'</label>';
			echo '<div class="col-sm-10 col-md-9">';
			if($x =='Password')
			{
				echo '<input type="hidden" name="oldpassword" value="'.$row[$x].'" >';
				echo '<input type="password" name="newpassword" class="form-control"  placeholder="'.$x.'" />';
			}elseif($x=='Email'){
				echo '<input type="Email" name="'.$x.'" class="form-control" 
				required placeholder="'.$x.'" value="'.$row[$x].'" />';
			
			}else{
				echo '<input type="text" name="'.$x.'" class="form-control" 
				required  placeholder="'.$x.'" value="'.$row[$x].'" />';
	
			}
			echo '</div> </div>';
		} 
	}
	

	/*
	<?PHP 
				   $name_stat=array('Total Members','Pending Members','Total Items','Total Comments');
				   $name_class=array('st-members','st-pending','st-items','st-comments');
				   $countitem=array(countItems('UserID', 'users'),checkelement("RegStatus", "users", 0),
					countItems('products_ID', 'products'), countItems('c_id', 'comments'));
					for($x=1;$x<4;$x++){
						echo'<div class="col-md-3"><div class="stat st-members">';
						echo '<i class="fa fa-users"></i>';
						echo '<div class="info">Total Members<span>';
						echo '<a href="members.php">'.$countitem[$x].'</a> ';
						echo  '	</span></div></div></div> ';
					}

				?>
	*/
