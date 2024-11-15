<?php
// controllers/login_process.php
session_start();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($role === 'admin' || $role === 'petugas') {
        // For admin or officer login
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
                header("Location: ../views/petugas_dashboard.php");
            }
            exit();
        } else {
            header("Location: ../views/login.php?error=invalid_credentials");
            exit();
        }
    } elseif ($role === 'siswa') {
        // For student login
        $stmt = $db->prepare("SELECT * FROM siswa WHERE nama = ? AND no_telp = ?");
        $stmt->execute([$username, $password]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            $_SESSION['nama'] = $student['nama'];
            $_SESSION['role'] = 'siswa';
            $_SESSION['nisn'] = $student['nisn']; // Store nisn in session for student

            header("Location: ../views/siswa_dashboard.php");
            exit();
        } else {
            header("Location: ../views/login.php?error=invalid_credentials");
            exit();
        }
    }
}
header("Location: ../views/login.php");
exit();
?>
