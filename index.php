<?php include 'head.php'; 
if (!isset($_SESSION['admin_id'])) {
	header('location: login.php');
}
$query = "SELECT id FROM category WHERE status = '1' ";
$run = mysqli_query($con, $query);
$count_category = mysqli_num_rows($run);	
	
$query = "SELECT id FROM patients WHERE status = '1' ";
$run = mysqli_query($con, $query);
$count_patient = mysqli_num_rows($run);	
	
$query = "SELECT id FROM tests WHERE status = '1' ";
$run = mysqli_query($con, $query);
$count_test = mysqli_num_rows($run);	
	
$query = "SELECT * FROM `tests` WHERE `status` = '1' AND `test_result` = 'pending'";
$run = mysqli_query($con, $query);
$count_test_pending = mysqli_num_rows($run);	
	
$query = "SELECT * FROM `tests` WHERE `status` = '1' AND `test_result` != 'pending'";
$run = mysqli_query($con, $query);
$test_complete = mysqli_num_rows($run);	
	
?>
  <title>Document</title>
</head>
<body style="background-color: darkred;margin-top: 10px">
<div class="container">
<?php include 'navigation.php'; ?>

<div class="container">
	<div class="row" style="margin-bottom: 50px">
		<div class="col-md-6">
			<div class="panel panel-danger" style="text-align: center;">
			  <div class="panel-heading">
			    <h3 class="panel-title">TYPES OF TESTS </h3>
			  </div>
			  <div class="panel-body">
			  	<img src="images/category-icon.jpg" width="100px" height="100px" align="CATEGORIES"><br>
			    <h3 class="btn btn-primary"><?php echo $count_category; ?></h3>
			  </div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-danger" style="text-align: center;">
			  <div class="panel-heading">
			    <h3 class="panel-title">TOTAL REGISTER PATIENTS </h3>
			  </div>
			  <div class="panel-body">
			  	<img src="images/patient.png" width="100px" height="100px" align="CATEGORIES"><br>
			    <h3 class="btn btn-info"><?php echo $count_patient; ?></h3>
			  </div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-info" style="text-align: center;">
			  <div class="panel-heading">
			    <h3 class="panel-title">TOTAL TESTS TAKKEN </h3>
			  </div>
			  <div class="panel-body">
			  	<img src="images/tests.png" width="100px" height="100px" align="CATEGORIES"><br>
			    <h3 class="btn btn-info"><?php echo $count_test; ?></h3>
			  </div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-primary" style="text-align: center;">
			  <div class="panel-heading">
			    <h3 class="panel-title">TOTAL COMPLETE TEST </h3>
			  </div>
			  <div class="panel-body">
			  	<img src="images/pending_tests.jpg" width="100px" height="100px" align="CATEGORIES"><br>
			    <h3 class="btn btn-danger"><?php echo $test_complete; ?></h3>
			  </div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-primary" style="text-align: center;">
			  <div class="panel-heading">
			    <h3 class="panel-title">TOTAL PENDING TESTS</h3>
			  </div>
			  <div class="panel-body">
			  	<img src="images/complete_tests.jpg" width="100px" height="100px" align="CATEGORIES"><br>
			    <h3 class="btn btn-danger"><?php echo $count_test_pending; ?></h3>
			  </div>
			</div>
		</div>

	</div>

</div>

</div>
<?php include 'footer.php'; ?>

  