<!DOCTYPE html>
<?php 
session_start();
include 'db.php'; 

$id = (int)$_GET['id'];
$sql = "SELECT * FROM register WHERE id='$id' ";

$rows = $db->query($sql);

$row = $rows->fetch_assoc();

if(isset($_POST['send'])) {

 if($_SESSION['role'] == 'admin') {
  $firstname = htmlspecialchars($_POST['firstname']);
  $lastname = htmlspecialchars($_POST['lastname']);
  $email = htmlspecialchars($_POST['email']);
  $role = htmlspecialchars($_POST['role']);

  $sql = "UPDATE register SET firstname='$firstname',lastname='$lastname',email='$email',role='$role' WHERE id='$id' ";

  $db->query($sql);
  
  header('Location: users.php');
 } else {    
  echo '<script type="text/JavaScript">
        alert ("Only Admin have permission to edit!");
        window.location.href = "users.php";
        </script>';  
 }
}

?>

<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <title>Edit User</title>
</head>
<body style="background-image: url('images/todo.jpg');">

<div class="container">
  <div class="row">
    <center><h1>Edit User</h1>
  
    <div class="col-md-10 col-md-offset-1">
    <hr>
    <!-- <button type="button" class="btn btn-success" style="float: left" data-target="#myModal" data-toggle="modal">Update Task</button>
    <button type="button" class="btn btn-default" style="float: right">Print</button>     -->
      <form method="POST">
        <div class="form-group">
          <label style="float: left">Firstname</label>
          <input type="text" required name="firstname" class="form-control" value="<?php echo $row['firstname']; ?>">
        </div>
        <div class="form-group">
          <label style="float: left">Lastname</label>
          <input type="text" required name="lastname" class="form-control" value="<?php echo $row['lastname']; ?>">
        </div>
        <div class="form-group">
          <label style="float: left">Email</label>
          <input type="text" required name="email" class="form-control" value="<?php echo $row['email']; ?>">
        </div>
        <div class="form-group">
          <label style="float: left">Role</label>
          <input type="text" required name="role" class="form-control" value="<?php echo $row['role']; ?>">
        </div>
        <input type="submit" name="send" value="Add User" class="btn btn-success" style="float: left">
        <a href="users.php" class="btn btn-warning" style="float: right">Back</a>
      </form>
    </div>
    </center>
  </div>
</div>
</body>
</html>