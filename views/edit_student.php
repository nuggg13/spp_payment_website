<?php
include '../config/database.php';

$nisn = $_GET['nisn'];
$stmt = $db->prepare("SELECT * FROM siswa WHERE nisn = ?");
$stmt->execute([$nisn]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

$classStmt = $db->query("SELECT * FROM kelas");
$classes = $classStmt->fetchAll(PDO::FETCH_ASSOC);
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
