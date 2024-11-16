<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}

include '../config/database.php';

$id = $_GET['id'];

$stmt = $db->prepare("DELETE FROM spp WHERE id_spp = ?");
$stmt->execute([$id]);

header("Location: ../views/manage_fees.php?success=1");
exit();
?>
