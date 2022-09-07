<!DOCTYPE html>
<?php 
session_start();
include 'db.php'; 

$id = (int)$_GET['id'];
$sql = "SELECT * FROM tasks WHERE id='$id' ";

$rows = $db->query($sql);

$row = $rows->fetch_assoc();

if(isset($_POST['send'])) {

 if($_SESSION['role'] == 'admin') {
  $task = htmlspecialchars($_POST['task']);

  $sql = "UPDATE tasks SET name='$task' WHERE id='$id' ";

  $db->query($sql);
  
  header('Location: todolist.php');
 } else {    
  echo '<script type="text/JavaScript">
        alert ("Only Admin have permission to edit!");
        window.location.href = "todolist.php";
        </script>';  
 }
}

?>

<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <title>Crud App</title>
</head>
<body style="background-image: url('images/andrew-neel-cckf4TsHAuw-unsplash.jpg');">

<div class="container">
  <div class="row">
    <center><h1>Update Todo list</h1>
  
    <div class="col-md-10 col-md-offset-1">
    <hr>
    <!-- <button type="button" class="btn btn-success" style="float: left" data-target="#myModal" data-toggle="modal">Update Task</button>
    <button type="button" class="btn btn-default" style="float: right">Print</button>     -->

      <form method="POST">
        <div class="form-group">
          <label style="float: left">Task Name</label>
          <input type="text" required name="task" class="form-control" value="<?php echo $row['name']; ?>">
        </div>
        <input type="submit" name="send" value="Add Task" class="btn btn-success" style="float: left">
        <a href="todolist.php" class="btn btn-warning" style="float: right">Back</a>
      </form>
    </div>
    </center>
  </div>
</div>
</body>
</html>