<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form action="../controllers/login_process.php" method="POST">
            <!-- Role Selection -->
            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-medium mb-2">Login as:</label>
                <select name="role" id="role" required class="w-full p-2 border rounded">
                    <option value="admin">Administrator</option>
                    <option value="petugas">Petugas</option>
                </select>
            </div>

            <!-- Admin/Officer Fields -->
            <div id="admin_petugas_fields" class="mb-4">
                <label for="username" class="block text-gray-700 font-medium mb-2">Username:</label>
                <input type="text" name="username" id="username" class="w-full p-2 border rounded" placeholder="Enter your username">
                
                <label for="password" class="block text-gray-700 font-medium mb-2 mt-4">Password:</label>
                <input type="password" name="password" id="password" class="w-full p-2 border rounded" placeholder="Enter your password">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Login</button>
        </form>

        <p class="text-center mt-4 text-gray-600">
            Are you a student? <a href="login_siswa.php" class="text-blue-500 hover:text-blue-700">Click here to login</a>.
        </p>
    </div>
</body>
</html>
