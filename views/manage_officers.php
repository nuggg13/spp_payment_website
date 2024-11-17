<!-- views/manage_officers.php -->
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}
include '../config/database.php';

// Fetch officers data
$stmt = $db->query("SELECT * FROM petugas");
$officers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Officers</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Daftar Petugas</h1>

        <!-- Add Officer Form -->
        <form action="../controllers/officer_process.php" method="POST" class="bg-white p-4 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-bold mb-4">Tambah Petugas Baru</h2>
            <div class="mb-4">
                <label for="id_petugas" class="block text-gray-700">ID Petugas</label>
                <input type="text" name="id_petugas" id="id_petugas" class="border border-gray-300 p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label for="nama_petugas" class="block text-gray-700">Nama Petugas</label>
                <input type="text" name="nama_petugas" id="nama_petugas" class="border border-gray-300 p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" name="username" id="username" class="border border-gray-300 p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="border border-gray-300 p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label for="level" class="block text-gray-700">Level</label>
                <select name="level" id="level" class="border border-gray-300 p-2 w-full" required>
                    <option value="admin">Admin</option>
                    <option value="petugas">Officer</option>
                </select>
            </div>
            <button type="submit" name="action" value="create" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
        </form>

        <!-- Officers Table -->
        <table class="bg-white w-full rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="p-4 border-b">ID Petugas</th>
                    <th class="p-4 border-b">Nama Petugas</th>
                    <th class="p-4 border-b">Username</th>
                    <th class="p-4 border-b">Level</th>
                    <th class="p-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($officers as $officer): ?>
                    <tr>
                        <td class="p-4 border-b"><?= $officer['id_petugas'] ?></td>
                        <td class="p-4 border-b"><?= $officer['nama_petugas'] ?></td>
                        <td class="p-4 border-b"><?= $officer['username'] ?></td>
                        <td class="p-4 border-b"><?= $officer['level'] ?></td>
                        <td class="p-4 border-b">
                        <a href="edit_officer.php?id_petugas=<?= $officer['id_petugas'] ?>" class="text-blue-500">Edit</a>
                            |
                            <a href="../controllers/officer_process.php?action=delete&id_petugas=<?= $officer['id_petugas'] ?>" class="text-red-500">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
