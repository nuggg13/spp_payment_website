<?php
session_start();
if ($_SESSION['role'] !== 'petugas') {
    header('Location: login.php');
    exit();
}
?>
<h1>Officer Dashboard</h1>
<a href="enter_payment.php">Enter Payment</a>
<a href="view_payment_history.php">View Payment History</a>
<a href="../controllers/logout.php">Logout</a>
