<?php
session_start();
include_once('function/helper.php');
include_once("function/koneksi.php");
include_once("function/metode_aras.php");

if($_SESSION['login'] !== 'sudah_login') {
    header('location: index.php?login=belum_login');
}

//POST
if(isset($_POST['form_report'])) {
    report($koneksi);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--STYLING CSS DAN JQUERY BOOTSTRAP  -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fa/css/all.css">
    <link rel="stylesheet" type="text/css" href="style/custom.css">
    
    <script type="text/javascript" src="jquery/jquery-3.2.1.slim.min.js"></script>

    <script type="text/javascript" src="js/bootstrap.min.js"> </script>
    <script type="text/javascript" src="js/bootstrap.js"> </script>
    <!--TUTUP STYLING CSS DAN JQUERY BOOTSTRAP  -->

    <!-- SWALL -->
    <script src="alert/sweetalert2.all.min.js"></script>
</head>
<body class='body'>
    <nav class="navbar navbar-light bg-dark">
        <a class="navbar-brand" href="home.php">
            <img src="img/logo_smp56.png" width="100" height="60" alt="" loading="lazy">
        </a>
        <div class="text-white mr-5">
            <div class="m-auto">
                <h2 class="">Sistem Informasi Guru Terbaik</h2>
                <div class='text-center'>
                    <p class="m-auto">SMP N 56 Batam</p>
                </div>
            </div>
        </div>
        <div class="">
        <a href="logout.php"><h1><i class="fas fa-power-off text-info"></i></h1></a>
        </div>
    </nav>
    <div class="container mt-2">
        <div class="card">
            <div class="card-header bg-info text-white">
                <!-- this is card header -->
            </div>
            <div class="card-body">
            <!--  -->
            <div class="row">
                <div class="col-sm-3" style="height: 5mm;">
                    <h5 class="card-title font"> <b>Hasil</b></h5>
                </div>
                <div class="col-sm" style="height: 5mm;">
                    <!-- <a href=""><h2 class="card-title font"> <i class="fas fa-folder-plus text-success"></i></h2></a> -->
                    
                </div>
            </div>
            <hr class="">
            <div class="row">
                <div class="col-sm-3">
                    <?php
                        if($_SESSION['role'] == 'admin') {
                    ?>
                    <a href="data_guru.php">
                        <div class="card bg-info text-white font" style="height: 1.5cm;">
                            <div class="card-body row">
                                <div class="col-sm-1">
                                    <h4> <i class="fas fa-file"></i></h4>
                                </div>
                                <div class="col-sm">
                                    <p>Data Guru</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                        }
                    ?>

                    <?php
                        if($_SESSION['role'] == 'admin') {
                    ?>
                    <a href="data_kriteria.php">
                        <div class="card bg-info text-white font mt-2" style="height: 1.5cm;">
                            <div class="card-body row">
                                <div class="col-sm-1">
                                    <h4> <i class="fas fa-file"></i></h4>
                                </div>
                                <div class="col-sm">
                                    <p>Data Kriteria</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                        }
                    ?>

                    <?php
                        if($_SESSION['role'] == 'admin') {
                    ?>
                    <a href="penilaian.php">
                        <div class="card bg-info text-white font mt-2" style="height: 1.5cm;">
                            <div class="card-body row">
                                <div class="col-sm-1">
                                    <h4> <i class="fas fa-file"></i></h4>
                                </div>
                                <div class="col-sm">
                                    <p>Penilaian</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                        }
                    ?>
                    
                    <a href="perangkingan.php">
                        <div class="card bg-info text-white font mt-2" style="height: 1.5cm;">
                            <div class="card-body row">
                                <div class="col-sm-1">
                                    <h4> <i class="fas fa-file"></i></h4>
                                </div>
                                <div class="col-sm">
                                    <p>Perangkingan</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="history.php">
                            <div class="card bg-info text-white font mt-2" style="height: 1.5cm;">
                                <div class="card-body row">
                                    <div class="col-sm-1">
                                        <h4> <i class="fas fa-file"></i></h4>
                                    </div>
                                    <div class="col-sm">
                                        <p>History</p>
                                    </div>
                                </div>
                            </div>
                    </a>
                    
                </div>
                <div class="col-sm font">
                    <div class="row">
                        <div class="col-sm">
                            <H4>Matriks Keputusan</H4>
                        </div>
                        <div class="col-sm-4 text-right">
                            <form action="" method="post">
                                <button class="btn btn-success" type="submit" name="form_report"><b>Lihat Guru Terbaik</b></button>
                            </form>
                        </div>
                    </div>
                        <!-- Content tabel -->
                        <table class="table table-bordered mt-2 table-hover table-sm">
                        <thead>                         
                            <tr>
                                <th scope="col">Alternatif</th>
                                <?php
                                    $obj = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
                                    $result = mysqli_num_rows($obj);
                                    for($i = 1; $i <= $result; $i++ ) {
                                ?>
                                    <th scope="col">C<?=$i?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody id='myTable'>
                            <?php
                            $obj_a = mysqli_query($koneksi, "SELECT * FROM tb_guru");
                            $result_a = mysqli_num_rows($obj_a);
                            for($a = 0; $a <= $result_a; $a++) {    
                                ?>
                                    <tr>
                                        <td>X<?=$a?></td>
                                        <?php
                                        $obj = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
                                        $result = mysqli_num_rows($obj);
                                        while ($res = mysqli_fetch_array($obj)):
                                            $id = $res['id']
                                            ?>
                                            <td><?=$_SESSION['x'.$id][$a]?></td>
                                            <?php
                                        endwhile;
                                        ?>
                                    </tr>
                                <?php
                            }
                            ?>   
                        </tbody>
                    </table>
                    <br>

                    <table class="table table-bordered mt-2 table-hover table-sm">
                        <H4>Normalisasi Matriks</H4>
                        <thead>                         
                            <tr>
                                <th scope="col">Alternatif</th>
                                <?php
                                    $obj = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
                                    $result = mysqli_num_rows($obj);
                                    for($i = 1; $i <= $result; $i++ ) {
                                ?>
                                    <th scope="col">C<?=$i?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody id='myTable'>
                            <?php
                            $obj_a = mysqli_query($koneksi, "SELECT * FROM tb_guru");
                            $result_a = mysqli_num_rows($obj_a);
                            for($a = 0; $a <= $result_a; $a++) {    
                                ?>
                                    <tr>
                                        <td>X<?=$a?></td>
                                        <?php
                                        $obj = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
                                        $result = mysqli_num_rows($obj);
                                        while ($res = mysqli_fetch_array($obj)):
                                            $id = $res['id']
                                            ?>
                                            <td><?=$_SESSION['a'.$id][$a]?></td>
                                            <?php
                                        endwhile;
                                        ?>
                                    </tr>
                                <?php
                            }
                            ?>   
                        </tbody>
                    </table>
                    <br>

                    
                    <table class="table table-bordered mt-2 table-hover table-sm">
                        <H4>Bobot Matriks</H4>
                        <thead>                         
                            <tr>
                                <th scope="col">Alternatif</th>
                                <?php
                                    $obj = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
                                    $result = mysqli_num_rows($obj);
                                    for($i = 1; $i <= $result; $i++ ) {
                                ?>
                                    <th scope="col">C<?=$i?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody id='myTable'>
                            <?php
                            $obj_a = mysqli_query($koneksi, "SELECT * FROM tb_guru");
                            $result_a = mysqli_num_rows($obj_a);
                            for($a = 0; $a <= $result_a; $a++) {    
                                ?>
                                    <tr>
                                        <td>X<?=$a?></td>
                                        <?php
                                        $obj = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
                                        $result = mysqli_num_rows($obj);
                                        while ($res = mysqli_fetch_array($obj)):
                                            $id = $res['id']
                                            ?>
                                            <td><?=$_SESSION['b'.$id][$a]?></td>
                                            <?php
                                        endwhile;
                                        ?>
                                    </tr>
                                <?php
                            }
                            ?>   
                        </tbody>
                    </table>
                    <br>

                    <table class="table table-bordered mt-2 table-hover table-sm">
                        <H4>Nilai Fungsi Optimalisasi</H4>
                        <thead>                         
                            <tr>
                                <th scope="col">Alternatif</th>
                                <?php
                                    $obj = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
                                    $result = mysqli_num_rows($obj);
                                    for($i = 1; $i <= $result; $i++ ) {
                                ?>
                                    <th scope="col">C<?=$i?></th>
                                <?php } ?>
                                <th scope="col">S</th>
                            </tr>
                        </thead>
                        <tbody id='myTable'>
                            <?php
                            $obj_a = mysqli_query($koneksi, "SELECT * FROM tb_guru");
                            $result_a = mysqli_num_rows($obj_a);
                            for($a = 0; $a <= $result_a; $a++) {    
                                ?>
                                    <tr>
                                        <td>X<?=$a?></td>

                                        <?php
                                        $obj = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
                                        $result = mysqli_num_rows($obj);
                                        while ($res = mysqli_fetch_array($obj)):
                                            $id = $res['id']
                                            ?>
                                            <td><?=$_SESSION['b'.$id][$a]?></td>
                                            <?php
                                        endwhile;
                                        ?>
                                        <td><?=$_SESSION['c'.$a]?></td>
                                    </tr>
                                <?php
                            }
                            ?>   
                        </tbody>
                    </table>
                    <br>

                    <table class="table table-bordered mt-2 table-hover table-sm">
                        <H4>Nilai Ranking</H4>
                        <thead>                         
                            <tr>
                                <th scope="col">Alternatif</th>
                                <th scope="col">S</th>
                                <th scope="col">Hasil</th>
                            </tr>
                        </thead>
                        <tbody id='myTable'>
                            <?php
                            $obj_a = mysqli_query($koneksi, "SELECT * FROM tb_guru");
                            $result_a = mysqli_num_rows($obj_a);
                            for($a = 0; $a <= $result_a; $a++) {    
                                ?>
                                    <tr>
                                        <td>X<?=$a?></td>
                                        <td><?=$_SESSION['c'.$a]?></td>
                                        <td><?=$_SESSION['d'.$a]?></td>
                                    </tr>
                                <?php
                            }
                            ?>   
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
            <!--  -->
            </div>
        </div>
    </div>
</body>


<script>
$(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
</html>