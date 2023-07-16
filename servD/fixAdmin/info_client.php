<?php
    include "../koneksi.php";

    $query = "SELECT id_user, nama AS 'Nama Pelanggan',alamat AS 'Alamat',NomorKontak AS 'Kontak',Email AS 'E-Mail', username AS 'Nama User' from Pelanggan where peran ='biasa' ORDER BY nama ASC";

    $sql = mysqli_query($link, $query);
?>

<html>
<head>
    <title>Informasi Client</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <?php include "menu.php"; ?>
</head>
<body>

<section>
        <div class="main">
            <div class="detail">
                <h1><span>Hi, Selamat Datang</span> <br> Kami Kelompok <span style="color:#00E8F8;">5</span></h1>
                <p>Ini adalah website perbaikan <br> perangkat komputer </p>
                <div class="social">
                    <a href="#"><i class="bi bi-github"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <br>
                </div>
            </div>
            <div class="images">
                <img src="us.jpg" alt="" width="100%">
            </div>
        </div>
    </section>

    <h2>Detail Client</h2>
    <br>
    <div class="grid-container" id="grid-container-dalamProses">
        <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
            <div class="card">
                <div class="card-header"><?php echo $row['Nama Pelanggan']; ?></div>
                <div class="card-content">
                    <p><strong>Alamat:</strong> <?php echo $row['Alamat']; ?></p>
                    <p><strong>Kontak:</strong> <?php echo $row['Kontak']; ?></p>
                    <p><strong>E-Mail:</strong> <?php echo $row['E-Mail']; ?></p>
                    <p><strong>Nama User:</strong> <?php echo $row['Nama User']; ?></p>
                    <form action="edit_client.php" method="GET" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id_user']; ?>">
                        <button type="submit">Edit</button>
                    </form>
                    <form action="hapus_client.php" method="GET" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id_user']; ?>">
                        <button type="submit">Hapus</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
    <br><br>
    </body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
</style>
</html>
