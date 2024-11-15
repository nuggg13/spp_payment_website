<?php
// views/manage_students.php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include '../config/database.php';

$stmt = $db->query("SELECT s.*, k.nama_kelas FROM siswa s LEFT JOIN kelas k ON s.id_kelas = k.id_kelas");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Manage Students</h1>
        <a href="add_student.php" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">Add New Student</a>
        
        <table class="table-auto w-full bg-white shadow-md rounded border">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">NISN</th>
                    <th class="px-4 py-2 border">NIS</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Address</th>
                    <th class="px-4 py-2 border">Phone</th>
                    <th class="px-4 py-2 border">Class</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td class="px-4 py-2 border"><?= $student['nisn'] ?></td>
                        <td class="px-4 py-2 border"><?= $student['nis'] ?></td>
                        <td class="px-4 py-2 border"><?= $student['nama'] ?></td>
                        <td class="px-4 py-2 border"><?= $student['alamat'] ?></td>
                        <td class="px-4 py-2 border"><?= $student['no_telp'] ?></td>
                        <td class="px-4 py-2 border"><?= $student['nama_kelas'] ?></td>
                        <td class="px-4 py-2 border">
                            <a href="edit_student.php?nisn=<?= $student['nisn'] ?>" class="text-green-500 hover:text-green-700">Edit</a> |
                            <a href="../controllers/delete_student_process.php?nisn=<?= $student['nisn'] ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
