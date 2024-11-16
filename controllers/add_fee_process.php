<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}

include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = $_POST['year'];
    $nominal = $_POST['nominal'];

    $stmt = $db->prepare("INSERT INTO spp (tahun, nominal) VALUES (?, ?)");
    $stmt->execute([$year, $nominal]);

    header("Location: ../views/manage_fees.php?success=1");
    exit();
}
?>
