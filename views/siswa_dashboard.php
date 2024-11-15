<?php
session_start();
if ($_SESSION['role'] !== 'siswa') {
    header('Location: login.php');
    exit();
}
?>
<h1>Student Dashboard</h1>
<a href="view_payment_history.php">View Payment History</a>
<a href="../controllers/logout.php">Logout</a>
