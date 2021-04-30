<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) 
  {
    $emailormob=$_POST['emailormob'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID FROM tbluser WHERE Email=:emailormob || MobileNumber=:emailormob and Password=:password";
    $query=$dbh->prepare($sql);
    $query->bindParam(':emailormob',$emailormob,PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['hmmsuid']=$result->ID;
}
$_SESSION['login']=$_POST['emailormob'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
<!-- login-->
<head>
    <title>Health Monitoring Management System || Login Page</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
   
</head>

<body>
    <p style="padding-top: 20px;padding-left: 20px"><a href="../index.php"><i class="fa fa-home" aria-hidden="true" style="font-size: 30px;padding-right: 10px"></i>Back Home!!!</a></p>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <form class="form-signin" method="post">
						<div class="account-logo">
                            <a href="login.php"><img src="assets/img/logo1.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Enter Your Email Or Mobile Number</label>
                            <input type="text" class="form-control" value="" name="emailormob" required="true">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" value="" class="form-control" name="password" required="true">
                        </div>
                        <div class="form-group text-right">
                            <a href="forgot-password.php">Forgot your password?</a>
                        </div>
                        <div class="form-group text-right">
                            <a href="register.php">Create an Account</a>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn" name="login">Login</button>
                        </div>
                    </form>
                </div>
			</div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>