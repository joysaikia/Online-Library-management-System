<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.html');
}
else{ 

    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>NEDFi Library</title>
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
                <h4 class="header-line">Manage Issued Books</h4>
    </div>
    

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Issued Books 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Book Name</th>
                                            <th>ISBN </th>
                                            <th>Issued Date</th>
                                            <th>Return Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$uid=$_SESSION['userid'];
$sql="SELECT tbl_bookdetails.BOOK_TITLE,tbl_bookdetails.ISBN,tbl_issuenreturn.ISSUE_DATE,tbl_issuenreturn.RETURN_DATE,tbl_issuenreturn.ISSUE_ID as rid from tbl_issuenreturn join tbl_users on tbl_users.USER_ID=tbl_issuenreturn.USERS_FK_ID join tbl_bookmaster on tbl_bookmaster.BOOK_ACCESSION_ID=tbl_issuenreturn.ACCESSION_FK_ID join tbl_bookdetails on tbl_bookmaster.BOOK_ID=tbl_bookdetails.BOOK_ID where tbl_users.USER_ID=".$uid." order by tbl_issuenreturn.ISSUE_ID desc";
$query = $dbh -> prepare($sql);
//$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->BOOK_TITLE);?></td>
                                            <td class="center"><?php echo htmlentities($result->ISBN);?></td>
                                            <td class="center"><?php echo htmlentities($result->ISSUE_DATE);?></td>
                                            <td class="center"><?php if($result->RETURN_DATE=="")
                                            {?>
                                            <span style="color:red">
                                             <?php   echo htmlentities("Not Return Yet"); ?>
                                                </span>
                                            <?php } else {
                                            echo htmlentities($result->RETURN_DATE);
                                        }
                                            ?>
                                         
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
    </div>

</body>
</html>
<?php } ?>