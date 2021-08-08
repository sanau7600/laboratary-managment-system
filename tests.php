<?php include 'head.php'; 
if (!isset($_SESSION['admin_id'])) {
	header('location: login.php');
}
?>
  <title>LMS - TESTS</title>
</head>
<body style="background-color: darkred;margin-top: 10px">
<div class="container">
<?php include 'navigation.php'; ?>
 
<div class="container">
<?php 
if (isset($_POST['save'])) {
	$category_id = $_POST['category_id'];
	$patient_id = $_POST['patient_id'];
	$price = $_POST['price'];
	$insert = "INSERT INTO `tests`(`category_id`, `patient_id`, `price`) VALUES('$category_id', '$patient_id', '$price')";
	if (mysqli_query($con, $insert)) {
		echo '<div class="alert alert-success" role="alert"><strong>SUCCESS ! </strong> data added</div>';
	}
}
if (isset($_POST['update_data'])) {
	$id = $_POST['id'];
	$price = $_POST['price'];
	$test_result = $_POST['test_result'];
	$update = "UPDATE `tests`SET price = '$price', test_result = '$test_result' WHERE id = '$id' ";
	if (mysqli_query($con, $update)) {
		echo '<div class="alert alert-success" role="alert"><strong>SUCCESS ! </strong> data updated</div>';
	}
else{
	echo '<div class="alert alert-danger" role="alert"><strong>ERROR ! </strong> '.$con->error.'</div>';
}
}
if (isset($_GET['del'])) {
	$del = $_GET['del'];
	$delete = "DELETE from tests WHERE id = '$del' "; 
	$run = mysqli_query($con, $delete);
	if ($run) { ?>
<div class="alert alert-info" role="alert"><strong>DELETE ! </strong> data deleted</div>
<?php }else{
	echo '<div class="alert alert-danger" role="alert"><strong>ERROR ! </strong> '.$con->error.'</div>';
} }	 
if (isset($_GET['new'])) { ?>
<form method="POST">
	<h3 align="center" style="color: green">ADD NEW TEST FORM</h3>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEST NAME</span>
  <select required class="form-control" name="category_id" aria-describedby="basic-addon1">
<?php
$query = "SELECT * FROM category WHERE status = '1' ";
$run = mysqli_query($con, $query);
if ($run) {
	while ($row = mysqli_fetch_array($run)) {
		echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
	}
}
else{
	echo '<option value="">NO RECORDS FOUNDS</option>';
}
?>
  </select>
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">PATIENT NAME</span>
  <select required class="form-control" name="patient_id" aria-describedby="basic-addon1">
<?php
$query = "SELECT * FROM patients WHERE status = '1' ";
$run = mysqli_query($con, $query);
if ($run) {
	while ($row = mysqli_fetch_array($run)) {
		echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
	}
}
else{
	echo '<option value="">NO RECORDS FOUNDS</option>';
}
?>
  </select>
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon3">&nbsp;&nbsp;&nbsp;&nbsp;TEST PRICE</span>
  <input type="number" required class="form-control" placeholder="TEST PRICE" name="price" aria-describedby="basic-addon3">
  <span class="input-group-btn">
        <button class="btn btn-success" name="save" type="save">SAVA TEST</button>
      </span>
</div></br>
	
</form>
<hr>
<?php } 
if (isset($_GET['upd'])) { 
	$id = $_GET['upd'];
$query = "SELECT * FROM tests WHERE id = '$id' ";
$run = mysqli_query($con, $query);
if (mysqli_num_rows($run) > 0) {
	while ($row = mysqli_fetch_array($run)) {
		$price = $row['price'];
		$test_result = $row['test_result'];
		$category_id = $row['category_id'];
$query1 = "SELECT * FROM category WHERE id = '$category_id' ";
$run1 = mysqli_query($con, $query1);
if (mysqli_num_rows($run1) > 0) {
	while ($row1 = mysqli_fetch_array($run1)) {
		$cat_name = $row1['name'];
	}
}
		$patient_id = $row['patient_id'];
$query2 = "SELECT * FROM patients WHERE id = '$patient_id' ";
$run2 = mysqli_query($con, $query2);
if (mysqli_num_rows($run2) > 0) {
	while ($row2 = mysqli_fetch_array($run2)) {
		$pat_name = $row2['name'];
	}
}		
	} 
}?>
<form method="POST">
	<h3 align="center" style="color: green">MODIFY TEST FORM</h3>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEST NAME</span>
  <input type="text" required readonly value="<?php echo $cat_name; ?>" class="form-control" name="name" aria-describedby="basic-addon1">
<input type="hidden" required value="<?php echo $id; ?>" name="id">
<input type="hidden" required value="<?php echo $pat_name; ?>" name="pat_name">
<input type="hidden" required value="<?php echo $cat_name; ?>" name="cat_name">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon2">PATIENT NAME</span>
  <input type="text" required readonly value="<?php echo $pat_name; ?>" class="form-control" name="pat_name" aria-describedby="basic-addon2">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon2">PATIENT PRICE</span>
  <input type="text" required value="<?php echo $price; ?>" class="form-control" placeholder="TEST PRICE" name="price" aria-describedby="basic-addon3">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon3">TEST RESULT</span>
  <input type="text" required value="<?php echo $test_result; ?>" class="form-control" placeholder="TEST RESULT" name="test_result" aria-describedby="basic-addon3">
  <span class="input-group-btn">
        <button class="btn btn-success" name="update_data" type="submit">SAVA TEST</button>
      </span>
</div></br>
	
</form>
<hr>
<?php } ?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading" style="text-align: center;font-size: 20px;">TEST</div>

  <table class="table">
  	<tr>
  		<th>#</th>
  		<th>TEST ID</th>
  		<th>TEST NAME</th>
  		<th>PATIENT NAME</th>
  		<th>TEST PRICE</th>
  		<th>TEST RESULT</th>
  		<th><a href="?new" class="btn btn-xs btn-info" style="text-align: center;">ADD TEST</a></th>
  	</tr>
