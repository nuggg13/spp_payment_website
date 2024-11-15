<!-- views/admin_dashboard.php -->
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
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Welcome, Admin!</h1>
        
        <!-- Navigation Links -->
        <nav class="bg-white p-4 rounded-lg shadow-md">
            <ul class="flex space-x-4">
                <li><a href="manage_students.php" class="text-blue-500 hover:text-blue-700">Manage Students</a></li>
                <li><a href="manage_officers.php" class="text-blue-500 hover:text-blue-700">Manage Officers</a></li>
                <li><a href="manage_classes.php" class="text-blue-500 hover:text-blue-700">Manage Classes</a></li>
                <li><a href="manage_fees.php" class="text-blue-500 hover:text-blue-700">Manage Fees</a></li>
                <li><a href="entry_payment.php" class="text-blue-500 hover:text-blue-700">Entri Payment</a></li>
                <li><a href="history_payment.php" class="text-blue-500 hover:text-blue-700">History Payment</a></li>
                <li><a href="generate_report.php" class="text-blue-500 hover:text-blue-700">Generate Report</a></li>
                <li><a href="../controllers/logout.php" class="text-red-500 hover:text-red-700">Logout</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
