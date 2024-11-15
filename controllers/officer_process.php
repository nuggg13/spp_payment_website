<?php
// controllers/officer_process.php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}
include '../config/database.php';

$action = $_POST['action'] ?? $_GET['action'];

if ($action === 'create') {
    // Create new officer
    $id_petugas = $_POST['id_petugas'];
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $level = $_POST['level'];

    $stmt = $db->prepare("INSERT INTO petugas (id_petugas, nama_petugas, username, password, level) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id_petugas, $nama_petugas, $username, $password, $level]);

    header("Location: ../views/manage_officers.php");
    exit();
} elseif ($action === 'edit') {
    // Edit officer details
    $id_petugas = $_POST['id_petugas'];
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $level = $_POST['level'];

    $stmt = $db->prepare("UPDATE petugas SET nama_petugas = ?, username = ?, level = ? WHERE id_petugas = ?");
    $stmt->execute([$nama_petugas, $username, $level, $id_petugas]);

    header("Location: ../views/manage_officers.php?success=Officer updated");
    exit();
}
 elseif ($action === 'delete') {
    // Delete officer
    $id_petugas = $_GET['id_petugas'];

    $stmt = $db->prepare("DELETE FROM petugas WHERE id_petugas = ?");
    $stmt->execute([$id_petugas]);

    header("Location: ../views/manage_officers.php");
    exit();
}
?>
