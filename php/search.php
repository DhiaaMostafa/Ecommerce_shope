<?php

$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "acounts"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
  
}
$type = $_POST['type'];//search type sugest or applay

// Search result
if($type == 1){ //show suggest words from database
  $searchText = $_POST['search'];

  $sql = "SELECT disc FROM prod where disc like '%".$searchText."%' order by disc asc ";

  $result = mysqli_query($con,$sql);

  $search_arr = array();

  while($fetch = mysqli_fetch_assoc($result)){
      
      $name = $fetch['disc'];

      $search_arr[] = array( "name" => $name);
  }

  echo json_encode($search_arr);
}


else{ //applay search operation
  $searchText = $_POST['search'];

  $sql = "SELECT fluidimg,hoverimg,disc,price_dc,price_sale FROM prod where disc like '%".$searchText."%' order by disc asc ";

  $result = mysqli_query($con,$sql);

  $search_arr = array();

  while($fetch = mysqli_fetch_assoc($result)){
      $fluidimg = $fetch['fluidimg'];
      $hoverimg = $fetch['hoverimg'];
      $disc=$fetch['disc'];
$pricedc= $fetch['price_dc'];
$pricesale= $fetch['price_sale'];
      $search_arr[] = array("fluidimg" => $fluidimg, "hoverimg" => $hoverimg,"disc"=>$disc,"pricedc"=> $pricedc,
    'pricesale'=>$pricesale
        );
  }
//return search results as json format
  echo json_encode($search_arr);
}



// get User data
?>