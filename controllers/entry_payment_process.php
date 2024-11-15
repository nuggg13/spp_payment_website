<?php
// controllers/entry_payment_process.php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn = $_POST['nisn'];
    $payment_date = $_POST['payment_date'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $amount = $_POST['amount'];
    $id_petugas = $_SESSION['id_petugas'];
    $id_spp = $_POST['id_spp']; // Retrieve id_spp from form input

    if (isset($id_petugas) && isset($id_spp)) {
        $stmt = $db->prepare("INSERT INTO pembayaran (nisn, tgl_bayar, bulan_dibayar, tahun_dibayar, jumlah_spp, id_petugas, id_spp) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nisn, $payment_date, $month, $year, $amount, $id_petugas, $id_spp]);

        header("Location: ../views/entry_payment.php?success=1");
        exit();
    } else {
        header("Location: ../views/entry_payment.php?error=missing_data");
        exit();
    }
}
?>
