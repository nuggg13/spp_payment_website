<!-- views/history_payment.php -->
<?php
session_start();
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'petugas')) {
    header("Location: login.php");
    exit();
}

include '../config/database.php';

// Get payment history
$stmt = $db->query("SELECT pembayaran.*, siswa.nama FROM pembayaran INNER JOIN siswa ON pembayaran.nisn = siswa.nisn");
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Payment History</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<header class="relative bg-gray-800 text-white text-center">
    <h1 class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl font-bold">Welcome, <?= htmlspecialchars($admin['nama_petugas']) ?>!</h1>
    <img src="../assets/perpustakaan.png" alt="Gambar Perpustakaan" class="w-full h-64 object-cover opacity-70">
</header>

<?php if ($_SESSION['role'] === 'admin'): ?>
    <!-- Navigasi untuk admin -->
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
<?php elseif ($_SESSION['role'] === 'petugas'): ?>
    <!-- Navigasi untuk petugas -->
    <nav class="bg-white p-4 rounded-lg shadow-md">
        <ul class="flex space-x-4">
            <li><a href="../views/entry_payment.php" class="text-blue-500 hover:text-blue-700">Pembayaran Spp</a></li>
            <li><a href="../views/history_payment.php" class="text-blue-500 hover:text-blue-700">Riwayat</a></li>
            <li><a href="../controllers/logout.php" class="text-red-500 hover:text-red-700">Logout</a></li>
        </ul>
    </nav>
<?php endif; ?>


    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Payment History</h1>

        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="px-4 py-2">NISN</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Month</th>
                    <th class="px-4 py-2">Year</th>
                    <th class="px-4 py-2">Pembayaran ke</th>
                    <th class="px-4 py-2">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= $payment['nisn'] ?></td>
                        <td class="border px-4 py-2"><?= $payment['nama'] ?></td>
                        <td class="border px-4 py-2"><?= $payment['tgl_bayar'] ?></td>
                        <td class="border px-4 py-2"><?= $payment['bulan_dibayar'] ?></td>
                        <td class="border px-4 py-2"><?= $payment['tahun_dibayar'] ?></td>
                        <td class="border px-4 py-2"><?= $payment['id_spp'] ?></td>
                        <td class="border px-4 py-2"><?= $payment['jumlah_spp'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
