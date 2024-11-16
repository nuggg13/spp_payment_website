<!-- views/add_class.php -->
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Add New Class</h1>

        <form action="../controllers/class_process.php" method="POST" class="bg-white p-4 rounded-lg shadow-md">
    <input type="hidden" name="action" value="add">

    <div class="mb-4">
        <label for="nama_kelas" class="block text-gray-700">Class Name</label>
        <input type="text" name="nama_kelas" id="nama_kelas" class="border border-gray-300 p-2 w-full" required>
    </div>

    <div class="mb-4">
        <label for="kompetensi_keahlian" class="block text-gray-700">Expertise</label>
        <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" class="border border-gray-300 p-2 w-full" required>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Class</button>
</form>
    </div>
</body>
</html>
