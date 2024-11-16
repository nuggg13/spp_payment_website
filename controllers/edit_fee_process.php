<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}

include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_spp'];
    $year = $_POST['year'];
    $nominal = $_POST['nominal'];

    $stmt = $db->prepare("UPDATE spp SET tahun = ?, nominal = ? WHERE id_spp = ?");
    $stmt->execute([$year, $nominal, $id]);

    header("Location: ../views/manage_fees.php?success=1");
    exit();
}
?>
