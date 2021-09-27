<?php
session_start();
include_once('function/helper.php');
include_once("function/koneksi.php");

if($_SESSION['login'] !== 'sudah_login') {
    header('location: index.php?login=belum_login');
}

//POST
if(isset($_POST['b_filter'])) {
    filter($koneksi, $_POST['date_awal'], $_POST['date_akhir']);
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
                        <h5 class="card-title font"> <b>History</b></h5>
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
                    <!-- content -->
                            <div class="row">
                                    <div class="col-sm">
                                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#exampleModal1">By Periode</a>
                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <input class="form-control" placeholder="Search" aria-label="Search" id="myInput">
                                    </div>
                                </div>
                            
                                <div class="id" style="overflow-y:auto; height: 9cm">
                                    <table class="table table-bordered mt-2 table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Bidang</th>
                                                <th scope="col">Nilai</th>
                                                <th scope="col">Periode</th>
                                                <th scope="col">Peringkat</th>
                                                <th scope="col">Date</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id=myTable>
                                            <?php

                                            if(isset($_GET['filter'])) {
                                                $date_awal = $_SESSION['date_awal'];
                                                $date_akhir = $_SESSION['date_akhir'];
                                                $obj = mysqli_query($koneksi, "SELECT * FROM tb_history WHERE date BETWEEN '$date_awal' AND '$date_akhir'");
                                            } else {
                                                $obj = mysqli_query($koneksi, "SELECT * FROM tb_history");
                                            }
                                            $no = 0;    
                                                while ($arr = mysqli_fetch_array($obj)) :
                                                    $no++;
                                                    $id = $arr['id_guru'];
                                                    $obj_1 = mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE id = '$id' ");
                                                    $arr_1 = mysqli_fetch_array($obj_1);

                                            ?>
                                            <tr>
                                                <th scope="row"><?=$no?></th>
                                                <td><?=$arr_1['nama_guru']?> </td>
                                                <td><?=$arr_1['bidang']?> </td>
                                                <td><?=$arr['nilai']?> </td>
                                                <td><?=$arr['id_session']?> </td>
                                                <td><?=$arr['peringkat']?> </td>
                                                <td><?=$arr['date']?> </td>
                                            </tr>
                                            <?php
                                            endwhile;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        <hr>
                    </div>
                </div>
                <!--  -->
                </div>
            </div>
        </div>
    </body>
    <!-- Modal Input FILTER -->
    <div class="modal fade bd-example-modal-sm" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-search"></i> Filter </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" class="was-validated">
                        <div class="form-group">
                            <label for="">Dari :</label>
                            <input type="date" class="form-control" name="date_awal" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Sampai :</label>
                            <input type="date" class="form-control" name="date_akhir" required="">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="b_filter" class="btn bg-info text-white"> <i class="fa fa-search"></i> OK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Input FILTER -->
</html>