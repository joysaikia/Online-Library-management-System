<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['issue']))
{
$userid=strtoupper($_POST['userid']);
$bookaccid=$_POST['bookaccid'];
$isissued=1;
$sql="INSERT INTO  tbl_issuenreturn(USERS_FK_ID,ACCESSION_FK_ID) VALUES(:userid,:bookaccid);
update tbl_bookmaster set BOOK_STATUS=:isissued where BOOK_ACCESSION_ID=:bookaccid;";
$query = $dbh->prepare($sql);
$query->bindParam(':userid',$userid,PDO::PARAM_STR);
$query->bindParam(':bookaccid',$bookaccid,PDO::PARAM_STR);
$query->bindParam(':isissued',$isissued,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Book issued successfully";
header('location:manage-issued-books.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:manage-issued-books.php');
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
    <title>Issue a new Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get user name

function getuser() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_users.php",
data:'userid='+$("#userid").val(),
type: "POST",
success:function(data){
$("#user").append(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data); 
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Issue a New Book</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
<div class="panel panel-info">
<div class="panel-heading">
Issue a New Book
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>USER ID<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="userid" id="userid" onBlur="getuser()" autocomplete="off"  required />
<select calss="form-control" id="user" name="user">
    <option>Select an User</option>
</select>
</div>

<div class="form-group">
<span id="get_user_name" style="font-size:16px;"></span> 
</div>





<div class="form-group">
<label>ISBN Number or Book Title<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="booikid" id="bookid" onBlur="getbook()"  required="required" />
</div>

 <div class="form-group" id="get_book_name">

 </div>
<button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book </button>

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
