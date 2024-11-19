<!-- views/manage_classes.php -->
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}
include '../config/database.php';

// Fetch all classes
$stmt = $db->prepare("SELECT * FROM kelas");
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Manage Classes</title>
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
        <h1 class="text-3xl font-bold mb-4">Daftar Kelas</h1>

        <!-- Add Class Button -->
        <a href="add_class.php" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Kelas</a>

        <!-- Class Table -->
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nama Kelas</th>
                    <th class="px-4 py-2">Jurusan</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classes as $class): ?>
                <tr class="border-b">
                    <td class="px-4 py-2"><?= $class['id_kelas'] ?></td>
                    <td class="px-4 py-2"><?= $class['nama_kelas'] ?></td>
                    <td class="px-4 py-2"><?= $class['kompetensi_keahlian'] ?></td>
                    <td class="px-4 py-2">
                        <a href="edit_class.php?id_kelas=<?= $class['id_kelas'] ?>" class="text-blue-500">Edit</a>
                        <a href="../controllers/class_process.php?action=delete&id_kelas=<?= $class['id_kelas'] ?>" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
