<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua field telah diisi
    if (!empty($_POST['nama']) && !empty($_POST['alamat']) && !empty($_POST['nomorkontak']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['katasandi'])) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $nomorKontak = $_POST['nomorkontak'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $katasandi = $_POST['katasandi'];

        // Cek apakah username sudah digunakan sebelumnya
        $query = "SELECT * FROM Pelanggan WHERE username = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<script> alert('Username sudah digunakan.'); window.location ='index.php';</script>";
        } else {
            // Tambahkan akun ke dalam tabel Pelanggan
            $query = "INSERT INTO Pelanggan (nama, alamat, nomorkontak, email, username, katasandi, peran) VALUES (?, ?, ?, ?, ?, ?, 'biasa')";
            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, "ssssss", $nama, $alamat, $nomorKontak, $email, $username, $katasandi);
            mysqli_stmt_execute($stmt);

            // Periksa keberhasilan penambahan akun
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<script> alert('Akun telah berhasil ditambahkan'); window.location ='index.php';</script>";
                exit();
            } else {
                echo "<script> alert('Terjadi kesalahan dalam menambahkan akun'); window.location ='index.php';</script>";
                exit();
            }
        }
    } else {
        echo "<script> alert('Silakan lengkapi semua field.'); window.location ='index.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="utf-8" />
  <title>Tambah Akun</title>
  <link rel="stylesheet" href="style-login.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" />
</head>
<body>
  <div id="login">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="form-login">
        <h2>Tambah Akun</h2>
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <input type="text" name="nama" id="nama" placeholder="Nama" required>
        <input type="text" name="alamat" id="alamat" placeholder="Alamat" required>
        <input type="text" name="nomorkontak" id="nomorkontak" placeholder="Nomor Kontak" required>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="text" name="username" id="username" placeholder="Username" required>
        <input type="password" name="katasandi" id="katasandi" placeholder="Kata Sandi" required>
        <input type="submit" value="Tambah Akun" class="submitbtn"> 
    </form>
  </div>
</body>
</html>
