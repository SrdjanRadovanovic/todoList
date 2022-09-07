<?php
session_start();
include 'db.php';

 if(isset($_POST['send'])) {
  if($_SESSION['role'] == 'admin') {

  $name = htmlspecialchars($_POST['task']);

  $sql = "INSERT INTO tasks(name) VALUES('$name')";

  $val = $db->query($sql);

  if($val) {
    header('Location: todolist.php');
  }
  } else {
    echo '<script type="text/JavaScript">
            alert ("Only Admin have permission to add tasks");
            window.location.href = "todolist.php";
          </script>';  
  }
 }



?>