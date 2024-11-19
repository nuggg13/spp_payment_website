<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'petugas') {
    header("Location: login.php");
    exit();
}

include '../config/database.php';

$username = $_SESSION['username']; // Assumes 'username' is stored in session during login
$stmt = $db->prepare("SELECT * FROM petugas WHERE username = ?");
$stmt->execute([$username]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Officer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<header class="relative bg-gray-800 text-white text-center">
        <h1 class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl font-bold">Welcome, <?= htmlspecialchars($admin['nama_petugas']) ?>!</h1>
        <img src="../assets/perpustakaan.png" alt="Gambar Perpustakaan" class="w-full h-64 object-cover opacity-70">
    </header>

<nav class="bg-white p-4 rounded-lg shadow-md">
            <ul class="flex space-x-4">
                <li><a href="../views/entry_payment.php" class="text-blue-500 hover:text-blue-700">Pembayaran Spp</a></li>
                <li><a href="../views/history_payment.php" class="text-blue-500 hover:text-blue-700">Riwayat</a></li>
                <li><a href="../controllers/logout.php" class="text-red-500 hover:text-red-700">Logout</a></li>
            </ul>
        </nav>
</body>
</html>
