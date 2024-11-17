<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}

include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_spp = $_POST['id_spp'];
    $year = $_POST['year'];
    $nominal = $_POST['nominal'];

    // Validasi jika `id_spp` sudah ada
    $stmt_check = $db->prepare("SELECT COUNT(*) FROM spp WHERE id_spp = ?");
    $stmt_check->execute([$id_spp]);
    if ($stmt_check->fetchColumn() > 0) {
        header("Location: ../views/add_fee.php?error=ID SPP already exists");
        exit();
    }

    $stmt = $db->prepare("INSERT INTO spp (id_spp, tahun, nominal) VALUES (?, ?, ?)");
    $stmt->execute([$id_spp, $year, $nominal]);

    header("Location: ../views/manage_fees.php?success=1");
    exit();
}
?>
