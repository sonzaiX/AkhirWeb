<!DOCTYPE html>
<html>
<head>
    <title>Tampilan Utama</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Tampilan Utama</h2>

            <?php if (isset($_SESSION["username"])) { ?>
                <p>Selamat datang, <?php echo $_SESSION["username"]; ?></p>
                <!-- Tampilkan informasi client lainnya sesuai kebutuhan -->
                <!-- Misalnya, menampilkan nama, alamat, nomor kontak, dll. -->
            <?php } else { ?>
                <p>Silakan login untuk melihat tampilan utama.</p>
            <?php } ?>

            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
</body>
</html>