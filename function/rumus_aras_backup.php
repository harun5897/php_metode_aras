<?php
// Langkah 1 Matriks Keputusan
$kriteria = mysqli_query($koneksi, "SELECT * from tb_kriteria");
while ($arr_kriteria = mysqli_fetch_array($kriteria)):
    $id_kriteria = $arr_kriteria['id'];
    $guru = mysqli_query($koneksi, "SELECT * from tb_guru");
    while ($arr_guru = mysqli_fetch_array($guru)):
        
        $id_guru = $arr_guru['id'];
        $nilai = mysqli_query($koneksi, "SELECT * FROM tb_penilaian");
        while($arr_nilai = mysqli_fetch_array($nilai)) :
            if($id_kriteria == $arr_nilai['id_kriteria'] && $id_guru == $arr_nilai['id_guru'] ) {
                echo $arr_nilai['nilai']." ";
                $temp[]= $arr_nilai['nilai'];    
            }
        endwhile;
    endwhile;
    echo '<br>';
    $_SESSION['x'.$id_kriteria] = $temp;
    unset ($temp);
endwhile;

echo '<br>';
print_r($_SESSION['x1']); echo '<br>';
print_r($_SESSION['x2']); echo '<br>';
print_r($_SESSION['x3']); echo '<br>';
print_r($_SESSION['x4']); echo '<br>';
print_r($_SESSION['x5']); echo '<br>';

$kriteria = mysqli_query($koneksi, "SELECT * from tb_kriteria");
while ($arr_kriteria = mysqli_fetch_array($kriteria)):
    $id_kriteria = $arr_kriteria['id'];
    if($arr_kriteria['jenis'] == 'benefit') {
        $temp[] = max($_SESSION['x'.$id_kriteria]);
    }
    if($arr_kriteria['jenis'] == 'cost') {
        $temp[] = min($_SESSION['x'.$id_kriteria]);
    }
    for($i = 0;  $i < count($_SESSION['x'.$id_kriteria]); $i++) {

        $temp[$i+1] = $_SESSION['x'.$id_kriteria][$i];
        
    }
    $_SESSION['x'.$id_kriteria] = $temp;
    unset ($temp);
endwhile;

echo '<br>';
echo '--Decision Matriks--';
echo '<br>';
print_r($_SESSION['x1']);echo '<br>';
print_r($_SESSION['x2']);echo '<br>';
print_r($_SESSION['x3']);echo '<br>';
print_r($_SESSION['x4']);echo '<br>';
print_r($_SESSION['x5']);echo '<br>';
// Tutup Langkah 1 Matriks Keputusan


        
// Langkah 2  Normalisasi Matriks
echo '<h2>Langkah Kedua</h2>';
$kriteria = mysqli_query($koneksi, "SELECT * from tb_kriteria");
while ($arr_kriteria = mysqli_fetch_array($kriteria)):
    $id_kriteria = $arr_kriteria['id'];
    $_SESSION['s'.$id_kriteria] = array_sum($_SESSION['x'.$id_kriteria]);
endwhile;

print_r($_SESSION['x1']); echo "Hasil => " ;print_r($_SESSION['s1']); echo '<br>';
print_r($_SESSION['x2']); echo "Hasil => " ;print_r($_SESSION['s2']); echo '<br>';
print_r($_SESSION['x3']); echo "Hasil => " ;print_r($_SESSION['s3']); echo '<br>';
print_r($_SESSION['x4']); echo "Hasil => " ;print_r($_SESSION['s4']); echo '<br>';
print_r($_SESSION['x5']); echo "Hasil => " ;print_r($_SESSION['s5']); echo '<br>';

echo '<br>';
echo '<br>';

$kriteria = mysqli_query($koneksi, "SELECT * from tb_kriteria");
while ($arr_kriteria = mysqli_fetch_array($kriteria)):
    $id_kriteria = $arr_kriteria['id'];
    for($i = 0;  $i < count($_SESSION['x'.$id_kriteria]); $i++) {

        $div = $_SESSION['x'.$id_kriteria][$i] / $_SESSION['s'.$id_kriteria];
        $round = round($div, 3);
        echo $round." ";
        $temp[] = $round;
        
    }
    $_SESSION['a'.$id_kriteria] = $temp;
    unset ($temp);
    echo '<br>';
endwhile;
echo '<br>';
print_r($_SESSION['a1']); echo '<br>';
print_r($_SESSION['a2']); echo '<br>';
print_r($_SESSION['a3']); echo '<br>';
print_r($_SESSION['a4']); echo '<br>';
print_r($_SESSION['a5']); echo '<br>';
// Tutup Langkah 2  Normalisasi Matriks



// Langkah 3 Menentukan Bobot Matriks
echo '<h2>Langkah Ketiga</h2>';
$kriteria = mysqli_query($koneksi, "SELECT * from tb_kriteria");
while ($arr_kriteria = mysqli_fetch_array($kriteria)):
    $id_kriteria = $arr_kriteria['id'];
    $bobot = $arr_kriteria['bobot'] / 100;
    for($i = 0;  $i < count($_SESSION['a'.$id_kriteria]); $i++) {

        $multiple = $_SESSION['a'.$id_kriteria][$i] * $bobot;
        echo $multiple. " ";
        $temp[] = $multiple;
    }
    $_SESSION['b'.$id_kriteria] = $temp;
    unset ($temp);
    echo '<br>';
endwhile;

echo '<br>';
print_r($_SESSION['x1']); echo '<br>';
print_r($_SESSION['x2']); echo '<br>';
print_r($_SESSION['x3']); echo '<br>';
print_r($_SESSION['x4']); echo '<br>';
print_r($_SESSION['x5']); echo '<br>';
//Tutup Langkah 3 Menentukan Bobot Matriks


// Langkah 4 Menentukan Nilai Optimalisasi
echo '<h2>Langkah Keempat</h2>';

$kriteria = mysqli_query($koneksi, "SELECT * from tb_guru");
while ($arr_kriteria = mysqli_fetch_array($kriteria)):
        $temp_guru[] = $arr_kriteria;
endwhile;
$count = count($temp_guru);
for($a = 0; $a < $count+1; $a++) {
    $kriteria = mysqli_query($koneksi, "SELECT * from tb_kriteria");
    for ($i = 0; $arr_kriteria = mysqli_fetch_array($kriteria); $i++){
        $id_kriteria = $arr_kriteria['id'];
        $temp[] = $_SESSION['b'.$id_kriteria][$a];
        echo $_SESSION['b'.$id_kriteria][$a]. ' ';
    }
    $_SESSION['c'.$a] = array_sum($temp);
    unset ($temp);
    echo '<br>';
}
echo '<br>';
print_r($_SESSION['c0']); echo '<br>';
print_r($_SESSION['c1']); echo '<br>';
print_r($_SESSION['c2']); echo '<br>';
print_r($_SESSION['c3']); echo '<br>';
// Tutup Langkah 4 Menentukan Nilai Optimalisasi

// Langkah 5 Tingkatan Peringkat
echo '<h2>Langkah Kelima</h2>';

for($i = 0; $i < $count+1; $i++) {
    $div = $_SESSION['c'.$i] / $_SESSION['c0'];
    $_SESSION['d'.$i] = round($div, 3);
}

header('location: hasil.php'); 
?>