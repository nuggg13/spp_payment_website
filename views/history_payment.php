<!-- views/history_payment.php -->
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}
include '../config/database.php';

// Get payment history
$stmt = $db->query("SELECT pembayaran.*, siswa.nama FROM pembayaran INNER JOIN siswa ON pembayaran.nisn = siswa.nisn");
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
