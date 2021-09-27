<?php
session_start();
include_once('function/helper.php');
include_once("function/koneksi.php");

if($_SESSION['login'] !== 'sudah_login') {
    header('location: index.php?login=belum_login');
}

if($_SESSION['role'] !== 'admin') {
    header('location: index.php?login=akses_ditolak');
}

//POST
if(isset($_POST['b_simpan'])) {
    simpan_kriteria($koneksi, $_POST['nama_kriteria'], $_POST['bobot'], $_POST['jenis'], $_POST['nilai_min'], $_POST['nilai_max']);
}
if(isset($_POST['b_edit'])) {
    edit_kriteria($koneksi, $_POST['nama_kriteria'], $_POST['bobot'], $_POST['jenis'], $_POST['nilai_min'], $_POST['nilai_max'], $_GET['id']);
}

//GET
if(isset($_GET['hal'])) {
    if($_GET['hal'] == 'hapus'){
        hapus_kriteria($koneksi, $_GET['id']);
    }
    if($_GET['hal'] == 'edit'){
        $_SESSION['edit'] =  $_GET['id'];
        $id = $_SESSION['edit'];
        $obj_edit = mysqli_query($koneksi, "SELECT * FROM tb_kriteria WHERE id = '$id' ");
        $arr_edit = mysqli_fetch_array($obj_edit);
        ?>
        <script> var edit = 1;</script>
        <?php
    }
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

<?php
if(isset($_GET['alert']) == 'nilai_bobot_max') {

?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> Nilai Bobot Melebihi 100 %.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php
}

?>
    <div class="container mt-2">
        <div class="card">
            <div class="card-header bg-info text-white">
                <!-- this is card header -->
            </div>
            <div class="card-body">
            <!--  -->
            <div class="row">
                <div class="col-sm-3" style="height: 5mm;">
                    <h5 class="card-title font"> <b>Data Kriteria</b></h5>
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
                        <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal1">Tambah Data</button>
                    </div>
                    <div class="col-sm-4 text-right">
                        <input class="form-control" placeholder="Search" aria-label="Search" id="myInput">
                    </div>
                </div>
                <table class="table table-bordered mt-2 table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Kriteria</th>
                            <th scope="col">Bobot</th>
                            <th scope="col">Jenis</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id=myTable>
                        <?php
                        $no = 0;
                        $obj = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
                        while($arr = mysqli_fetch_array($obj)) :
                            $no++;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $no;?></th>
                            <td><?=$arr['nama_kriteria']?></td>
                            <td><?=$arr['bobot']?> %</td>
                            <td><?=$arr['jenis']?></td>
                            <td class="text-center">
                                <a href="data_kriteria.php?hal=edit&id=<?=$arr['id']?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="data_kriteria.php?hal=hapus&id=<?=$arr['id']?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php
                        endwhile;
                        ?>
                    </tbody>
                </table>
                    <hr>
                </div>
            </div>
            <!--  -->
            </div>
        </div>
    </div>
</body>

<!-- Modal Input Data Kriteria -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-user-plus"></i> Tambah Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" class="was-validated">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Nama Kriteria</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama_kriteria" required="">
                                <div class="invalid-feedback">
                                    Please input nama kriteria
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Bobot</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="bobot" required="">
                                <div class="invalid-feedback">
                                    Please input bobot
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Jenis</label>
                            <div class="col-sm-8">
                                <select class="custom-select" name="jenis" required="">
                                    <option value="">Pilih</option>
                                    <option value="benefit">Benefit</option>
                                    <option value="cost">Cost</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please input your option
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Nilai Minimum</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="nilai_min" required="">
                                <div class="invalid-feedback">
                                    Please input nilai minimum
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Nilai Maximum</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="nilai_max" required="">
                                <div class="invalid-feedback">
                                    Please input nilai maximum
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="b_simpan" class="btn bg-info text-white"> <i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Input Kriteria -->


<!-- Modal Edit Data Kriteria -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit"></i> Edit Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" class="was-validated">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Nama Kriteria</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama_kriteria" value='<?=@$arr_edit['nama_kriteria']?>' required="">
                                <div class="invalid-feedback">
                                    Please input Kriteria
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Bobot</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="bobot"  value='<?=@$arr_edit['bobot']?>' required="">
                                <div class="invalid-feedback">
                                    Please input bobot
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Jenis</label>
                            <div class="col-sm-8">
                                <select class="custom-select" name="jenis" required="">
                                    <option value="<?=@$arr_edit['jenis']?>"><?=@$arr_edit['jenis']?></option>
                                    <option value="benefit">Benefit</option>
                                    <option value="cost">Cost</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please choose your option
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Nilai Minimum</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="nilai_min"  value='<?=@$arr_edit['nilai_min']?>' required="">
                                <div class="invalid-feedback">
                                    Please input nilai minimum
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Nilai Maximum</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="nilai_max"  value='<?=@$arr_edit['nilai_max']?>' required="">
                                <div class="invalid-feedback">
                                    Please input nilai maximum
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="b_edit" class="btn bg-warning text-white"> <i class="fas fa-edit"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Edit Kriteria -->

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

<script>
if (edit) {
    $(document).ready(function(){
        $('#exampleModal2').modal();
    });
}
</script>
</html>