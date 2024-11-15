<?php
include '../config/database.php';

$stmt = $db->query("SELECT * FROM kelas");
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Add New Student</h1>
        <form action="../controllers/add_student_process.php" method="POST" class="bg-white p-6 rounded shadow-md">
            <label class="block mb-2">NISN:</label>
            <input type="text" name="nisn" required class="border rounded w-full p-2 mb-4">
            
            <label class="block mb-2">NIS:</label>
            <input type="text" name="nis" required class="border rounded w-full p-2 mb-4">
            
            <label class="block mb-2">Name:</label>
            <input type="text" name="nama" required class="border rounded w-full p-2 mb-4">
            
            <label class="block mb-2">Address:</label>
            <input type="text" name="alamat" required class="border rounded w-full p-2 mb-4">
            
            <label class="block mb-2">Phone:</label>
            <input type="text" name="no_telp" required class="border rounded w-full p-2 mb-4">
            
            <label class="block mb-2">Class:</label>
            <select name="id_kelas" required class="border rounded w-full p-2 mb-4">
                <?php foreach ($classes as $class): ?>
                    <option value="<?= $class['id_kelas'] ?>"><?= $class['nama_kelas'] ?></option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Add Student</button>
        </form>
    </div>
</body>
</html>
