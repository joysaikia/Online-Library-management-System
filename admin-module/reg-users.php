<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

// code for block users 
if(isset($_GET['inid']))
{
$id=$_GET['inid'];
$status=0;
$sql = "update tbl_users set USER_STATUS=:status  WHERE USER_ID=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:reg-users.php');
}



//code for active users
if(isset($_GET['id']))
{
$id=$_GET['id'];
$status=1;
$sql = "update tbl_users set USER_STATUS=:status  WHERE USER_ID=:id";
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
    <title>Manage Registered Users</title>
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
                <h4 class="header-line">Manage Registered Users</h4>
    </div>


        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Reg Users
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>USER ID</th>
                                            <th>USER Name</th>
                                            <th>Email ID</th>
                                            <th>Reg Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT * from tbl_users";
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
                                            <td class="center"><?php echo htmlentities($result->USER_EMAIL);?></td>
                                             <td class="center"><?php echo htmlentities($result->USER_CREATED_ON);?></td>
                                            <td class="center"><?php if($result->USER_STATUS[0]==1)
                                            {
                                                echo htmlentities("Active");
                                            } else {


                                            echo htmlentities("Blocked");
}
                                            ?></td>
                                            <td class="center">
<?php if($result->USER_STATUS==1)
 {?>
<a href="reg-users.php?inid=<?php echo htmlentities($result->USER_ID);?>" onclick="return confirm('Are you sure you want to block this user?');" >  <button class="btn btn-danger"> Inactive</button>
<?php } else {?>

<a href="reg-users.php?id=<?php echo htmlentities($result->USER_ID);?>" onclick="return confirm('Are you sure you want to active this user?');"><button class="btn btn-primary"> Active</button> 
                                            <?php } ?>

<a href="user-history.php?userid=<?php echo htmlentities($result->USER_ID);?>"><button class="btn btn-success"> Details</button> 

                                          
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
