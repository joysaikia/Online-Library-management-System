<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

// code for block User   
if(isset($_GET['inid']))
{
$id=intval($_GET['inid']);
$status=0;
$sql = "update tbl_users set USER_STATUS=:status WHERE USER_ID=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:reg-users.php');
}



//code for active users
if(isset($_GET['id']))
{
$id=intval($_GET['id']);
$status=1;
$sql = "update tbl_users set USER_STATUS=:status WHERE USER_ID=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:reg-users.php');
}


    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>NEDFi | USER LOG</title>
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
                <?php $uid=$_GET['userid']; ?>
                <h4 class="header-line"><?php echo $uid;?> Book Issued History</h4>
    </div>


        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">

<?php echo $uid;?> Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User id</th>
                                            <th>User name</th>
                                            <th>Issued Book  </th>
                                            <th>Issued Date</th>
                                            <th>Returned Date</th>
                                            <th>Status</th>
                                            <th>Updated On</th>
                                            <th>Updated By</th>
          
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$sql = "SELECT tbl_issuenreturn.UPDATED_ON, tbl_issuenreturn.UPDATED_BY,tbl_users.USER_ID ,tbl_users.USERNAME,tbl_users.USER_EMAIL,tbl_bookdetails.BOOK_TITLE,tbl_bookdetails.ISBN,tbl_issuenreturn.ISSUE_DATE,tbl_issuenreturn.RETURN_DATE,tbl_issuenreturn.ISSUE_ID as rid,tbl_issuenreturn.STATUS,tbl_bookdetails.BOOK_ID as bid,tbl_bookdetails.BOOK_IMG from tbl_issuenreturn join tbl_users on tbl_users.USER_ID=tbl_issuenreturn.USERS_FK_ID join tbl_bookmaster on tbl_bookmaster.BOOK_ACCESSION_ID=tbl_issuenreturn.ACCESSION_FK_ID join tbl_bookdetails on tbl_bookdetails.BOOK_ID=tbl_bookmaster.BOOK_ID where tbl_users.USER_ID='$uid'";
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
                                            <td class="center"><?php echo htmlentities($result->USER_ID);?></td>
                                            <td class="center"><?php echo htmlentities($result->USERNAME);?></td>
                                            <td class="center"><?php echo htmlentities($result->BOOK_TITLE);?></td>
                                            <td class="center"><?php echo htmlentities($result->ISSUE_DATE);?></td>
                                            <td class="center"><?php if($result->RETURN_DATE==''): echo "Not returned yet";
                                            else: echo htmlentities($result->RETURN_DATE); endif;?></td>
                                            <td class="center"><?php if($result->STATUS==1): echo "Returned";
                                              else: echo "Not returned"; endif;
                                             ?></td>
                                             <td class="center"><?php echo htmlentities($result->UPDATED_ON);?></td>
                                             <td class="center"><?php echo htmlentities($result->UPDATED_BY);?></td>
                                            
                            
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
