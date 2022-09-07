<!DOCTYPE html>
<?php 
include 'db.php'; 

if(isset($_POST['search'])) {
  
  $name = htmlspecialchars($_POST['search']);
  $sql = "SELECT * FROM tasks WHERE name like '%$name%' ";

  $rows = $db->query($sql);

}


?>

<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <title>Crud App</title>
</head>
<body>

<div class="container">
  <div class="row">
    <center><h1>Todo list</h1>
  
    <div class="col-md-10 col-md-offset-1">
    <hr>
    <button type="button" class="btn btn-success" style="float: left" data-target="#myModal" data-toggle="modal">Add Task</button>
    <button type="button" class="btn btn-default" style="float: right" onclick="print()">Print</button>
    
    <div class="col-md-12 text-center">
      <!-- <p>Search</p> -->
      <form class="form-group" action="search.php" method="POST" style="margin-top: 20px;">
        <input type="text" class="form-control" placeholder="Search" name="search">
      </form>
    </div>
    
  <?php if(mysqli_num_rows($rows) < 1): ?>
    <h2 class="text-danger text-center">Nothing Found!</h2>
    <a href="index.php" class="btn btn-warning" style="float: left;">Back</a>
  <?php else: ?>

    <table class="table table-hover">
    <!-- Trigger the modal with a button -->
    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="float: left">Add Task</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="add.php">
              <div class="form-group">
                <label style="float: left">Task Name</label>
                <input type="text" required name="task" class="form-control">
              </div>
              <input type="submit" name="send" value="Add Task" class="btn btn-success" style="float: left">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
     </div>
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Task</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php while($row = $rows->fetch_assoc()): ?>

          
            <th><?php echo $row['id']; ?></th>
            <td class="col-md-10"><?php echo $row['name']; ?></td>
            <td><a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a></td>
            <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
          <?php endwhile; ?>
      </tbody>
      </table>
      <a href="todolist.php" class="btn btn-warning" style="float: left;">Back</a>
     <?php endif; ?> 
    



    </div>
    </center>
  </div>
</div>
</body>
</html>