<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login for Students</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-2xl font-bold mb-6 text-center">Student Login</h2>
        <form action="../controllers/login_process.php" method="POST">
            <!-- Hidden Role Field -->
            <input type="hidden" name="role" value="siswa">

            <!-- Student Fields -->
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-medium mb-2">Name:</label>
                <input type="text" name="nama" id="nama" class="w-full p-2 border rounded" placeholder="Enter your name">
            </div>

            <div class="mb-4">
                <label for="no_telp" class="block text-gray-700 font-medium mb-2">Phone Number:</label>
                <input type="text" name="no_telp" id="no_telp" class="w-full p-2 border rounded" placeholder="Enter your phone number">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Login</button>
        </form>
    </div>
</body>
</html>
