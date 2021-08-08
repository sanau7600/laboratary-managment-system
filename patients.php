<?php include 'head.php'; 
if (!isset($_SESSION['admin_id'])) {
	header('location: login.php');
}
?>
  <title>LMS - PATIENTS</title>
</head>
<body style="background-color: darkred;margin-top: 10px">
<div class="container">
<?php include 'navigation.php'; ?>
 
<div class="container">
<?php 
if (isset($_POST['save'])) {
	$name = $_POST['name'];
	$cnic = $_POST['cnic'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$insert = "INSERT INTO `patients`(`name`, `cnic`, `address`, `phone`) VALUES('$name', '$cnic', '$address', '$phone')";
	if (mysqli_query($con, $insert)) {
		echo '<div class="alert alert-success" role="alert"><strong>SUCCESS ! </strong> data added</div>';
	}
}
if (isset($_POST['update_data'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$cnic = $_POST['cnic'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];	
	$update = "UPDATE `patients`SET name = '$name', cnic = '$cnic', address = '$address', phone = '$phone' WHERE id = '$id' ";
	if (mysqli_query($con, $update)) {
		echo '<div class="alert alert-success" role="alert"><strong>SUCCESS ! </strong> data updated</div>';
	}
else{
	echo '<div class="alert alert-danger" role="alert"><strong>ERROR ! </strong> '.$con->error.'</div>';
}
}
if (isset($_GET['del'])) {
	$del = $_GET['del'];
	$delete = "DELETE from patients WHERE id = '$del' "; 
	$run = mysqli_query($con, $delete);
	if ($run) { ?>
<div class="alert alert-info" role="alert"><strong>DELETE ! </strong> data deleted</div>
<?php }else{
	echo '<div class="alert alert-danger" role="alert"><strong>ERROR ! </strong> '.$con->error.'</div>';
} }	 
if (isset($_GET['new'])) { ?>
<form method="POST">
	<h3 align="center" style="color: green">ADD NEW PATIENT FORM</h3>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PATIENT NAME</span>
  <input type="text" required class="form-control" placeholder="PATIENT NAME" name="name" aria-describedby="basic-addon1">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon2">PATIENT CNIC</span>
  <input type="text" required class="form-control" placeholder="PAITENT CNIC" maxlength="13" pattern="[0-9]{13}" name="cnic" aria-describedby="basic-addon2">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon2">PATIENT PHONE</span>
  <input type="text" required class="form-control" placeholder="PAITENT PHONE" maxlength="10" pattern="[0-9]{10}" name="phone" aria-describedby="basic-addon2">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon3">ADDRESS</span>
  <input type="text" required class="form-control" placeholder="PATIENT ADDRESS" name="address" aria-describedby="basic-addon3">
  <span class="input-group-btn">
        <button class="btn btn-success" name="save" type="save">SAVA PATIENT</button>
      </span>
</div></br>
	
</form>
<hr>
<?php } 
if (isset($_GET['upd'])) { 
	$id = $_GET['upd'];
$query = "SELECT * FROM patients WHERE id = '$id' ";
$run = mysqli_query($con, $query);
if (mysqli_num_rows($run) > 0) {
	while ($row = mysqli_fetch_array($run)) {
	$name = $row['name'];
	$cnic = $row['cnic'];
	$address = $row['address'];
	$phone = $row['phone'];
	} 
}?>
<form method="POST">
	<h3 align="center" style="color: green">MODIFY PATIENT FORM</h3>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PATIENT NAME</span>
  <input type="text" required value="<?php echo $name; ?>" class="form-control" placeholder="TEST NAME" name="name" aria-describedby="basic-addon1">
<input type="hidden" required value="<?php echo $id; ?>" name="id">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon2">PATIENT ADDRESS</span>
  <input type="text" required value="<?php echo $address; ?>" class="form-control" placeholder="PATIENT ADDRESS" name="address" aria-describedby="basic-addon2">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon2">PATIENT PHONE</span>
  <input type="text" required value="<?php echo $phone; ?>" class="form-control" placeholder="PATIENT PHONE" name="phone" aria-describedby="basic-addon2">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon3">PATIENT CNIC</span>
  <input type="text" required value="<?php echo $cnic; ?>" class="form-control" placeholder="PATIENT CNIC" name="cnic" aria-describedby="basic-addon3">
  <span class="input-group-btn">
        <button class="btn btn-success" name="update_data" type="submit">SAVA PATIENT</button>
      </span>
</div></br>
	
</form>
<hr>
<?php } ?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading" style="text-align: center;font-size: 20px;">PATIENTS</div>

  <table class="table">
  	<tr>
  		<th>#</th>
  		<th>PATIENT ID</th>
  		<th>PATIENT NAME</th>
  		<th>PATIENT ADDRESS</th>
  		<th>PATIENT PHONE</th>
  		<th>PATIENT CNIC</th>
  		<th><a href="?new" class="btn btn-xs btn-info" style="text-align: center;">ADD PATIENT</a></th>
  	</tr>
<?php
$query = "SELECT * FROM patients ORDER BY name";
$run = mysqli_query($con, $query);
if (mysqli_num_rows($run) > 0) {
	while ($row = mysqli_fetch_array($run)) {
		$id = $row['id'];
	 ?>
	<tr>
		<td><?php echo ++$s_no; ?></td>
		<td><?php echo $row['id']; ?></td>
		<td>0<?php echo $row['name']; ?></td>
		<td><?php echo $row['address']; ?></td>
		<td><?php echo $row['phone']; ?></td>
		<td><?php echo $row['cnic']; ?></td>
		<td>
			<a href="?del=<?php echo $id; ?>"><span class="btn btn-danger btn-xs">delete</span></a>
			<a href="?upd=<?php echo $id; ?>"><span class="btn btn-primary	 btn-xs">modify</span></a>
		</td>
	</tr>
<?php	}
}
else{
	echo '<tr><td colspan="7">NO PATIENTS</td></tr>';
}
?>
  </table>
</div>	
</div>

</div>
<?php include 'footer.php'; ?>

  