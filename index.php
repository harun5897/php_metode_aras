<?php
session_start();
include_once('function/helper.php');
include_once("function/koneksi.php");

//POST
if(isset($_POST['b_login'])) {
    login($koneksi, $_POST['email'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <!--STYLING CSS DAN JQUERY BOOTSTRAP  -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fa/css/all.css">
    <link rel="stylesheet" type="text/css" href="style/custom.css">
    
    <script type="text/javascript" src="jquery/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="pooper/pooper.min.js"></script>

    <script type="text/javascript" src="js/bootstrap.min.js"> </script>
    <script type="text/javascript" src="js/bootstrap.js"> </script>
    <!--TUTUP STYLING CSS DAN JQUERY BOOTSTRAP  -->

    <!-- SWALL -->
    <script src="alert/sweetalert2.all.min.js"></script>
</head>
<body class="body">
    <div class="container font">
        <div class="card mb-3 center shadow-box" style="max-width: 640px;">
            <div class="row no-gutters text-white rounded">
                <div class="col-md-5">
                    <img src="img/logo_smp56.png" class="card-img" alt="..." style="height: 316px; width: 275px">
                </div>
                <div class="col-md">
                    <div class="card-header ml-1 bg-info text-white">
                        Insert Email and your Password !
                    </div>
                    <div class="card-body ml-1 bg-info text-white">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                            </div>
                            <hr>
                            <div>
                            </div>
                            <button type="submit" class="btn btn-success" name="b_login" ><i class="fas fa-sign-in-alt"></i> Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</script>
</html>
