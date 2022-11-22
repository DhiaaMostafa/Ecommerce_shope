<?php
// function  update and insert in prodect

function fiteritem( $flageit='')
{  $flageitem = $_GET['do'];
     global $con;
	 $theMsg;
	 $element_items =array('Name','Description','Price' ,'Country_Made');
    $name 		= $_POST['Name'];
    $desc 		= $_POST['Description'];
    $price 		= $_POST['Price'];
    $country	= $_POST['Country_Made'];
    $status 	= $_POST['status'];
    $cat 		= $_POST['category'];
   // $member 	= $_POST['member'];
	$image 	    = $_POST['Image'];
	$color 	    = $_POST['Color'];
	$size 	    = $_POST['Size'];
	$type 	    = $_POST['Type'];
    if($flageitem=='Update')
    {
        $id = $_POST['itemid'];
    }
    $formErrors = array();
    if (empty($name)) {
        $formErrors[] = 'Name Can\'t be <strong>Empty</strong>';
    }
    if (empty($desc)) {
        $formErrors[] = 'Description Can\'t be <strong>Empty</strong>';
    }

    if (empty($price)) {
        $formErrors[] = 'Price Can\'t be <strong>Empty</strong>';
    }

    if (empty($country)) {
        $formErrors[] = 'Country Can\'t be <strong>Empty</strong>';
    }
	if (empty($color)) {
        $formErrors[] = 'color Can\'t be <strong>Empty</strong>';
    }
	if (empty($size)) {
        $formErrors[] = 'size Can\'t be <strong>Empty</strong>';
	}
	if (empty($type)) {
        $formErrors[] = 'type Can\'t be <strong>Empty</strong>';
    }


    if ($status == 0) {
        $formErrors[] = 'You Must Choose the <strong>Status</strong>';
    }

    if ($cat == 0) {
        $formErrors[] = 'You Must Choose the <strong>Category</strong>';
    }
// display all error
    foreach($formErrors as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }

    if (empty($formErrors)) {

    if($flageitem=='Update')
    {
             $stmt = $con->prepare("UPDATE products 
                    SET Name = ?, Description = ?, Price = ?, Country_Made = ?,
                              Status = ?,Cat_ID = ?, Image = ?
                    WHERE productsID = ?");

            $stmt->execute(array($name, $desc, $price, $country, $status, $cat,$image, $id));
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';
   
    }elseif($flageitem =='Insert'){

       $stmt = $con->prepare("INSERT INTO 
              products(Name, Description, Price, Country_Made, Status, Add_Date, Cat_ID, Image)
               VALUES(:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat ,:zimage)");
        $stmt->execute(array(
                'zname' 	=> $name,
                'zdesc' 	=> $desc,
                'zprice' 	=> $price,
                'zcountry' 	=> $country,
                'zstatus' 	=> $status,
                'zcat'		=> $cat,
                'zimage'    => $image
         ));
        $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
    }else {
        header('Location: index.php');
    }
        if($home==0)redirectHome($theMsg, 'back');
    }

}

	/*
	 function update end delete in users

	*/

	function filteruser( $flaguser,$home=0 )
	{   //$pass ='' ;
		$count ;
		global $con;
		$formErrors = array();
		$user 	= $_POST['Username'];
		$email 	= $_POST['Email'];
		$name 	= $_POST['FullName'];
		// Validate The Form
		$formErro = array($user,$email,$name);
		$formErrors = checkfiter($formErro);
				if( $flaguser == 'Insert')
				{
					 $pass     = $_POST['Password'];
                     $hashPass  = sha1($_POST['Password']);
				     if (empty($pass)) {
					     $formErrors[] = 'Password Cant Be <strong>Empty</strong>';
				    }

			    } elseif($flaguser ==='Update'){
					$id 	= $_POST['userid'];
				    $hashPass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
			    }else {
				  header('Location: index.php');
			    }

		if (empty($formErrors)) {            
			if( $flaguser == 'Insert')
			{   
				$count = checkelement("Username", "users", $user);
		     } else
		      {
				$stmt2 = $con->prepare("SELECT *
					FROM users
					WHERE Username = ?
					AND  UserID != ?");
				$stmt2->execute(array($user, $id));
				$count = $stmt2->rowCount();
		      }

			if ($count == 1) {

				$theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';
				if($home==0)redirectHome($theMsg, 'back');

			} else {
				if( $flaguser === 'Insert')
				{
					$stmt = $con->prepare("INSERT INTO 
					users(Username, Password, Email, FullName, GroupID, Date)
					 VALUES(:zuser, :zpass, :zmail, :zname, 1, now()) ");
							$stmt->execute(array(
							'zuser' 	=> $user,
							'zpass' 	=> $hashPass,
							'zmail' 	=> $email,
							'zname' 	=> $name
							));
					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record INSERT</div>';
					if($home==0)redirectHome($theMsg, 'back');
				}
				else
				{
					$stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ? WHERE UserID = ?");
					$stmt->execute(array($user, $email, $name, $pass, $id));
					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record UPDATE</div>';
					if($home==0)redirectHome($theMsg, 'back');

				}
			}
		}
	}

/* form item ////////////////////////
 ** add new item in items page
  update items in items page
  */
function formitems( $item ='' , $itemid='' )
{  $page = $_GET['do']; 
    global $con;  ?>
<h1 class="text-center"><?php echo $page ?> prodect</h1>
  <div class="create-ad block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo $page ?></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8">
					   <form class="form-horizontal main-form" action="?do=<?php if($page =='Add') echo 'Insert'; else  echo 'Update';?>" method="POST">
						<input type="hidden" name="itemid" value="<?php echo $itemid ?>" />
						
                           <?php 
                            $element_items =array('Name','Description','Price' ,'Country_Made','Color','Size','Type');
                             if($page =='Add'){
                                inputformadd( $element_items );
                             }else{
                                inputformupdate($element_items , $item);
							 }
							 
                            ?>
							<div class="form-group form-group-lg">
								<label class="col-sm-3 control-label">Status</label>
								<div class="col-sm-10 col-md-9">
									<select name="status"class='form-control' >
                                      <?php if($page =='Add') { ?>
										<option value="">...</option>
										<option value="1">New</option>
										<option value="2">Like New</option>
										<option value="3">Used</option>
										<option value="4">Very Old</option>
                                       <?php }else { ?>
                                             <option value="1" <?php if ($item['Status'] == 1) { echo 'selected'; } ?>>New</option>
                                             <option value="2" <?php if ($item['Status'] == 2) { echo 'selected'; } ?>>Like New</option>
                                             <option value="3" <?php if ($item['Status'] == 3) { echo 'selected'; } ?>>Used</option>
                                             <option value="4" <?php if ($item['Status'] == 4) { echo 'selected'; } ?>>Very Old</option>
                                           
                                      <?php  } ?>
									</select>
								</div>
							</div>
                            

							<div class="form-group form-group-lg">
								<label class="col-sm-3 control-label">Category</label>
								<div class="col-sm-10 col-md-9" >
									<select name="category"class='form-control'>
										<option value="">...</option>
										<?php
                                        if($page =='Add') {
                                                $allCats = getAllFrom("*", "categories", "where parent = 0", "", "ID");
                                                foreach ($allCats as $cat) {
                                                    echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
                                                    $childCats = getAllFrom("*", "categories", "where parent = {$cat['ID']}", "", "ID");
                                                    foreach ($childCats as $child) {
                                                        echo "<option value='" . $child['ID'] . "'>--- " . $child['Name'] . "</option>";
                                                    }
                                                }
                                        }else {
                                             $allCats = getAllFrom("*", "categories", "where parent = 0", "", "ID");
										     foreach ($allCats as $cat) {
                                                        echo "<option value='" . $cat['ID'] . "'";
                                                            if ($item['Cat_ID'] == $cat['ID']) { echo ' selected'; }
                                                        echo ">" . $cat['Name'] . "</option>";
                                                        $childCats = getAllFrom("*", "categories", "where parent = {$cat['ID']}", "", "ID");
                                                        foreach ($childCats as $child) {
                                                            echo "<option value='" . $child['ID'] . "'";
                                                            if ($item['Cat_ID'] == $child['ID']) { echo ' selected'; }
                                                            echo ">--- " . $child['Name'] . "</option>";
                                                        }
										          }
                                            
                                        }
									 ?>
									</select>
								</div>
							</div>
                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label">image</label>
                                <div class="col-sm-10 col-md-9">
                                    <input  type="file"  name="Image" class="form-control" 
                                         placeholder="Description of The Item" />
                                </div>
                            </div>

							<div class="form-group form-group-lg">
								<div class="col-sm-offset-3 col-sm-9">
									<input type="submit" value="Add Item" class="btn btn-primary btn-sm" />
								</div>
							</div>

						</form>
					</div>

					<!--  end form -->
					<div class="col-md-4">
						<div class="thumbnail item-box live-preview">
							<span class="price-tag">
								$<span class="live-price">0</span>
							</span>
							<img class="img-responsive" src="img.png" alt="" />
							<div class="caption">
								<h3 class="live-title">Title</h3>
								<p class="live-desc">Description</p>
							</div>
						</div>
					</div>
				</div>
    
<?php
  }