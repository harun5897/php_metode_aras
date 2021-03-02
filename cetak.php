<?php
session_start();


require ("FPDF/fpdf.php");

class myPDF extends FPDF {
    function header () {
        $nilai = $_SESSION['nilai'];
        $id_guru = $_SESSION['id_guru'];

        include_once('function/helper.php');
        include_once('function/koneksi.php');
        
        $this->SetFont('Arial', 'B', 18);
        $this->cell(276,5, 'LAPORAN GURU TERBAIK', 0, 0, 'C');
        $this->ln();
        $this->SetFont('Arial','', 14);
        $this->cell(276,15, 'SMP N 56 Batam', 0, 0, 'C');


        $this->ln();
        $this->SetFont('Arial', 'B', 14);

        $this->Cell(30, 10, 'No', 1,0, 'C');
        $this->Cell(40, 10, 'Nama', 1,0,'C');
        $this->Cell(80, 10, 'Bidang', 1,0, 'C');
        $this->Cell(60, 10, 'Jabatan', 1,0, 'C');
        $this->Cell(60, 10, 'Nilai', 1,0, 'C');


        $no = 0;
            for ($i = 0; $i < count($nilai); $i++) {
                $no++;
                $id = $id_guru[$i];
                $obj = mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE id = '$id' ");
                $arr = mysqli_fetch_array($obj);

                $this->ln();
                $this->SetFont('Arial', '', 14);
    
                $this->Cell(30, 10, $no, 1,0, 'C');
                $this->Cell(40, 10, $arr['nama_guru'], 1,0,'C');
                $this->Cell(80, 10, $arr['bidang'], 1,0, 'C');
                $this->Cell(60, 10, $arr['jabatan'], 1,0, 'C');
                $this->Cell(60, 10, $nilai[$i], 1,0, 'C');
            
            }
    }

}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->Output();
?>