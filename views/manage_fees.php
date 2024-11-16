<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}

include '../config/database.php';

// Ambil data biaya SPP
$stmt = $db->prepare("SELECT * FROM spp");
$stmt->execute();
$fees = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Manage Fees</h1>
        <a href="add_fee.php" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add New Fee</a>
        <table class="min-w-full bg-white border mt-4">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Year</th>
                    <th class="border px-4 py-2">Nominal</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fees as $fee): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= $fee['id_spp'] ?></td>
                        <td class="border px-4 py-2"><?= $fee['tahun'] ?></td>
                        <td class="border px-4 py-2">Rp<?= number_format($fee['nominal'], 2, ',', '.') ?></td>
                        <td class="border px-4 py-2">
                            <a href="edit_fee.php?id=<?= $fee['id_spp'] ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
                            <a href="../controllers/delete_fee_process.php?id=<?= $fee['id_spp'] ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this fee?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
