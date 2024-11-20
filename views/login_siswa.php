<?php
// views/login_siswa.php
session_start();
if (isset($_SESSION['nama'])) {
    // Redirect jika siswa sudah login
    header("Location: siswa_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm bg-white p-6 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Login Siswa</h1>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
            <p class="text-red-500 mb-4">Nama atau nomor telepon salah!</p>
        <?php endif; ?>
        <form action="../controllers/login_process.php" method="POST">
            <input type="hidden" name="role" value="siswa">
            
            <label for="nama" class="block mb-2">Nama:</label>
            <input type="text" name="nama" id="nama" required class="border rounded w-full p-2 mb-4">

            <label for="no_telp" class="block mb-2">Nomor Telepon:</label>
            <input type="text" name="no_telp" id="no_telp" required class="border rounded w-full p-2 mb-4">

            <button type="submit" class="bg-blue-500 text-white p-2 w-full rounded">Login</button>
        </form>
    </div>
</body>
</html>
