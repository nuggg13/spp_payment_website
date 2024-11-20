<?php
// controllers/login_process.php
session_start();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['role']) && $_POST['role'] === 'siswa') {
        // Login untuk siswa
        $nama = $_POST['nama'];
        $no_telp = $_POST['no_telp'];

        $stmt = $db->prepare("SELECT * FROM siswa WHERE nama = ? AND no_telp = ?");
        $stmt->execute([$nama, $no_telp]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            $_SESSION['nama'] = $student['nama'];
            $_SESSION['role'] = 'siswa';
            $_SESSION['nisn'] = $student['nisn']; // Simpan NISN siswa di session

            header("Location: ../views/siswa_dashboard.php");
            exit();
        } else {
            header("Location: ../views/login_siswa.php?error=invalid_credentials");
            exit();
        }
    } else {
        // Login untuk admin atau petugas
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $db->prepare("SELECT * FROM petugas WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['level']; // Role bisa 'admin' atau 'petugas'
            $_SESSION['id_petugas'] = $user['id_petugas'];
            $_SESSION['nama_petugas'] = $user['nama_petugas'];

            // Redirect berdasarkan role
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
    }
}

// Redirect ke login jika file diakses langsung
header("Location: ../views/login.php");
exit();
?>