<?php
$total_amount = 0;
$query = "SELECT * FROM tests";
$run = mysqli_query($con, $query);
if (mysqli_num_rows($run) > 0) {
	while ($row = mysqli_fetch_array($run)) {
		$total_amount = $total_amount + $row['price'];
		$id = $row['id'];
		$test_result = $row['test_result'];
		$category_id = $row['category_id'];
$query1 = "SELECT * FROM category WHERE id = '$category_id' ";
$run1 = mysqli_query($con, $query1);
if (mysqli_num_rows($run1) > 0) {
	while ($row1 = mysqli_fetch_array($run1)) {
		$cat_name = $row1['name'];
	}
}
		$patient_id = $row['patient_id'];
$query2 = "SELECT * FROM patients WHERE id = '$patient_id' ";
$run2 = mysqli_query($con, $query2);
if (mysqli_num_rows($run2) > 0) {
	while ($row2 = mysqli_fetch_array($run2)) {
		$pat_name = $row2['name'];
	}
}		
	 ?>
	<tr>
		<td><?php echo ++$s_no; ?></td>
		<td><?php echo $row['id']; ?></td>
		<td><?php echo $cat_name; ?></td>
		<td><?php echo $pat_name; ?></td>
		<td><?php echo $row['price']; ?></td>
		<td><?php if($test_result == 'pending'){echo '<span class="btn btn-xs btn-danger">'.$test_result.'</span>';}else{echo '<span class="btn btn-xs btn-success">'.$test_result.'</span>';} ?></td>
		<td>
			<a href="?del=<?php echo $id; ?>"><span class="btn btn-danger btn-xs">delete</span></a>
			<a href="?upd=<?php echo $id; ?>"><span class="btn btn-primary	 btn-xs">modify</span></a>
		<!--	<a target="_blanck" href="print.php?t_id=<?php echo $id; ?>"><span class="btn btn-warning	 btn-xs">print</span></a> -->
		</td>
	</tr>
<?php	}
	echo '<tr><td colspan="4"></td><td style="font-size: 15px;font-weight: bolder;">'.$total_amount.'</td><td></td></tr>';
}
else{
	echo '<tr><td colspan="6">NO TESTS</td></tr>';
}
?>
  </table>
</div>	
</div>

</div>
<?php include 'footer.php'; ?>

  