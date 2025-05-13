<?php
include('config.php');
session_start();
if(isset($_SESSION['user'])){
?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo TITLE;?></title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/custom.css">
    <style>
    #head{
      font-family:cursive;
      font-size:20px;
      font-weight:bold;
      text-shadow:2px 2px red;
    }
    #header{
        font-family:cursive;
        font-size:30px;
        font-weight:bold;
        text-shadow:2px 2px red;
    }
    .navbar{
      background-color:black;
      color:white;
    }
    </style>
  </head>
    <body>
      <div class="row">
      <nav class="navbar container-fluid">
      <div class="navbar-brand"id="header"><a href="dashboard.php" style="color:white;text-decoration:none;">Melly's Salon management System</a>
      </div>
      <p style="padding-left:500px;padding-top:15px;"id="head">Welcome  <?php echo $_SESSION['user'];?> </p>
      <a href="logout.php" style="float:right;text-decoration:none;">&nbsp;&nbsp;&nbsp;Sign Out</a>
      </div>
      </nav>
      </div>
      <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2" style="margin-left:0px;">
        <?php include('sidebar.php'); ?>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10">
          <div class="container-fluid" style="text-align:center;margin-bottom:10px">
            <a href="add.php" class="btn btn-warning">Add New Employee</a>
            <a href="cells.php" class="btn btn-warning">Edit Employee</a>
            <a href="court.php" class="btn btn-warning">Sack Employee</a>
            <a href="cases.php" class="btn btn-warning">Delete Employee</a>
          </div>
          <span id="header">Employees Details</span>
        </div>
    </div>
    </body>
  </html>
<?php } else{
  header("Location: ../Admin");
}?>
