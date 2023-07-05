<?php

session_start();
include 'koneksi.php';

$query = "SELECT username, password, peran from Pelanggan";
$sql = mysqli_query($link, $query);
while ($hasil = mysqli_fetch_array($sql)) {
    $username = stripslashes($hasil['username']);
    $pass = stripslashes($hasil['password']);
    $peran = stripslashes($hasil['peran']);
}

// Cek apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan nilai inputan username dan password
    $userIN = $_POST["username"];
    $passIN = $_POST["password"];

    // Lakukan validasi login sesuai dengan aturan yang Anda tentukan
    // Misalnya, lakukan pengecekan pada tabel pengguna dalam database
    // ...

    // Contoh validasi untuk admin
    if ($userIN === $username && $passIN === $pass) {
        if ($peran === 'admin') {
            $_SESSION["username"] = $username;
            header("Location: client/index.php");
            exit();
        } else {
            $_SESSION["username"] = $username;
            header("Location: admin/index.php");
            exit();
        }
    } else {
        // Jika login gagal, tampilkan pesan error
        $error = "Username atau password salah.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Login</h2>

            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>

            <form action="" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>

                <input type="submit" value="Login">
            </form>

            <p>Belum memiliki akun? <a href="tambah_akun.php">Tambah Akun</a></p>
        </div>
    </div>
</body>
</html>
