<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.html');
}
else{ 
if(isset($_POST['update']))
{    
$uid=$_SESSION['userid'];  
$fname=$_POST['fullname'];

$sql="update tbl_users set USERNAME=:fname where USER_ID=:uid";
$query = $dbh->prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Your profile has been updated")</script>';
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
    <title>Nedfi Library| User Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> 

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">My Profile</h4>
                
                            </div>

        </div>
             <div class="row">
           
<div class="col-md-9 col-md-offset-1">
               <div class="panel panel-danger">
                        <div class="panel-heading">
                           My Profile
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post">
<?php 
$uid=$_SESSION['userid'];
$sql="SELECT USER_ID,USERNAME,USER_EMAIL,USER_CREATED_ON,USER_UPDATED_ON,USER_STATUS from tbl_users where USER_ID=:uid ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="form-group">
<label>USER ID : </label>
<?php echo htmlentities($result->USER_ID);?>
</div>

<div class="form-group">
<label>Registration Date : </label>
<?php echo htmlentities($result->USER_CREATED_ON);?>
</div>
<?php if($result->USER_UPDATED_ON!=""){?>
<div class="form-group">
<label>Last Updation Date : </label>
<?php echo htmlentities($result->USER_UPDATED_ON);?>
</div>
<?php } ?>


<div class="form-group">
<label>Profile Status : </label>
<?php if($result->USER_STATUS==1){?>
<span style="color: green">Active</span>
<?php } else { ?>
<span style="color: red">Blocked</span>
<?php }?>
</div>


<div class="form-group">
<label>Enter Full Name</label>
<input class="form-control" type="text" name="fullname" value="<?php echo htmlentities($result->USERNAME);?>" autocomplete="off" required />
</div>

                                        
<div class="form-group">
<label>Enter Email</label>
<input class="form-control" type="email" name="email" id="emailid" value="<?php echo htmlentities($result->USER_EMAIL);?>"  autocomplete="off" required readonly />
</div>
<?php }} ?>
                              
<button type="submit" name="update" class="btn btn-primary" id="submit">Update Now </button>

                                    </form>
                            </div>
                        </div>
                            </div>
        </div>
    </div>
    </div>
</body>
</html>
<?php } ?>
