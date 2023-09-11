<?php 
require_once("includes/config.php");
// code user email availablity
if(!empty($_POST["USER_EMAIL"])) {
	$email= $_POST["USER_EMAIL"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

		echo "Invalid Email";
	}
	else {
		$sql ="SELECT USER_EMAIL FROM tbl_users WHERE USER_EMAIL=:email";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Email already in use .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Email available .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}


?>
