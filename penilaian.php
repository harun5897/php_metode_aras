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
    simpan_nilai($koneksi, $_POST['nama_guru'], $_POST['nama_kriteria'], $_POST['nilai']);
}

//GET
if(isset($_GET['hal'])) {
    if($_GET['hal'] == 'hapus'){
        hapus_nilai($koneksi, $_GET['id']);
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
if(isset($_GET['alert']) == 'data_sudah_ada') {

?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> Data yang anda masukan sudah ada.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php
}
?>

<?php
if(isset($_GET['alert1']) == 'nilai_tidak_sesuai') {

?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> Nilai Yang Anda Masukan Tidak Sesuai Keterangan.
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
                    <h5 class="card-title font"> <b>Penilaian</b></h5>
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
                <div id='table'  style="overflow-y:auto; height: 9cm">
                    <table class="table table-bordered mt-2 table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Guru</th>
                                <th scope="col">Nama Kriteria</th>
                                <th scope="col">Nilai</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id='myTable'>
                            <?php
                            $no = 0;
                            $obj_nilai = mysqli_query($koneksi, "SELECT * FROM tb_penilaian");
                            while($arr_nilai = mysqli_fetch_array($obj_nilai)) :
                                $no++;
                                    $id_guru = $arr_nilai['id_guru'];
                                    $id_kriteria = $arr_nilai['id_kriteria'];
                                    $obj_a = mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE id = '$id_guru' ");
                                    $arr_a = mysqli_fetch_array($obj_a);
                                    $obj_b = mysqli_query($koneksi, "SELECT * FROM tb_kriteria WHERE id = '$id_kriteria' ");
                                    $arr_b = mysqli_fetch_array($obj_b);
                            ?>
                            <tr>
                                <th scope="row"><?php echo $no;?></th>
                                <td><?=$arr_a['nama_guru']?></td>
                                <td><?=$arr_b['nama_kriteria']?></td>
                                <td><?=$arr_nilai['nilai']?></td>
                                <td class="text-center">
                                    <!-- <a href=" " class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a> -->
                                    <a href="penilaian.php?hal=hapus&id=<?=$arr_nilai['id']?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-user-plus"></i> Masukan Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" class="was-validated">
                        <div class="form-group row">
                            <label for="" class="col">Nama Guru</label>
                            <div class="col-8 ">
                                <select class="custom-select" name="nama_guru" required="">
                                    <option value="">-- Pilih Guru --</option>
                                    <?php
                                    $obj_guru = mysqli_query($koneksi, "SELECT * FROM tb_guru");
                                    while($arr_guru = mysqli_fetch_array($obj_guru)) :
                                    ?>
                                    <option value="<?=$arr_guru['id']?>"><?=$arr_guru['nama_guru']?></option>
                                    <?php
                                        endwhile;
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Please choose nama guru
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md">Nama Kriteria</label>
                            <div class="col-8">
                                <select class="custom-select" name="nama_kriteria" id='kriteria' required="">
                                    <option value="">-- Pilih Kriteria --</option>
                                    <?php
                                    $obj_kriteria = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
                                    while($arr_kriteria = mysqli_fetch_array($obj_kriteria)) :
                                    ?>
                                    <option value="<?=$arr_kriteria['id']?>" data-name1="<?=$arr_kriteria['nilai_min']?>" data-name2="<?=$arr_kriteria['nilai_max']?>" ><?=$arr_kriteria['nama_kriteria']?></option>
                                    <?php
                                        endwhile;
                                    ?>

                                </select>
                                <div class="invalid-feedback">
                                    Please choose Kriteria
                                </div>
                            </div>
                        </div>
                        
                        <div id="note" class="form-group row">
                            <label for="" class="col-md " style="margin-top: 33px">Nilai</label>
                            <div class="col-8">
                            <label for="">Keterangan Nilai : <label for="" id='min'></label> - <label for="" id='max'></label> </label>
                            <input type="text" class="form-control" name="nilai" required="">
                                <div class="invalid-feedback">
                                    Please input nilai
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="b_simpan" class="btn bg-info text-white "> <i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Input Guru -->
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
var a;
    $(function() {
        $("#kriteria").change(function (){
            // var val = $("#test option:selected").val();
            // $("#cek") .text(val);
            var min = $("#kriteria option:selected").attr('data-name1');
            var max = $("#kriteria option:selected").attr('data-name2');
            $("#min") .text(min);
            $("#max") .text(max);
        })
    }) 
        
</script>

<script>

</script>

</html>