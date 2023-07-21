<?php
session_start();
include 'koneksi.php';

// Cek apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan nilai inputan username dan katasandi
    $userIN = $_POST["username"];
    $passIN = $_POST["katasandi"];

    // Mendapatkan data pengguna dari database
    $query = "SELECT pl.id_pelanggan, ak.id_user, pl.nama, pl.alamat, pl.telepon, pl.email, ak.username, ak.katasandi, ak.peran
              FROM pelanggan pl
              JOIN akun ak ON pl.id_pelanggan = ak.id_pelanggan
              WHERE ak.username = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "s", $userIN);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Memeriksa apakah terdapat hasil data
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $katasandi = $row['katasandi'];
        $peran = $row['peran'];

        // Memeriksa kesesuaian katasandi
        if ($passIN === $katasandi) {
            $_SESSION["username"] = $username;

            // Redirect sesuai peran pengguna
            if ($peran === 'admin') {
                header("Location: admin/index.php");
                exit();
            } else {
                header("Location: client/index.php");
                exit();
            }
        } else {
            // Jika katasandi tidak sesuai, tampilkan pesan error
            $error = "Katasandi salah.";
        }
    } else {
        // Jika username tidak ditemukan, tampilkan pesan error
        $error = "Username salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="utf-8" />
  <title>servD</title>
  <link rel="stylesheet" href="css/style-login.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" />
</head>
<body>
  <div id="login">
    <form action="" method="POST" name="form-login">
    <h2>Login</h2>
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <input type="text" class="input" id="username" name="username" placeholder="Username" />
        <input type="password" class="input" id="katasandi" name="katasandi" placeholder="Password" />
        <input type="submit" value="Login" class="submitbtn"> 
        <p>Belum memiliki akun? <a href="tambah_akun.php">Daftar Sekarang</a></p>

    </form>
  </div>
</body>
</html>
