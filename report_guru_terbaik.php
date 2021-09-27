<?php
session_start();
include_once('function/helper.php');
include_once("function/koneksi.php");

if($_SESSION['login'] !== 'sudah_login') {
    header('location: index.php?login=belum_login');
}

$nilai = $_SESSION['nilai'];
$id_guru = $_SESSION['id_guru'];
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
                        <h5 class="card-title font"> <b>Guru Terbaik</b></h5>
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
                                <a href="cetak.php" class="btn btn-success">Cetak PDF</a>
                            </div>
                            <div class="col-sm-4 text-right">
                                <input class="form-control" placeholder="Search" aria-label="Search" id="myInput">
                            </div>
                        </div>
                    <table class="table table-bordered mt-2 table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Bidang</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Nilai</th>
                                
                            </tr>
                        </thead>
                        <tbody id=myTable>
                            <?php
                            $no = 0;
                                for ($i = 0; $i < count($nilai); $i++) {
                                    $no++;
                                    $id = $id_guru[$i];
                                    $obj = mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE id = '$id' ");
                                    $arr = mysqli_fetch_array($obj);

                            ?>
                            <tr>
                                <th scope="row"><?=$no?></th>
                                <td><?=$arr['nama_guru']?> </td>
                                <td><?=$arr['bidang']?> </td>
                                <td><?=$arr['jabatan']?> </td>
                                <td><?=$nilai[$i]?> </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>

                    </div>
                </div>
                <!--  -->
                </div>
            </div>
        </div>
    </body>
</html>