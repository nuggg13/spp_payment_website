<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}

include '../config/database.php';

$nisn = $_GET['nisn'];
$stmt = $db->prepare("SELECT * FROM siswa WHERE nisn = ?");
$stmt->execute([$nisn]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

$classStmt = $db->query("SELECT * FROM kelas");
$classes = $classStmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Edit Student</title>
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
        <h1 class="text-3xl font-bold mb-4">Edit Siswa</h1>
        <form action="../controllers/edit_student_process.php" method="POST" class="bg-white p-6 rounded shadow-md">
            <input type="hidden" name="nisn" value="<?= $student['nisn'] ?>">
            
            <label class="block mb-2">NIS:</label>
            <input type="text" name="nis" value="<?= $student['nis'] ?>" required class="border rounded w-full p-2 mb-4">
            
            <label class="block mb-2">Nama:</label>
            <input type="text" name="nama" value="<?= $student['nama'] ?>" required class="border rounded w-full p-2 mb-4">
            
            <label class="block mb-2">Alamat:</label>
            <input type="text" name="alamat" value="<?= $student['alamat'] ?>" required class="border rounded w-full p-2 mb-4">
            
            <label class="block mb-2">Nomor Telepon:</label>
            <input type="text" name="no_telp" value="<?= $student['no_telp'] ?>" required class="border rounded w-full p-2 mb-4">
            
            <label class="block mb-2">Kelas:</label>
            <select name="id_kelas" required class="border rounded w-full p-2 mb-4">
                <?php foreach ($classes as $class): ?>
                    <option value="<?= $class['id_kelas'] ?>" <?= $class['id_kelas'] == $student['id_kelas'] ? 'selected' : '' ?>>
                        <?= $class['nama_kelas'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit" class="bg-green-500 text-white p-2 rounded">Update</button>
        </form>
    </div>
</body>
</html>
