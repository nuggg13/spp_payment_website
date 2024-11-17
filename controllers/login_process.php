<?php
// controllers/login_process.php
session_start();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'];

    if ($role === 'admin' || $role === 'petugas') {
        // For admin or officer login
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $db->prepare("SELECT * FROM petugas WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['level'] === $role) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['level'];
            $_SESSION['id_petugas'] = $user['id_petugas']; // Store id_petugas in session

            if ($user['level'] === 'admin') {
                header("Location: ../views/admin_dashboard.php");
            } else {
                header("Location: ../views/officer_dashboard.php");
            }
            exit();
        } else {
            header("Location: ../views/login.php?error=invalid_credentials");
            exit();
        }
    } elseif ($role === 'siswa') {
        // For student login
        $nama = $_POST['nama'];
        $no_telp = $_POST['no_telp'];

        $stmt = $db->prepare("SELECT * FROM siswa WHERE nama = ? AND no_telp = ?");
        $stmt->execute([$nama, $no_telp]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            $_SESSION['nama'] = $student['nama'];
            $_SESSION['role'] = 'siswa';
            $_SESSION['nisn'] = $student['nisn']; // Store nisn in session

            header("Location: ../views/siswa_dashboard.php"); // Redirect to student dashboard
            exit();
        } else {
            header("Location: ../views/login_siswa.php?error=invalid_credentials");
            exit();
        }
    } else {
        // Invalid role, redirect back to login
        header("Location: ../views/login.php?error=invalid_role");
        exit();
    }
}

// Redirect back to login if accessed improperly
header("Location: ../views/login.php");
exit();
?>
