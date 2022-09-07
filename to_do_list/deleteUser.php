<?php
session_start();
include 'db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  // get id value
  $id = (int)$_GET['id'];

  // delete the entry if admin
  if($_SESSION['role'] == 'admin') {
    $sql = "DELETE FROM register WHERE id = '$id' ";
    $db->query($sql);
    
    $val = $db->query($sql);
    if($val){
      header('Location: users.php');
    }
  } else {
    echo '<script type="text/JavaScript">
            alert ("Only Admin have permission to delete!");
            window.location.href = "users.php";
          </script>';  
  }
}

?>