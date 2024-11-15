<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}
include '../config/database.php';

$nisn = $_GET['nisn'];

$stmt = $db->prepare("DELETE FROM siswa WHERE nisn = ?");
$stmt->execute([$nisn]);

header("Location: ../views/manage_students.php?success=1");
exit();
