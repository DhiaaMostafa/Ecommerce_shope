
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acounts";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT  fluidimg, disc,price_dc,price_sale FROM images";
$result = $conn->query($sql);

$p='';   
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
$p.=$row['disc'].',';
    }
} 

$conn->close();
print  "<script scr='js/jquery.min.js'></script><script>
  var t='{$p}';
  setTimeout(function(){
  
$('.fa-icon').each(function(){
    if(t.indexOf($(this).parent().find('.imginfo').text()+',')!=-1)
    $(this).addClass('active');
});},1000);
</script>";
   

?>