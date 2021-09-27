<?php
session_start();


require ("FPDF/fpdf.php");

class myPDF extends FPDF {
    function header () {
        $image = "img/logo_smp56.png";
        $nilai = $_SESSION['nilai'];
        $id_guru = $_SESSION['id_guru'];

        include_once('function/helper.php');
        include_once('function/koneksi.php');
        
        $this->Image($image, 5, null, 33.78);
        $this->SetXY(50, 18);
        $this->SetFont('Arial', 'B', 18);
        $this->cell(200,10, 'Sekolah Menengah Pertama Negeri 56 Batam', 0, 0, 'C');
        $this->ln();
        $this->SetFont('Arial','', 14);
        $this->cell(276,13, 'Tiban Kampung RT/RW 002/012 , kelurahan tiban lama, kecamatan sekupang, kota batam', 0, 0, 'C');
        $this->ln();
        $this->SetFont('Arial','', 14);
        $this->cell(270,5, '', 0, 0, 'C');
        $this->Line(5, 46, 290, 46);
        $this->ln();
        $this->SetFont('Arial','B', 18);
        $this->cell(270,25, 'Laporan Guru Terbaik', 0, 0, 'C');

        $this->ln();
        $this->SetFont('Arial', 'B', 14);

        $this->Cell(30, 10, 'No', 1,0, 'C');
        $this->Cell(60, 10, 'Nama', 1,0,'C');
        $this->Cell(60, 10, 'Bidang', 1,0, 'C');
        $this->Cell(60, 10, 'Jabatan', 1,0, 'C');
        $this->Cell(60, 10, 'Nilai', 1,0, 'C');

        //FUNC UNTUK ID SESSION;
        $a = mysqli_query($koneksi, "SELECT * FROM tb_history ORDER BY id DESC LIMIT 1");
        $b = mysqli_fetch_array($a);
        $id_session = $b['id_session'] + 1;
        // 

        $no = 0;
            for ($i = 0; $i < count($nilai); $i++) {
                $no++;
                $id = $id_guru[$i];
                $obj = mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE id = '$id' ");
                $arr = mysqli_fetch_array($obj);

                $this->ln();
                $this->SetFont('Arial', '', 14);
    
                $this->Cell(30, 10, $no, 1,0, 'C');
                $this->Cell(60, 10, $arr['nama_guru'], 1,0,'C');
                $this->Cell(60, 10, $arr['bidang'], 1,0, 'C');
                $this->Cell(60, 10, $arr['jabatan'], 1,0, 'C');
                $this->Cell(60, 10, $nilai[$i], 1,0, 'C');

                // FUNC DATE
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');

                if($_SESSION['role'] == 'admin') {
                    // //FUNC SAVE TO TABLE HISTORY
                    mysqli_query($koneksi, "INSERT INTO tb_history (id_guru, id_session, nilai, date, peringkat) 
                    VALUES ('$id', '$id_session', '$nilai[$i]', '$date', '$no') ");
                }
                
            
            }
        
        

    }

    function Footer()
    {
         // FUNC DATE
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $d = 'Tiban, '.$date;
        
        // Position at ... cm from bottom
        $this->SetY(-40);
        // $this->ln();
        $this->SetFont('Arial','', 14);
        $this->cell(247,-18, 'Mengetahui,', 0, 0, 'R');
        $this->ln();
        $this->SetFont('Arial','', 14);
        $this->cell(0,0, $d, 0, 0, 'L');
        $this->ln();
        $this->SetFont('Arial','', 14);
        $this->cell(250,30, 'Kepala Sekolah', 0, 0, 'R');
        

        $this->ln();
        $this->SetFont('Arial','U', 14);
        $this->cell(250,10, 'Nurhayati, S.pd', 0, 0, 'R');
        $this->ln();
        $this->SetFont('Arial','', 14);
        $this->cell(260,0, 'NIP:198001012003122017', 0, 0, 'R');
    }
    

}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->Output();
?>