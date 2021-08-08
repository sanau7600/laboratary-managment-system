<?php include 'head.php'; 
if (!isset($_SESSION['admin_id'])) {
	header('location: login.php');
}
?>
  <title>LMS - CATEGORIES</title>
</head>
<body style="background-color: darkred;margin-top: 10px">
<div class="container">
<?php include 'navigation.php'; ?>
 
<div class="container">
<?php 
if (isset($_POST['save'])) {
	$name = $_POST['name'];
	$ranges = $_POST['ranges'];
	$detail = $_POST['detail'];
	$insert = "INSERT INTO `category`(`name`, `ranges`, `detail`) VALUES('$name', '$ranges', '$detail')";
	if (mysqli_query($con, $insert)) {
		echo '<div class="alert alert-success" role="alert"><strong>SUCCESS ! </strong> data added</div>';
	}
}
if (isset($_POST['update_data'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$ranges = $_POST['ranges'];
	$detail = $_POST['detail'];
	$update = "UPDATE `category`SET name = '$name', ranges = '$ranges', detail = '$detail' WHERE id = '$id' ";
	if (mysqli_query($con, $update)) {
		echo '<div class="alert alert-success" role="alert"><strong>SUCCESS ! </strong> data updated</div>';
	}
else{
	echo '<div class="alert alert-danger" role="alert"><strong>ERROR ! </strong> '.$con->error.'</div>';
}
}
if (isset($_GET['del'])) {
	$del = $_GET['del'];
	$delete = "DELETE from category WHERE id = '$del' "; 
	$run = mysqli_query($con, $delete);
	if ($run) { ?>
<div class="alert alert-info" role="alert"><strong>DELETE ! </strong> data deleted</div>
<?php }else{
	echo '<div class="alert alert-danger" role="alert"><strong>ERROR ! </strong> '.$con->error.'</div>';
} }	 
if (isset($_GET['new'])) { ?>
<form method="POST">
	<h3 align="center" style="color: green">ADD NEW CATEGORY FORM</h3>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEST NAME</span>
  <input type="text" required class="form-control" placeholder="TEST NAME" name="name" aria-describedby="basic-addon1">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon2">TEST RANGES</span>
  <input type="text" required class="form-control" placeholder="TEST RANGES" name="ranges" aria-describedby="basic-addon2">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon3">TEST DETAILS</span>
  <input type="text" required class="form-control" placeholder="TEST DETAIL" name="detail" aria-describedby="basic-addon3">
  <span class="input-group-btn">
        <button class="btn btn-success" name="save" type="save">SAVA CATEGORY!</button>
      </span>
</div></br>
	
</form>
<hr>
<?php } 
if (isset($_GET['upd'])) { 
	$id = $_GET['upd'];
$query = "SELECT * FROM category WHERE id = '$id' ";
$run = mysqli_query($con, $query);
if (mysqli_num_rows($run) > 0) {
	while ($row = mysqli_fetch_array($run)) {
		$name = $row['name'];
		$ranges = $row['ranges'];
		$detail = $row['detail'];
	} 
}?>
<form method="POST">
	<h3 align="center" style="color: green">MODIFY CATEGORY FORM</h3>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEST NAME</span>
  <input type="text" required value="<?php echo $name; ?>" class="form-control" placeholder="TEST NAME" name="name" aria-describedby="basic-addon1">
<input type="hidden" required value="<?php echo $id; ?>" name="id">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon2">TEST RANGES</span>
  <input type="text" required value="<?php echo $ranges; ?>" class="form-control" placeholder="TEST RANGES" name="ranges" aria-describedby="basic-addon2">
</div></br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon3">TEST DETAILS</span>
  <input type="text" required value="<?php echo $detail; ?>" class="form-control" placeholder="TEST DETAIL" name="detail" aria-describedby="basic-addon3">
  <span class="input-group-btn">
        <button class="btn btn-success" name="update_data" type="submit">SAVA CATEGORY!</button>
      </span>
</div></br>
	
</form>
<hr>
<?php } ?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading" style="text-align: center;font-size: 20px;">CATEGORIES</div>

  <table class="table">
  	<tr>
  		<th>#</th>
  		<th>CATEGORY ID</th>
  		<th>CATEGORY NAME</th>
  		<th>CATEGORY RANGE</th>
  		<th>CATEGORY DETAIL</th>
  		<th><a href="?new" class="btn btn-xs btn-info" style="text-align: center;">ADD CATEGORY</a></th>
  	</tr>
<?php
$query = "SELECT * FROM category ORDER BY name";
$run = mysqli_query($con, $query);
if (mysqli_num_rows($run) > 0) {
	while ($row = mysqli_fetch_array($run)) {
		$id = $row['id'];
	 ?>
	<tr>
		<td><?php echo ++$s_no; ?></td>
		<td><?php echo $row['id']; ?></td>
		<td><?php echo $row['name']; ?></td>
		<td><?php echo $row['ranges']; ?></td>
		<td><?php echo $row['detail']; ?></td>
		<td>
			<a href="?del=<?php echo $id; ?>"><span class="btn btn-danger btn-xs">delete</span></a>
			<a href="?upd=<?php echo $id; ?>"><span class="btn btn-primary	 btn-xs">modify</span></a>
		</td>
	</tr>
<?php	}
}
else{
	echo '<tr><td colspan="6">NO CATEGORIES</td></tr>';
}
?>
  </table>
</div>	
</div>

</div>
<?php include 'footer.php'; ?>

  