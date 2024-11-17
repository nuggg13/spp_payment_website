<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}

include '../config/database.php';

if (isset($_GET['id_spp'])) {
    $id_spp = $_GET['id_spp'];

    try {
        // Delete the fee from the database
        $stmt = $db->prepare("DELETE FROM spp WHERE id_spp = ?");
        $stmt->execute([$id_spp]);

        // Redirect back to manage fees with success message
        header("Location: ../views/manage_fees.php?success=Fee deleted successfully");
    } catch (PDOException $e) {
        // Redirect back to manage fees with error message
        header("Location: ../views/manage_fees.php?error=Failed to delete fee: " . $e->getMessage());
    }
} else {
    header("Location: ../views/manage_fees.php?error=Invalid fee ID");
}
