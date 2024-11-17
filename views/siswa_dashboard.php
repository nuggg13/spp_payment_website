<?php
// Start session
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'siswa') {
    header("Location: login_siswa.php");
    exit();
}

// Include database connection
include '../config/database.php';

// Get the logged-in student's NISN
$nisn = $_SESSION['nisn'];

// Query to fetch payment history for the logged-in student
$stmt = $db->prepare("
    SELECT p.id_spp, p.tgl_bayar, p.bulan_dibayar, p.tahun_dibayar, p.jumlah_spp, s.nama_petugas, f.nominal
    FROM pembayaran p
    JOIN petugas s ON p.id_petugas = s.id_petugas
    JOIN spp f ON p.id_spp = f.id_spp
    WHERE p.nisn = ?
    ORDER BY p.id_spp ASC
");
$stmt->execute([$nisn]);
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Welcome, <?= htmlspecialchars($_SESSION['nama']); ?>!</h1>
        <p class="mb-4">Ini Riwayat Anda :</p>

        <!-- Payment History Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">ID SPP</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Bayar</th>
                        <th class="border border-gray-300 px-4 py-2">Bulan Bayar</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Bayar</th>
                        <th class="border border-gray-300 px-4 py-2">Nominal</th>
                        <th class="border border-gray-300 px-4 py-2">Petugas</th>
                        <th class="border border-gray-300 px-4 py-2">SPP Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($payments) > 0): ?>
                        <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($payment['id_spp']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($payment['tgl_bayar']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($payment['bulan_dibayar']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($payment['tahun_dibayar']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars(number_format($payment['jumlah_spp'])); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($payment['nama_petugas']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars(number_format($payment['nominal'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center" colspan="7">No payment history found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Logout Button -->
        <div class="mt-4">
            <a href="../controllers/logout.php" class="text-red-500 hover:text-red-700">Logout</a>
        </div>
    </div>
</body>
</html>
