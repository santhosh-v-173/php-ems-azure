<?php

require 'conn.php';
session_start();



if(!isset($_SESSION['u_name'])){
    echo "<script> window.location.href='index.php'; </script>";
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src=" https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- nav -->
    <?php require 'nav.php'; ?>
    <!-- nav -->

    <!-- main content -->

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="add_new_employee.php">Add New Employee</a></li>
                        <li class="list-group-item"><a href="dash.php">View all Employees</a></li>
                        <li class="list-group-item"><a href="add_job.php">Add New Job</a></li>
                        <li class="list-group-item"><a href="job_list.php">View all Jobs</a></li>


                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">


                <?php
                          $sql = "SELECT * FROM employees";
                          $result = mysqli_query($conn,$sql);
                          ?>
                <?php
                      if(isset($_GET['search'])){
                        $searchKey = $_GET['search'];
                        $sql = "SELECT * FROM employees WHERE e_name LIKE '%$searchKey%' or e_id LIKE '%$searchKey%'";
                     }else
                     $sql = "SELECT * FROM employees";
                     $result = $conn->query($sql);

                        ?>
                <div  style="float:right;">
                <form action="" method="get">
                <input type="search"  name="search" >
                <button type="submit" class="glyphicon glyphicon-search btn btn-success"></button>
                </form>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Employees List</div>
                    <table id="employee_data" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <?php

                          if(mysqli_num_rows($result) > 0 ){
                            while($employee = mysqli_fetch_assoc($result)){?>
                            <tbody>
                            <tr>

                            <td><?php echo $employee['e_id']; ?></td>
                            <td><?php echo $employee['e_name']; ?></td>
                            <td><a href="details_employee.php?e_id=<?php echo $employee['e_id']; ?>" class="btn btn-sm  btn btn-info">Details</a></td>
                            <td><a href="edit_employee.php?e_id=<?php echo $employee['e_id']; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                            <td><a href="delete_employee.php?e_id=<?php echo $employee['e_id']; ?>" class="btn btn-sm btn-danger">Delete</a></td>
                            </tr>

                            </tbody>

                           <?php }
                           }else{
                             echo "<script> alert('No Record Found...')</script>";

                           }


                        ?>


                        </table>
                        <a href="dash.php" class="btn btn-primary" > <span style="text-align:right;"> back</span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- main content -->

  </body>
</html>
<script>
 $(document).ready(function(){
      $('#employee_data').DataTable();
 });
 </script>