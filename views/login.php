<!-- views/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="../controllers/login_process.php" method="POST">
        <label for="role">Login as:</label>
        <select name="role" id="role" required>
            <option value="admin">Administrator</option>
            <option value="petugas">Officer</option>
            <option value="siswa">Student</option>
        </select>

        <div id="admin_petugas_fields">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>

        <div id="siswa_fields" style="display:none;">
            <label for="nama">Name:</label>
            <input type="text" name="nama" id="nama">

            <label for="no_telp">Phone Number:</label>
            <input type="text" name="no_telp" id="no_telp">
        </div>

        <button type="submit">Login</button>
    </form>

    <script>
        // Toggle input fields based on role selection
        document.getElementById("role").addEventListener("change", function() {
            const role = this.value;
            document.getElementById("admin_petugas_fields").style.display = (role === "admin" || role === "petugas") ? "block" : "none";
            document.getElementById("siswa_fields").style.display = (role === "siswa") ? "block" : "none";
        });
    </script>
</body>
</html>
