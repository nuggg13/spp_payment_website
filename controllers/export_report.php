<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}

require('../libs/fpdf.php');
include '../config/database.php';

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Payment History Report', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(30, 10, 'NISN', 1);
$pdf->Cell(40, 10, 'Student Name', 1);
$pdf->Cell(40, 10, 'Officer', 1);
$pdf->Cell(30, 10, 'Payment Date', 1);
$pdf->Cell(25, 10, 'Month Paid', 1);
$pdf->Cell(20, 10, 'Year', 1);
$pdf->Cell(25, 10, 'Amount', 1);
$pdf->Ln();

$stmt = $db->query("SELECT pembayaran.*, siswa.nama, petugas.nama_petugas 
                    FROM pembayaran 
                    JOIN siswa ON pembayaran.nisn = siswa.nisn 
                    JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
                    ORDER BY pembayaran.tgl_bayar DESC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(30, 10, $row['nisn'], 1);
    $pdf->Cell(40, 10, $row['nama'], 1);
    $pdf->Cell(40, 10, $row['nama_petugas'], 1);
    $pdf->Cell(30, 10, $row['tgl_bayar'], 1);
    $pdf->Cell(25, 10, $row['bulan_dibayar'], 1);
    $pdf->Cell(20, 10, $row['tahun_dibayar'], 1);
    $pdf->Cell(25, 10, $row['jumlah_spp'], 1);
    $pdf->Ln();
}

$pdf->Output('D', 'payment_report.pdf');
