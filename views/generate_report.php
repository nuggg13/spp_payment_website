<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include '../config/database.php';

// Fetch payment history
// In generate_report.php, replace $query and $stmt with the following code:
$start_date = $_GET['start_date'] ?? null;
$end_date = $_GET['end_date'] ?? null;
$query = "SELECT pembayaran.*, siswa.nama, petugas.nama_petugas 
          FROM pembayaran 
          JOIN siswa ON pembayaran.nisn = siswa.nisn
          JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas";

if ($start_date && $end_date) {
    $query .= " WHERE tgl_bayar BETWEEN :start_date AND :end_date";
}

$query .= " ORDER BY pembayaran.tgl_bayar DESC";
$stmt = $db->prepare($query);

if ($start_date && $end_date) {
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
}

$stmt->execute();
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Report</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Generate Report</h1>

        <!-- Filter Form -->
        <form method="GET" action="generate_report.php" class="mb-4">
            <input type="date" name="start_date" class="border p-2 rounded" placeholder="Start Date">
            <input type="date" name="end_date" class="border p-2 rounded" placeholder="End Date">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
            <a href="../controllers/export_report.php" class="bg-green-500 text-white px-4 py-2 rounded">Export as PDF</a>
        </form>

        <!-- Payment Table -->
        <table class="min-w-full bg-white shadow-md rounded overflow-hidden">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">NISN</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Student Name</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Petugas</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Tanggal Bayar</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Month Paid</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Year</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td class="px-6 py-4 border-b border-gray-300"><?php echo htmlspecialchars($payment['nisn']); ?></td>
                        <td class="px-6 py-4 border-b border-gray-300"><?php echo htmlspecialchars($payment['nama']); ?></td>
                        <td class="px-6 py-4 border-b border-gray-300"><?php echo htmlspecialchars($payment['nama_petugas']); ?></td>
                        <td class="px-6 py-4 border-b border-gray-300"><?php echo htmlspecialchars($payment['tgl_bayar']); ?></td>
                        <td class="px-6 py-4 border-b border-gray-300"><?php echo htmlspecialchars($payment['bulan_dibayar']); ?></td>
                        <td class="px-6 py-4 border-b border-gray-300"><?php echo htmlspecialchars($payment['tahun_dibayar']); ?></td>
                        <td class="px-6 py-4 border-b border-gray-300"><?php echo htmlspecialchars($payment['jumlah_spp']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
