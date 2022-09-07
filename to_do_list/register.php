<?php 
session_start();
include 'db.php'; 

if(isset($_POST['register'])) {
  $firstname = htmlspecialchars($_POST['firstname']);
  $lastname = htmlspecialchars($_POST['lastname']);
  $username = htmlspecialchars($_POST['username']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $role = htmlspecialchars($_POST['role']);


  if(strlen($password) > 8) {
    $query = "INSERT INTO register (firstname, lastname, username, email, password, role) VALUES ('$firstname', '$lastname', '$username', '$email', '$password', '$role')";

    if ($db->query($query) == TRUE) {
      header('Location: index.php');   
    } else {
      echo $query . "<br>" . $db->error;
    }
  } else {
    echo "Password is too weak!";
  }  
}
// echo basename(parse_url($_SERVER['HTTP_REFERER'],PHP_URL_PATH));
?>

<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <title>Crud App register</title>
</head>
<body style="background-image: url('images/xVobq7.jpeg');">
<center><h1>REGISTER</h1>
<form class="form-group" action="register.php" method="POST">
  <input class="form-control" type="text" name="firstname" pattern="[A-Za-z]*" placeholder="Firstname" required style="width: 50%;"><br>
  <input class="form-control" type="text" name="lastname" pattern="[A-Za-z]*" placeholder="Lastname" required style="width: 50%;"><br>
  <input class="form-control" type="text" name="username" placeholder="Username" required style="width: 50%;"><br>
  <input class="form-control" type="email" name="email" placeholder="E-mail" required style="width: 50%;"><br>
  <input class="form-control" type="password" name="password" placeholder="Password" required style="width: 50%;"><br>
  <select class="form-control" style="width: 50%;" name="role">
    <option value="admin">Admin</option>
    <option value="subscriber">Subscriber</option>
  </select><br><br>
  <input type="submit" name="register" value="Register!" class="btn btn-primary">
</form>
<form action="<?php echo $_SERVER["HTTP_REFERER"]; ?>">
  <input type="submit" name="back" value="Back" class="btn btn-danger">
</form>
</center>


</body>
</html>