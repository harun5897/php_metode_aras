<?php
    function simpan_guru ($koneksi, $nip, $nama, $bidang, $jabatan) {
        mysqli_query($koneksi, "INSERT INTO tb_guru (nip, nama_guru, bidang, jabatan) 
        VALUES ('$nip', '$nama', '$bidang', '$jabatan') ");
        header('location: data_guru.php');
    }

    function hapus_guru ($koneksi, $id) {

        mysqli_query($koneksi, "DELETE FROM tb_guru WHERE id = '$id' " );
        header('location: data_guru.php');
    }

    function edit_guru ($koneksi, $nip, $nama, $bidang, $jabatan, $id) {
        mysqli_query($koneksi, "UPDATE tb_guru SET 
        nip = '$nip',
        nama_guru = '$nama',
        bidang = '$bidang',
        jabatan = '$jabatan'

        WHERE id = '$id'
        ");
        header('location: data_guru.php');
    }

    function simpan_kriteria ($koneksi, $nama_kriteria, $bobot, $jenis, $nilai_min, $nilai_max) {
        $obj = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
        while($arr = mysqli_fetch_array($obj)):
            $temp[] = $arr['bobot'];
        endwhile;
        
        $sum_bobot = (int)array_sum($temp) + (int)$bobot;

        if($sum_bobot <= 100) {
            mysqli_query($koneksi, "INSERT INTO tb_kriteria (nama_kriteria, bobot, jenis, nilai_min, nilai_max) 
            VALUES ('$nama_kriteria', '$bobot', '$jenis', '$nilai_min', '$nilai_max') ");
            header('location: data_kriteria.php');
        }
        else {
            header('location: data_kriteria.php?alert=nilai_bobot_max');
        }

    }

    function hapus_kriteria ($koneksi, $id) {

        mysqli_query($koneksi, "DELETE FROM tb_kriteria WHERE id = '$id' " );
        header('location: data_kriteria.php');
    }

    function edit_kriteria ($koneksi, $nama_kriteria, $bobot, $jenis, $nilai_min, $nilai_max, $id) {
        $obj = mysqli_query($koneksi, "SELECT * FROM tb_kriteria");
        while($arr = mysqli_fetch_array($obj)):
            if($arr['id'] != $id) {
            $temp[] = $arr['bobot'];
            }
        endwhile;

        $sum_bobot = (int)array_sum($temp) + (int)$bobot;
        if($sum_bobot <= 100) {
            mysqli_query($koneksi, "UPDATE tb_kriteria SET 
            nama_kriteria = '$nama_kriteria',
            bobot = '$bobot',
            jenis = '$jenis',
            nilai_min = '$nilai_min',
            nilai_max = '$nilai_max'

            WHERE id = '$id'
            ");
            header('location: data_kriteria.php');
        }else {
            header('location: data_kriteria.php?alert=nilai_bobot_max');
        }

    }

    function simpan_nilai ($koneksi, $nama_guru, $nama_kriteria, $nilai) {
        $krt = mysqli_query($koneksi, "SELECT * FROM tb_kriteria where id = '$nama_kriteria' ");
        $arr_krt = mysqli_fetch_array($krt);

        $min = $arr_krt['nilai_min'];
        $max = $arr_krt['nilai_max'];

        if($nilai < $min || $nilai > $max ) {
            header('location: penilaian.php?alert1=nilai_tidak_sesuai');
        } else
        {
            $cek = true;
            $obj = mysqli_query($koneksi, "SELECT * FROM tb_penilaian where id_guru = '$nama_guru' ");
            while ($arr = mysqli_fetch_array($obj)) :
                    if ($arr['id_kriteria'] == $nama_kriteria) {
                        header('location: penilaian.php?alert=data_sudah_ada');
                        $cek = false;
                    }

            endwhile;

            if ($cek == true) {
                    mysqli_query($koneksi, "INSERT INTO tb_penilaian (id_guru, id_kriteria, nilai) 
                    VALUES ('$nama_guru', '$nama_kriteria', '$nilai') ");
                    header('location: penilaian.php');
            }
        }
        
    }

    function hapus_nilai ($koneksi, $id) {

        mysqli_query($koneksi, "DELETE FROM tb_penilaian WHERE id = '$id' " );
        header('location: penilaian.php');

    }

    function login ($koneksi, $email, $password) {

        $login = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE email = '$email' AND password = '$password'");
        $user = mysqli_fetch_array($login);

        $email1 = $user['email'];
        $password1 = $user['password'];

        if($email == $email1 && $password == $password1) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = 'sudah_login';
            $_SESSION['pesan_eror'] = 'pesan';
            $_SESSION['role'] = $user['role'];

            header('location: home.php');
        }
        else {
            header('location: index.php?login=gagal');
        }
    

    }

    function filter ($koneksi, $date_awal, $date_akhir) {

        $_SESSION['date_awal'] = $date_awal;
        $_SESSION['date_akhir'] = $date_akhir;

        header('location: history.php?filter=true');
    }
?>