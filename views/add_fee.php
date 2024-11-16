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
    <title>Add Fee</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Add New Fee</h1>
        <form action="../controllers/add_fee_process.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="year" class="block text-gray-700 font-bold">Year</label>
                <input type="number" id="year" name="year" class="w-full border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="nominal" class="block text-gray-700 font-bold">Nominal</label>
                <input type="number" id="nominal" name="nominal" class="w-full border-gray-300 rounded-md" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Save</button>
        </form>
    </div>
</body>
</html>
