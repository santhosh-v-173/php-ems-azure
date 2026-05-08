<?php

require 'conn.php';
session_start();


if( !$_SESSION['u_name'] ){
    header( 'Location: index.php' );
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Esit Job | EMS</title>
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
                    <div class="panel-heading">Job</div>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="add_job.php">Add New Job</a></li>
                        <li class="list-group-item"><a href="job_list.php">View all Job</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Job</div>
                    <form action="" method="POST">
                        <?php
                          $id=$_GET['j_id'];
                          $sql = "SELECT * FROM jobs WHERE j_id =('$id')";
                          $result = mysqli_query($conn,$sql);

                          if(mysqli_num_rows($result) > 0 ){
                            while($employee = mysqli_fetch_assoc($result)){?>
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="a_job" value = "<?php echo $employee['a_job'];?>" required>
                            </div>
                            <div class="form-group">
                                <input type="tsxt" class="form-control input-sm" name="a_position" value = "<?php echo $employee['a_position'];?>" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control input-sm" name="a_discription" value = "<?php echo $employee['a_discription'];?>" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-success" value="Update Job" name="e_update">
                            </div>

                           <?php }
                           }else{
                            echo " 0 reult";
                           }


                        ?>
                        </form>
                </div>
            </div>
        </div>
    </div>

            <?php
                if(isset($_POST['e_update'])){
                    $a_job = $_POST['a_job'];
                    $a_position = $_POST['a_position'];
                    $a_discription = $_POST['a_discription'];

                    $sql = "UPDATE jobs SET a_job ='$a_job',a_position ='$a_position',a_discription='$a_discription' WHERE j_id='$id'";

                    if(mysqli_query($conn,$sql)){
                        echo "<script> window.location.href='job_list.php'; </script>";
                        exit();
                    }else{
                        echo "ERROR: ". $sql.mysqli_error($conn);
                    }
                }

            ?>

    <!-- main content -->

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </body>
</html>