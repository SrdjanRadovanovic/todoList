<?php 
session_start();
include 'db.php'; 

if(isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM register WHERE email='".$email."' AND password='".$password."' limit 1";
  $queryrun = $db->query($query);
  if ($queryrun->num_rows == 1) {
    $query = "SELECT * FROM register WHERE email = '$email' ";
    $queryrun = $db->query($query);
    $queryfetch = $queryrun->fetch_array();
  
    $_SESSION['firstname'] = $queryfetch['firstname'];
    $_SESSION['lastname'] = $queryfetch['lastname'];
    $_SESSION['role'] = $queryfetch['role'];
    $_SESSION['username'] = $queryfetch['username'];

    header('Location: todolist.php');
  } else {
    header('Location: index.php');
  }

  // $result = mysqli_query($db, $query);
  // if(mysqli_num_rows($result) == 1) {
  //   $_SESSION['email'] = $email;
  //   header('Location: todolist.php');
  // } else {
  //   header('Location: index.php');
  // }

}

?>

<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <title>Crud App</title>
</head>
<body style="background-image: url('images/wp7881177-checklist-wallpapers.jpg');">

<center><h1><strong>LOGIN</strong></h1>
<form class="form-group" action="" method="POST">
  <input class="form-control" type="email" name="email" placeholder="E-mail" required style="width: 50%;"><br>
  <input class="form-control" type="password" name="password" placeholder="Password" required style="width: 50%;"><br>
  <input type="submit" name="submit" value="Login" class="btn btn-success">
</form>
<p><strong>If you dont have an account,please register first.</strong></p>
<form action="register.php">
    <input type="submit" name="register" value="Register" class="btn btn-primary">
</form>
</center>


</body>
</html>