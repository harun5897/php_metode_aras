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
    simpan_guru($koneksi, $_POST['nip'], $_POST['nama'], $_POST['bidang'], $_POST['jabatan']);
}

if(isset($_POST['b_edit'])) {
    edit_guru($koneksi, $_POST['nip'], $_POST['nama'], $_POST['bidang'], $_POST['jabatan'], $_GET['id']);
}


//GET
if(isset($_GET['hal'])) {
    if($_GET['hal'] == 'hapus'){
        hapus_guru($koneksi, $_GET['id']);
    }

    if($_GET['hal'] == 'edit'){
        $_SESSION['edit'] =  $_GET['id'];
        $id = $_SESSION['edit'];
        $obj_edit = mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE id = '$id' ");
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
    <div class="container mt-2">
        <div class="card">
            <div class="card-header bg-info text-white">
                <!-- this is card header -->
            </div>
            <div class="card-body">
            <!--  -->
            <div class="row">
                <div class="col-sm-3" style="height: 5mm;">
                    <h5 class="card-title font"> <b>Data Guru</b></h5>
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
                            <th scope="col">Nip</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Bidang</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id=myTable>
                        <?php
                        $no = 0;
                        $obj = mysqli_query($koneksi, "SELECT * FROM tb_guru");
                        while($arr = mysqli_fetch_array($obj)) :
                            $no++;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $no; ?></th>
                            <td><?=$arr['nip']?></td>
                            <td><?=$arr['nama_guru']?></td>
                            <td><?=$arr['bidang']?></td>
                            <td><?=$arr['jabatan']?></td>
                            <td class="text-center">
                                <a href="data_guru.php?hal=edit&id=<?=$arr['id']?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="data_guru.php?hal=hapus&id=<?=$arr['id']?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal Input Guru -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-user-plus"></i> Tambah Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" class="was-validated">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Nip</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="nip" required="">
                                <div class="invalid-feedback">
                                    Please input nip
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" required="">
                                <div class="invalid-feedback">
                                    Please input nama
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Bidang</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="bidang" required="">
                                <div class="invalid-feedback">
                                    Please input bidang
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="jabatan" required="">
                                    <option value="">Pilih Jabatan</option>
                                    <option value="wali_kelas">Wali Kelas</option>
                                    <option value="kepala_sekolah">Kepala Sekolah</option>
                                    <option value="guru_kelas">Guru Kelas</option>
                                </select>
                                <div class="invalid-feedback">Please Chose Your Option</div>
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
<!-- Modal Input Guru -->


<!-- Modal Edit Guru -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit"></i> Edit Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" class="was-validated">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Nip</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="nip" value='<?php echo $arr_edit['nip']?>' required="">
                                <div class="invalid-feedback">
                                    Please input nip
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value='<?php echo $arr_edit['nama_guru']?>' required=""> 
                                <div class="invalid-feedback">
                                    Please input nama guru
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Bidang</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="bidang" value='<?php echo $arr_edit['bidang']?>' required="">
                                <div class="invalid-feedback">
                                    Please input bidang
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="jabatan" required="">
                                    <option value="<?=@$arr_edit['jabatan']?>"><?=@$arr_edit['jabatan']?></option>
                                    <option value="wali_kelas">Wali Kelas</option>
                                    <option value="kepala_sekolah">Kepala Sekolah</option>
                                    <option value="guru_kelas">Guru Kelas</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please choose your option
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
<!-- Modal Edit Guru -->

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