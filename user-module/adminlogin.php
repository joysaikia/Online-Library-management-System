<?php
session_start();
error_reporting(0);
ini_set('display_errors', 1);
include('includes/config.php');

if (isset($_SESSION['alogin'])) {
    $_SESSION['alogin'] = '';
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = md5($password); // Update hashing algorithm as needed

    $sql = "SELECT USERNAME,USER_ID, USER_PASSWORD, USER_TYPE FROM tbl_users WHERE USERNAME = :username AND USER_PASSWORD = :password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        $_SESSION['login'] = $_POST['username'];
        foreach ($results as $result) {
          $_SESSION['userid']=$result->USER_ID;
        }
        if ($results[0]->USER_TYPE == 1) {
          $_SESSION['alogin'] = true;
            header("Location: admin/dashboard.php");
            exit;
        } else {
            header("Location:dashboard.php");
            exit;
        }
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="assets/css/loginpage.css">
  <title>Login Page</title>
</head>
<body>
  <div class="container">
    <div class="left-div"><img src="assets/img/library.jpg" alt="Logo">
    </div>
    <div class="right-div">
      <div class="logo"><img src="assets/img/logo.png" alt="Logo"></div>
      <div class="login-form">
        <div class="title">Login</div>
      <form action="adminlogin.php" method="POST"> <!-- Update form action and method -->
        <div class="input-boxes">
          <div class="input-box">
            <input type="text" name="username" placeholder="Username" required> <!-- Added name attribute -->
          </div>
          <div class="input-box">
            <input type="password" name="password" placeholder="Password" required> <!-- Added name attribute -->
          </div>
          <div class="fpass"><a href="user-forgot-password.php">Forgot password?</a></div>
          <div class="button input-box">
            <input type="submit" name="login" value="Login"> <!-- Added name attribute -->
          </div>
          <div class="text sign-up-text"> Don't have an account? <a href="signup.php">Sign-up now</a></div>
        </div>
    </form>
    </div>
    </div>
  </div>
</body>
</html>