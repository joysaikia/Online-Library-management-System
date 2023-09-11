<?php 
require_once("includes/config.php");
//code check email
if(!empty($_POST["isbn"])) {
$isbn=$_POST["isbn"];
$sql ="SELECT BOOK_ID FROM tbl_bookdetails WHERE ISBN=:isbn";
$query= $dbh -> prepare($sql);
$query-> bindParam(':isbn', $isbn, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
 
if($query -> rowCount() > 0){
echo "<span style='color:red'> ISBN already exists with another book. .</span>"; 
echo "<script>$('#add').prop('disabled',true);</script>";
} else { echo "<script>$('#add').prop('disabled',false);</script>";}
}