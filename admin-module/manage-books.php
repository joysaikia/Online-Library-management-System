<?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $bookId = $_GET['del'];

        // Delete record from tbl_bookmaster (child table)
        $deleteMasterSql = "DELETE FROM tbl_bookmaster WHERE BOOK_ID = :id";
        $deleteMasterQuery = $dbh->prepare($deleteMasterSql);
        $deleteMasterQuery->bindParam(':id', $bookId, PDO::PARAM_STR);
        $deleteMasterQuery->execute();

        // Delete record from tbl_bookdetails (parent table)
        $deleteDetailsSql = "DELETE FROM tbl_bookdetails WHERE BOOK_ID = :id";
        $deleteDetailsQuery = $dbh->prepare($deleteDetailsSql);
        $deleteDetailsQuery->bindParam(':id', $bookId, PDO::PARAM_STR);
        $deleteDetailsQuery->execute();

        $_SESSION['delmsg'] = "Record deleted successfully";
        header('location:manage-books.php');
    }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Manage Books</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                <h4 class="header-line">Manage Books</h4>
    </div>
  


        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Books Listing
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Book Name</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>ISBN</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT tbl_bookdetails.BOOK_TITLE,tbl_booktype.BOOK_TYPE_NAME,tbl_authors.AUTHOR_NAME,tbl_bookdetails.ISBN,tbl_bookdetails.PRICE,tbl_bookdetails.BOOK_ID as bookid,tbl_bookdetails.BOOK_IMG from  tbl_bookdetails join tbl_booktype on tbl_booktype.BOOK_TYPE_ID=tbl_bookdetails.BOOK_TYPE_ID join tbl_authors on tbl_authors.AUTHOR_ID=tbl_bookdetails.BOOK_AUTHOR_ID";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center" width="300">
<img src="bookimg/<?php echo htmlentities($result->BOOK_IMG);?>" width="100">
                                                <br /><b><?php echo htmlentities($result->BOOK_TITLE);?></b></td>
                                            <td class="center"><?php echo htmlentities($result->BOOK_TYPE_NAME);?></td>
                                            <td class="center"><?php echo htmlentities($result->AUTHOR_NAME);?></td>
                                            <td class="center"><?php echo htmlentities($result->ISBN);?></td>
                                            <td class="center"><?php echo htmlentities($result->PRICE);?></td>
                                            <td class="center">

                                            <a href="edit-book.php?bookid=<?php echo htmlentities($result->bookid);?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> 
                                          <a href="manage-books.php?del=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Are you sure you want to delete?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>
                                            </td>
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>


            
    </div>
    </div>


</body>
</html>
<?php } ?>