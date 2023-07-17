<?php
include "../koneksi.php";

$query = "SELECT Pelanggan.nama AS 'Nama Pelanggan', Device.merek AS 'Merek Device', Device.model AS 'Model Device', Device.tipe AS 'Tipe Device', Perbaikan.desk_kerusakan AS 'Deskripsi Kerusakan', Perbaikan.status AS 'Status Perbaikan', Perbaikan.perangkat_masuk AS 'Tanggal Masuk', Perbaikan.estimasi_selesai AS 'Estimasi'
FROM Pelanggan
JOIN Perbaikan ON Pelanggan.id_pelanggan = Perbaikan.id_pelanggan
JOIN Device ON Perbaikan.id_device = Device.id_device
WHERE Perbaikan.status = 'Selesai'
ORDER BY Pelanggan.nama ASC";


$sql = mysqli_query($link, $query);
?>

<html>
<head>
    <title>Dalam Proses</title>
    <link rel="stylesheet" href="css/style-sidebar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <?php include "menu2.php" ?>
        <div class="main-content-card">
            <h2>Riwayat Perbaikan</h2>
            <br>
            <div class="main">
            <div class="grid-container" id="grid-container-dalamProses">
                <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                    <div class="card">
                <div class="card-header"><?php echo $row['Nama Pelanggan']; ?></div>
                <div class="card-content">
                    <p><strong>Merek Device:</strong> <?php echo $row['Merek Device']; ?></p>
                    <p><strong>Model Device:</strong> <?php echo $row['Model Device']; ?></p>
                    <p><strong>Tipe Device:</strong> <?php echo $row['Tipe Device']; ?></p>
                    <p><strong>Deskripsi Kerusakan:</strong> <?php echo $row['Deskripsi Kerusakan']; ?></p>
                    <p><strong>Status Perbaikan:</strong> <?php echo $row['Status Perbaikan']; ?></p>
                    <p><strong>Tanggal Masuk:</strong> <?php echo $row['Tanggal Masuk']; ?></p>
                    <p><strong>Tanggal Selesai:</strong> <?php echo $row['Estimasi']; ?></p>
                </div>
            </div>
                    
                <?php } ?>
            </div>
            </div>
        </div>
        </div>
</div>    

    </body>
<script src="javascript/script.js"></script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
</style>
</html>
