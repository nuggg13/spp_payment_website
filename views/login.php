<?php
// views/login.php
session_start();
if (isset($_SESSION['username'])) {
    // Redirect jika sudah login
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
        exit();
    } elseif ($_SESSION['role'] === 'petugas') {
        header("Location: officer_dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin/Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm bg-white p-6 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Login Admin/Petugas</h1>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
            <p class="text-red-500 mb-4">Username atau password salah!</p>
        <?php endif; ?>
        <form action="../controllers/login_process.php" method="POST">
            <label for="username" class="block mb-2">Username:</label>
            <input type="text" name="username" id="username" required class="border rounded w-full p-2 mb-4">

            <label for="password" class="block mb-2">Password:</label>
            <input type="password" name="password" id="password" required class="border rounded w-full p-2 mb-4">

            <button type="submit" class="bg-blue-500 text-white p-2 w-full rounded">Login</button>
        </form>
    </div>
</body>
</html>
