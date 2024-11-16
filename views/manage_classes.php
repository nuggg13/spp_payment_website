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
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Manage Classes</h1>

        <!-- Add Class Button -->
        <a href="add_class.php" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add Class</a>

        <!-- Class Table -->
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Class Name</th>
                    <th class="px-4 py-2">Expertise</th>
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
