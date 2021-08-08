<?php $con = mysqli_connect('localhost', 'root', '', 'lms'); 
session_start();
$error = 0;
$s_no = 0;
//$msg_1 = '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> <strong>Success!</strong> action is complete successfully.</div>'; 

//$msg_2 = '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> <strong>Danger!</strong> Indicates a dangerous or potentially negative action.</div>'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
<style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: red;
   color: white;
   text-align: center;
}
</style>  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
