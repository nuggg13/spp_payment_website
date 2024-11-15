<!-- views/entry_payment.php -->
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}
include '../config/database.php';
$sppOptions = $db->query("SELECT id_spp, tahun FROM spp")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entry Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Entry Payment</h1>

        <?php if (isset($_GET['success'])): ?>
            <p class="text-green-500 mb-4">Payment entry successful!</p>
        <?php endif; ?>

        <form action="../controllers/entry_payment_process.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="nisn" class="block text-gray-700">NISN:</label>
                <input type="text" id="nisn" name="nisn" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="payment_date" class="block text-gray-700">Payment Date:</label>
                <input type="date" id="payment_date" name="payment_date" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="month" class="block text-gray-700">Month:</label>
                <input type="text" id="month" name="month" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="year" class="block text-gray-700">Year:</label>
                <input type="text" id="year" name="year" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700">Amount:</label>
                <input type="number" id="amount" name="amount" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <label for="id_spp">SPP:</label>
    <select name="id_spp" id="id_spp" required>
        <option value="">Nomor SPP</option>
        <?php foreach ($sppOptions as $spp): ?>
            <option value="<?= $spp['id_spp'] ?>"><?= $spp['id_spp'] ?></option>
        <?php endforeach; ?>
    </select>

            <!-- Hidden input for id_petugas -->
            <?php if (isset($_SESSION['id_petugas'])): ?>
                <input type="hidden" name="id_petugas" value="<?php echo $_SESSION['id_petugas']; ?>">
            <?php else: ?>
                <p class="text-red-500">Error: id_petugas is not set. Please log in again.</p>
            <?php endif; ?>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit Payment</button>
        </form>
    </div>
</body>
</html>
