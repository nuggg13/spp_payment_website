<!-- views/edit_officer.php -->
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}
include '../config/database.php';

$id_petugas = $_GET['id_petugas'] ?? null;

if ($id_petugas) {
    $stmt = $db->prepare("SELECT * FROM petugas WHERE id_petugas = ?");
    $stmt->execute([$id_petugas]);
    $officer = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$officer) {
    header("Location: manage_officers.php?error=Officer not found");
    exit();
}

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
    <title>Edit Officer</title>
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
        <h1 class="text-3xl font-bold mb-4">Edit Petugas</h1>

        <form action="../controllers/officer_process.php" method="POST" class="bg-white p-4 rounded-lg shadow-md mb-6">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id_petugas" value="<?= $officer['id_petugas'] ?>">

            <div class="mb-4">
                <label for="nama_petugas" class="block text-gray-700">Nama Petugas</label>
                <input type="text" name="nama_petugas" id="nama_petugas" value="<?= $officer['nama_petugas'] ?>" class="border border-gray-300 p-2 w-full" required>
            </div>

            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="<?= $officer['username'] ?>" class="border border-gray-300 p-2 w-full" required>
            </div>

            <div class="mb-4">
                <label for="level" class="block text-gray-700">Level</label>
                <select name="level" id="level" class="border border-gray-300 p-2 w-full" required>
                    <option value="admin" <?= $officer['level'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="petugas" <?= $officer['level'] === 'petugas' ? 'selected' : '' ?>>Officer</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="manage_officers.php" class="text-gray-500 ml-4">Cancel</a>
        </form>
    </div>
</body>
</html>
