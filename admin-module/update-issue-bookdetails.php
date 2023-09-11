<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 

    if (isset($_POST['return'])) {
        $rid = intval($_GET['rid']);
        $rstatus = 1;
        $bookid = $_POST['bookid'];
    
        // Get the current date and time
        $returnDate = date('Y-m-d H:i:s');
    
        $sql = "UPDATE tbl_issuenreturn
                SET STATUS = :rstatus, RETURN_DATE = :returnDate
                WHERE ISSUE_ID = :rid;
    
                UPDATE tbl_bookmaster
                SET BOOK_STATUS = 0
                WHERE BOOK_ACCESSION_ID = :bookid";
    
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->bindParam(':rstatus', $rstatus, PDO::PARAM_STR);
        $query->bindParam(':returnDate', $returnDate, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->execute();
    
        $_SESSION['msg'] = "Book Returned successfully";
        header('location:manage-issued-books.php');
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Issued Book Details</title>
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
$("#get_users_name").html(data);
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
                <h4 class="header-line">Issued Book Details</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
<div class="panel panel-info">
<div class="panel-heading">
Issued Book Details
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$rid=intval($_GET['rid']);
$sql = "SELECT tbl_users.USER_ID ,tbl_users.USERNAME,tbl_users.USER_EMAIL,tbl_bookdetails.BOOK_TITLE,tbl_bookdetails.ISBN,tbl_issuenreturn.ISSUE_DATE,tbl_issuenreturn.RETURN_DATE,tbl_issuenreturn.ISSUE_ID as rid,tbl_issuenreturn.STATUS,tbl_bookdetails.BOOK_ID as bid,tbl_bookdetails.BOOK_IMG from tbl_issuenreturn join tbl_users on tbl_users.USER_ID=tbl_issuenreturn.USERS_FK_ID join tbl_bookmaster on tbl_bookmaster.BOOK_ACCESSION_ID=tbl_issuenreturn.ACCESSION_FK_ID join tbl_bookdetails on tbl_bookdetails.BOOK_ID=tbl_bookmaster.BOOK_ID where tbl_issuenreturn.ISSUE_ID=:rid";
$query = $dbh -> prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                   


<input type="hidden" name="bookid" value="<?php echo htmlentities($result->bid);?>">
<h4>User Details</h4>
<hr />
<div class="col-md-6"> 
<div class="form-group">
<label>User ID :</label>
<?php echo htmlentities($result->USER_ID);?>
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label>User Name :</label>
<?php echo htmlentities($result->USERNAME);?>
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label>User Email Id :</label>
<?php echo htmlentities($result->USER_EMAIL);?>
</div></div>


<h4>Book Details</h4>
<hr />

<div class="col-md-6"> 
<div class="form-group">
<label>Book Image :</label>
<img src="bookimg/<?php echo htmlentities($result->BOOK_IMG); ?>" width="120">
</div></div>


<div class="col-md-6"> 
<div class="form-group">
<label>Book Name :</label>
<?php echo htmlentities($result->BOOK_TITLE);?>
</div>
</div>
<div class="col-md-6"> 
<div class="form-group">
<label>ISBN :</label>
<?php echo htmlentities($result->ISBN);?>
</div>
</div>

<div class="col-md-6"> 
<div class="form-group">
<label>Book Issued Date :</label>
<?php echo htmlentities($result->ISSUE_DATE);?>
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label>Book Returned Date :</label>
<?php if($result->RETURN_DATE=="")
                                            {
                                                echo htmlentities("Not Return Yet");
                                            } else {


                                            echo htmlentities($result->RETURN_DATE);
}
                                            ?>
</div>
</div>

 <?php if($result->STATUS==0){?>
    <button type="submit" name="return" id="submit" class="btn btn-info">Return Book </button>

</div>

<?php }}} ?>
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
