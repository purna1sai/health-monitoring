<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['hmmsaid']==0)) {
  header('location:logout.php');
  } else{
    
  
?>
<!DOCTYPE html>
<html lang="en">


<!-- patients23:17-->
<head>
    
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Health Monitoring Management System - View History of Sugar Monitoring</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    
</head>

<body>
    <div class="main-wrapper">
      
   <?php include_once('includes/header.php');?>
        <?php include_once('includes/sidebar.php');?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">History of Sugar Monitoring</h4>
                    </div>
                   
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<?php
                    
                $fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$member=$_POST['member'];
$sql="SELECT * from tblmember where ID=:member";
$query = $dbh -> prepare($sql);
$query-> bindParam(':member', $member, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                            <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                               
<tr>
  <th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Member Detail</th>
</tr>
<tr>
    <th>Full Name</th>
    <td><?php  echo $row->FullName;?></td>
    <th>Gender</th>
    <td><?php  echo $row->Gender;?></td>
  </tr>
  

  <tr>
    
   <th>Age</th>
    <td><?php  echo $row->Age;?></td>
    <th>Weight</th>
    <td><?php  echo $row->Weight;?></td>
  </tr>
<?php $cnt=$cnt+1;}} ?>
   <tr>
    <tr>
  <th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Report from (<?php echo $fdate?> to <?php echo $tdate?>) of Blood Sugar</th>
</tr>
<tr>
   <th colspan="2">Type of Test</th>
   <th>Level of Blood Sugar</th>
   <th>Monitoring Date</th>
  </tr>
 <?php
                  
             
$sql="SELECT * from tblsugar where MemberID=:member";
$query = $dbh -> prepare($sql);
$query-> bindParam(':member', $member, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
 <tr>
    
   <td colspan="2"><?php  echo htmlentities($row->Typeoftest);?></td>
   <td><?php  echo htmlentities($row->BloodSugar);?></td>
  
   <td><?php  echo htmlentities($row->EnterDate);?></td>
  </tr>
<?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> Data Not Available</td>

  </tr>
  <?php } ?>

</table> 
						</div>
					</div>
                </div>
            </div>
        
        </div>
		
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html><?php }  ?>