<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{
$booktitle=$_POST['booktitle'];
$booktype=$_POST['booktype'];
$author=$_POST['author'];
$isbn=$_POST['isbn'];
$price=$_POST['price'];
$bookid=intval($_GET['bookid']);
$sql="update tbl_bookdetails set BOOK_TITLE=:booktitle,BOOK_TYPE_ID=:booktype,BOOK_AUTHOR_ID=:author,PRICE=:price where BOOK_ID=:bookid";
$query = $dbh->prepare($sql);
$query->bindParam(':booktitle',$booktitle,PDO::PARAM_STR);
$query->bindParam(':booktype',$booktype,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':price',$price,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
echo "<script>alert('Book info updated successfully');</script>";
echo "<script>window.location.href='manage-books.php'</script>";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Edit Book</title>
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
                <h4 class="header-line">Add Book</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md12 col-sm-12 col-xs-12">
<div class="panel panel-info">
<div class="panel-heading">
Book Info
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$bookid=intval($_GET['bookid']);
$sql = "SELECT tbl_bookdetails.BOOK_TITLE,tbl_booktype.BOOK_TYPE_NAME,tbl_booktype.BOOK_TYPE_ID  as tid,tbl_authors.AUTHOR_NAME,tbl_authors.AUTHOR_ID as athrid,tbl_bookdetails.ISBN,tbl_bookdetails.PRICE,tbl_bookdetails.BOOK_ID as bookid,tbl_bookdetails.BOOK_IMG from tbl_bookdetails join tbl_booktype on tbl_booktype.BOOK_TYPE_ID=tbl_bookdetails.BOOK_TYPE_ID join tbl_authors on tbl_authors.AUTHOR_ID=tbl_bookdetails.BOOK_AUTHOR_ID where tbl_bookdetails.BOOK_ID=:bookid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="col-md-6">
<div class="form-group">
<label>Book Image</label>
<img src="bookimg/<?php echo htmlentities($result->BOOK_IMG);?>" width="100">
<a href="change-bookimg.php?bookid=<?php echo htmlentities($result->bookid);?>">Change Book Image</a>
</div></div>

<div class="col-md-6">
<div class="form-group">
<label>Book Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="booktitle" value="<?php echo htmlentities($result->BOOK_TITLE);?>" required />
</div></div>

<div class="col-md-6">
<div class="form-group">
<label> Category<span style="color:red;">*</span></label>
<select class="form-control" name="booktype" required="required">
<option value="<?php echo htmlentities($result->tid);?>"> <?php echo htmlentities($typename=$result->BOOK_TYPE_NAME);?></option>
<?php 
$status=1;
$sql1 = "SELECT * from  tbl_booktype where STATUS=:status";
$query1 = $dbh -> prepare($sql1);
$query1-> bindParam(':status',$status, PDO::PARAM_STR);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
if($typename==$row->BOOK_TYPE_NAME)
{
continue;
}
else
{
    ?>  
<option value="<?php echo htmlentities($row->BOOK_ID);?>"><?php echo htmlentities($row->BOOK_TYPE_NAME);?></option>
 <?php }}} ?> 
</select>
</div></div>

<div class="col-md-6">
<div class="form-group">
<label> Author<span style="color:red;">*</span></label>
<select class="form-control" name="author" required="required">
<option value="<?php echo htmlentities($result->athrid);?>"> <?php echo htmlentities($athrname=$result->AUTHOR_NAME);?></option>
<?php 

$sql2 = "SELECT * from  tbl_authors ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
foreach($result2 as $ret)
{           
if($athrname==$ret->AUTHOR_NAME)
{
continue;
} else{

    ?>  
<option value="<?php echo htmlentities($ret->AUTHOR_ID);?>"><?php echo htmlentities($ret->AUTHOR_NAME);?></option>
 <?php }}} ?> 
</select>
</div></div>


<div class="col-md-6">
<div class="form-group">
<label>ISBN Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISBN);?>"  readonly />
<p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
</div></div>


<div class="col-md-6">
 <div class="form-group">
 <label>Price in USD<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->PRICE);?>"   required="required" />
 </div></div>
 <?php }} ?><div class="col-md-12">
<button type="submit" name="update" class="btn btn-info">Update </button></div>

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
