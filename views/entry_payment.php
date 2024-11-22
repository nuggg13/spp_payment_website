<!-- views/entry_payment.php -->
<?php
session_start();
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'petugas')) {
    header("Location: login.php");
    exit();
}

include '../config/database.php';
$sppOptions = $db->query("SELECT id_spp, tahun FROM spp")->fetchAll(PDO::FETCH_ASSOC);

include '../config/database.php';

$username = $_SESSION['username']; // Assumes 'username' is stored in session during login
$stmt = $db->prepare("SELECT * FROM petugas WHERE username = ?");
$stmt->execute([$username]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Spp</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<header class="relative bg-gray-800 text-white text-center">
    <h1 class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl font-bold">Welcome, <?= htmlspecialchars($admin['nama_petugas']) ?>!</h1>
    <img src="../assets/perpustakaan.png" alt="Gambar Perpustakaan" class="w-full h-64 object-cover opacity-70">
</header>

<?php if ($_SESSION['role'] === 'admin'): ?>
    <!-- Navigasi untuk admin -->
    <nav class="bg-white p-4 shadow-md">
        <ul class="flex space-x-4">
            <li><a href="manage_students.php" class="text-blue-500 hover:text-blue-700">Atur Siswa</a></li>
            <li><a href="manage_officers.php" class="text-blue-500 hover:text-blue-700">Atur Petugas</a></li>
            <li><a href="manage_classes.php" class="text-blue-500 hover:text-blue-700">Atur Kelas</a></li>
            <li><a href="manage_fees.php" class="text-blue-500 hover:text-blue-700">Atur Spp</a></li>
            <li><a href="entry_payment.php" class="text-blue-500 hover:text-blue-700">Pembayaran Spp</a></li>
            <li><a href="history_payment.php" class="text-blue-500 hover:text-blue-700">Riwayat</a></li>
            <li><a href="generate_report.php" class="text-blue-500 hover:text-blue-700">Buat Laporan</a></li>
            <li><a href="../controllers/logout.php" class="text-red-500 hover:text-red-700">Logout</a></li>
        </ul>
    </nav>
<?php elseif ($_SESSION['role'] === 'petugas'): ?>
    <!-- Navigasi untuk petugas -->
    <nav class="bg-white p-4 rounded-lg shadow-md">
        <ul class="flex space-x-4">
            <li><a href="../views/entry_payment.php" class="text-blue-500 hover:text-blue-700">Pembayaran Spp</a></li>
            <li><a href="../views/history_payment.php" class="text-blue-500 hover:text-blue-700">Riwayat</a></li>
            <li><a href="../controllers/logout.php" class="text-red-500 hover:text-red-700">Logout</a></li>
        </ul>
    </nav>
<?php endif; ?>

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Bayar Spp</h1>

        <?php if (isset($_GET['success'])): ?>
            <p class="text-green-500 mb-4">Payment entry successful!</p>
        <?php endif; ?>

        <form action="../controllers/entry_payment_process.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="nisn" class="block text-gray-700">NISN:</label>
                <input type="text" id="nisn" name="nisn" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="payment_date" class="block text-gray-700">Tanggal Bayar:</label>
                <input type="date" id="payment_date" name="payment_date" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="month" class="block text-gray-700">Bulan:</label>
                <input type="text" id="month" name="month" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="year" class="block text-gray-700">Tahun:</label>
                <input type="text" id="year" name="year" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700">Nominal:</label>
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

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
        </form>
    </div>
</body>
</html>
