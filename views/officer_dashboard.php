<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'petugas') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Officer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        
        <!-- Navigation Links -->
        <nav class="bg-white p-4 rounded-lg shadow-md">
            <ul class="flex space-x-4">
                <li><a href="../views/entry_payment.php" class="text-blue-500 hover:text-blue-700">Pembayaran Spp</a></li>
                <li><a href="../views/history_payment.php" class="text-blue-500 hover:text-blue-700">Riwayat</a></li>
                <li><a href="../controllers/logout.php" class="text-red-500 hover:text-red-700">Logout</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
