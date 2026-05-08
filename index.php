<?php

require 'conn.php';

session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Login</title>
  </head>
  <body>


    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4 col-md-4">
                <div class="card bx">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Login as Admin</h4>
                            <p class="card-text small text-muted">Login with you username &amp; password</p>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-sm" name="u_name" placeholder="Username" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control form-control-sm" name="u_pass" placeholder="Password" required>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-block btn-sm btn-success" name="u_login" value="Sign in">
                                    <a href="register.php">Register</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login -->
    <?php

    if( isset( $_POST['u_login'] ) ){
        $u_name = $_POST['u_name'];
        $u_pass = md5($_POST['u_pass']);


       $sql = "SELECT * FROM users WHERE u_name='$u_name'";
       $result = mysqli_query($conn,$sql);


       if(mysqli_num_rows($result) > 0){
           while($user = mysqli_fetch_assoc($result)){
               if($u_name == $user['u_name'] && $u_pass == $user['u_pass']){
                   $_SESSION['u_name'] = $u_name;
                        echo "<script> window.location.href='dash.php'; </script>";
                        exit();
               }else{
                   echo "<script> alert('Wrong Username or Password')</script>";
               }
           }
       }else{
           echo "<script> alert('Username && password do not exist')</script>";
       }
    }

    ?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </body>
</html>