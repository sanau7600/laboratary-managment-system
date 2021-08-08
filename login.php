<?php include 'head.php'; 
if (isset($_SESSION['admin_id'])) {
	header('location: index.php');
}
if (isset($_POST['submit'])) {
	$userName = $_POST['userName'];
	$password = $_POST['password'];
	$query = "SELECT * FROM `admin` WHERE `userName` = '$userName' AND password = '$password' ";
	$run = mysqli_query($con, $query);
	if (mysqli_num_rows($run) == 1) {
    while ($row = mysqli_fetch_array($run)) {
      $id = $row['id'];
      $name = $row['name'];
      $_SESSION['admin_id'] = $id;
      $_SESSION['admin_user'] = $userName;
      $_SESSION['admin_name'] = $name;
      header('location: index.php');
    }
  }
  else{
    $error++;
  }
}
?>
<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
  <title>Document</title>
</head>
<body style="background-color: lightblue;">

<div class="container" style="background-color: transparent;color: white;">

<div class="row">
<div class="panel panel-default" style="margin-top: 20%">
  <div class="panel-heading" style="text-align: center;">LOGIN PAGE
<br>
<?php if ($error > 0) { ?>
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> <strong>Danger!</strong> user name or password not matched.</div>
<?php } ?>
  </div>
  <div class="panel-body">
<form method="POST"> 
  <div class="form-group">
    <label for="userName">USER NAME</label>
    <input type="text" name="userName" class="form-control" id="userName" placeholder="User Name input">
  </div>
  <div class="form-group">
    <label for="password">Another label</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Password input">
  </div>
  <div class="form-group">
    <input type="submit" name="submit" class="form-control" style="background-color: lightblue" id="password" placeholder="Password input">
  </div>
</form>
  </div>
</div>
</div>

</div>
<?php include 'footer.php'; ?>
