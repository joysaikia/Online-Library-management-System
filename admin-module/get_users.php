<?php 
require_once("includes/config.php");
  $userid= strtoupper($_POST["userid"]);
    $sql ="SELECT USER_ID, USERNAME,USER_STATUS,USER_EMAIL FROM tbl_users where USER_STATUS=1";
    if ($userid){
      $sql=$sql." and USER_ID=".$userid;
    }
    
$query= $dbh -> prepare($sql);
// $query-> bindParam(':userid', $userid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach ($results as $result) {
?>
<?php  
 echo "<option id=".$result->USER_ID." VALUE=".$result->USER_ID.">".$result->USERNAME."<option>";
}
}
 else{
  
  echo "<span style='color:red'> Invaid User Id. Please Enter Valid User id .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
?>