<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{
// Code for USER ID
$count_my_page = "userid.txt";
$fp = fopen($count_my_page, "r+");
if (flock($fp, LOCK_EX)) {
$hits = fgets($fp);
$currentId = filter_var($hits, FILTER_SANITIZE_NUMBER_INT); //string part of the id
$nextId = $currentId + 1;
$updatedId = 'UID' . str_pad($nextId, strlen($currentId), '0', STR_PAD_LEFT); //incrementing 1 to the numerical part
rewind($fp);
fputs($fp, $updatedId);
flock($fp, LOCK_UN);
} else {
exit();
}
fclose($fp);
$suid = $updatedId; 
$fullname=$_POST['fname'];
$username=$_POST['username'];
$password=md5($_POST['password']);
$usertype=2;
$email=$_POST['email']; 
$status=1;
$sql="INSERT INTO tbl_users(USERS_GENERATED_ID,NAME_OF_USER,USERNAME,USER_PASSWORD,USER_TYPE,USER_EMAIL,USER_STATUS) VALUES(:suid,:fname,:username,:password,:usertype,:email,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':suid',$suid,PDO::PARAM_STR);
$query->bindparam(':fname',$fullname,PDO::PARAM_STR);
$query->bindparam(':username',$username,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':usertype',$usertype,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo '<script>alert("Your registration was successful and your user id is  "+"'.$suid.'")</script>';
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>NEDFi Library Sign-up</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match!!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>    

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">User Signup</h4>
                
                            </div>

        </div>
             <div class="row">
           
<div class="col-md-9 col-md-offset-1">
               <div class="panel panel-danger">
                        
                        <div class="panel-body">
                            <form name="signup" method="post" onSubmit="return valid();">


 <div class="form-group">
<label>Enter your full name</label>
<input class="form-control" type="text" name="fname" autocomplete="off" required />
</div>

<div class="form-group">
<label>Enter username</label>
<input class="form-control" type="text" name="username" autocomplete="off" required />
</div>


                                        
<div class="form-group">
<label>Enter Email</label>
<input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()"  autocomplete="off" required  />
   <span id="user-availability-status" style="font-size:12px;"></span> 
</div>

<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="password" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Confirm Password </label>
<input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
</div>
                             
<button type="submit" name="signup" class="btn btn-danger" id="submit">Register Now </button>
<a href="adminlogin.php" class="ca">Already have an account?</a>

                                    </form>
                            </div>
                        </div>
                            </div>
        </div>
    </div>
    </div>
</body>
</html>