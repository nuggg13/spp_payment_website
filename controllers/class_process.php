<?php
// controllers/class_process.php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}
include '../config/database.php';

$action = $_POST['action'] ?? $_GET['action'] ?? null;

if ($action === 'add') {
    // Add a new class
    $nama_kelas = $_POST['nama_kelas'];
    $kompetensi_keahlian = $_POST['kompetensi_keahlian'];

    $stmt = $db->prepare("INSERT INTO kelas (nama_kelas, kompetensi_keahlian) VALUES (?, ?)");
    $stmt->execute([$nama_kelas, $kompetensi_keahlian]);

    header("Location: ../views/manage_classes.php?success=Class added");
    exit();
}
 elseif ($action === 'edit') {
    // Edit an existing class
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $kompetensi_keahlian = $_POST['kompetensi_keahlian'];

    $stmt = $db->prepare("UPDATE kelas SET nama_kelas = ?, kompetensi_keahlian = ? WHERE id_kelas = ?");
    $stmt->execute([$nama_kelas, $kompetensi_keahlian, $id_kelas]);

    header("Location: ../views/manage_classes.php?success=Class updated");
    exit();

} elseif ($action === 'delete') {
    // Delete a class
    $id_kelas = $_GET['id_kelas'];

    $stmt = $db->prepare("DELETE FROM kelas WHERE id_kelas = ?");
    $stmt->execute([$id_kelas]);

    header("Location: ../views/manage_classes.php?success=Class deleted");
    exit();
}
