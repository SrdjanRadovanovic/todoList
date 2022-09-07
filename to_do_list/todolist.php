<?php 
session_start();
include 'db.php'; 

$page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
$perPage = (isset($_GET['per-page']) && (int)$_GET['per-page'] <= 50 ? (int)$_GET['per-page'] : 5);
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

$sql = "SELECT * FROM tasks LIMIT ".$start." , ".$perPage." ";
$total = $db->query("SELECT * FROM tasks")->num_rows;
$pages = ceil($total / $perPage); 

$rows = $db->query($sql);

?>

<html>
<head>

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> -->


  <title>Crud App</title>

</head>
<body style="background-image: url('images/andrew-neel-cckf4TsHAuw-unsplash.jpg');">
  <!-- <nav style="background-color:black;">
    <form action="">
      <input type="submit" name="Users" value="Users" class="btn btn-warning">
    </form>
  </nav> -->
  <ul class="nav nav-tabs" style="background-color: black;">
  <li><a href="todolist.php" style="color: aqua;">Home</a></li>
  <li><a href="users.php" style="color: aqua;">Users</a></li>
  <li><a href="logout.php" style="color: aqua;">Logout</a></li>
  <li><p style="color: yellow; margin-top:10px;"><?php echo "Logged in as: " . $_SESSION['username']." <span>(" . $_SESSION['role'] . ")</span>"; ?></p></li>
  </ul>

<div class="container">
  <div class="row">
    <center><h1>To do list</h1>
  
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
            <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" >Delete</a></td>
        </tr>
          <?php endwhile; ?>
      </tbody>
    </table>
      <center>
        <ul class="pagination">
          <?php for($i = 1; $i <= $pages; $i++): ?>
          <li><a href="?page=<?php echo $i; ?>&per-page=<?php echo $perPage; ?>"><?php echo $i; ?></a></li>
          <?php endfor; ?>
        </ul>
        <!-- <form action="index.php">
          <input type="submit" name="Logout" value="Logout" class="btn btn-danger">
        </form> -->
      </center>

    </div>
    </center>
  </div>
</div>
</body>
</html>