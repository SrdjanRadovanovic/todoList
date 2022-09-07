<?php 
session_start();
include 'db.php'; 

?>
<html>
  <head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.2/js/bootstrap.min.js"></script>
    
    <title>Users</title>
    
  </head>
  <body style="background-image: url('images/todo.jpg');">
    <ul class="nav nav-tabs" style="background-color: black;">
      <li><a href="todolist.php" style="color: aqua;">Home</a></li>
      <li><a href="users.php" style="color: aqua;">Users</a></li>
      <li><a href="logout.php" style="color: aqua;">Logout</a></li>
      <li><p style="color: yellow; margin-top:10px;"><?php echo "Logged in as: " . $_SESSION['username']." (" . $_SESSION['role'] . ")"; ?></p></li>
    </ul>
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <center><h1>Users</h1>
          <form action="register.php">
            <input type="submit" name="register" value="New User" class="btn btn-success" style="float: left; margin-bottom: 20px;">
          </form>
          <?php
            $query = "SELECT * FROM register";
            $queryrun = $db->query($query);
            
            if($queryrun) { ?>
              <table class="table table-hover">
                <tr style="background-color: aqua;">
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th></th>
                </tr>
        
                <?php
 
              while($queryfetch = $queryrun->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $queryfetch['firstname']; ?></td>
                <td><?php echo $queryfetch['lastname']; ?></td>
                <td><?php echo $queryfetch['email']; ?></td>
                <td><?php echo $queryfetch['role']; ?></td>
                <td><a href="deleteUser.php?id=<?php echo $queryfetch['id']; ?>" class="btn btn-danger" style="float: right;">Delete</a>
                <a href="editUser.php?id=<?php echo $queryfetch['id']; ?>" class="btn btn-success" style="float: right; margin-right:5px;">Edit</a></td>
              </tr> 
              <?php       
              } ?>
              </table> <?php       
            }
          ?>
          <form action="todolist.php">
            <input type="submit" name="usersBack" value="Back" class="btn btn-info">
          </form>
          </center>
        </div>
      </div>
    </div>
  </body>
</html>