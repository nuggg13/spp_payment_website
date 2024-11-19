<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}

include '../config/database.php';

// Fetch all fees from the database
$stmt = $db->prepare("SELECT * FROM spp");
$stmt->execute();
$fees = $stmt->fetchAll(PDO::FETCH_ASSOC);

$username = $_SESSION['username']; // Assumes 'username' is stored in session during login
$stmt = $db->prepare("SELECT * FROM petugas WHERE username = ?");
$stmt->execute([$username]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Fees</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<header class="relative bg-gray-800 text-white text-center">
        <h1 class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl font-bold">Welcome, <?= htmlspecialchars($admin['nama_petugas']) ?>!</h1>
        <img src="../assets/perpustakaan.png" alt="Gambar Perpustakaan" class="w-full h-64 object-cover opacity-70">
    </header>

    <nav class="bg-white p-4 shadow-md">
        <ul class="flex space-x-4">
            <li><a href="manage_students.php" class="text-blue-500 hover:text-blue-700">Atur Siswa</a></li>
            <li><a href="manage_officers.php" class="text-blue-500 hover:text-blue-700">Atur Petugas</a></li>
            <li><a href="manage_classes.php" class="text-blue-500 hover:text-blue-700">Atur Kelas</a></li>
            <li><a href="manage_fees.php" class="text-blue-500 hover:text-blue-700">Atur Spp</a></li>
            <li><a href="entry_payment.php" class="text-blue-500 hover:text-blue-700">Pembayaran Spp</a></li>
            <li><a href="history_payment.php" class="text-blue-500 hover:text-blue-700">Riwayat</a></li>
            <li><a href="generate_report.php" class="text-blue-500 hover:text-blue-700">Buat Laporan</a></li>
            <li><a href="../controllers/logout.php" class="text-red-500 hover:text-red-700">Logout</a></li>
        </ul>
    </nav>

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Daftar Spp</h1>

        <!-- Display success or error message -->
        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                Data berhasil disimpan!
            </div>
        <?php endif; ?>

        <!-- Add Fee Button -->
        <a href="add_fee.php" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 mb-4 inline-block">Tambah Spp</a>

        <!-- Fees Table -->
        <table class="table-auto w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2">ID SPP</th>
                    <th class="px-4 py-2">Tahun</th>
                    <th class="px-4 py-2">Nominal</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($fees) > 0): ?>
                    <?php foreach ($fees as $fee): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?= htmlspecialchars($fee['id_spp']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($fee['tahun']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($fee['nominal']) ?></td>
                            <td class="px-4 py-2">
                                <a href="../controllers/delete_fee_process.php?id_spp=<?= $fee['id_spp'] ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this fee?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center px-4 py-2">No fees found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
