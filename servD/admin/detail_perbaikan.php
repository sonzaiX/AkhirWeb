<?php
    include "../koneksi.php";

    $query = "SELECT Pelanggan.nama AS 'Nama Pelanggan', Device.merek AS 'Merek Device', Device.model AS 'Model Device', Device.tipe AS 'Tipe Device', Perbaikan.desk_kerusakan AS 'Deskripsi Kerusakan', Perbaikan.status AS 'Status Perbaikan', Perbaikan.tanggal_masuk AS 'Tanggal Masuk'
    FROM Pelanggan
    JOIN Perbaikan ON Pelanggan.id_user = Perbaikan.id_user
    JOIN Device ON Perbaikan.id_device = Device.id_device
    WHERE Perbaikan.status != 'Selesai'
    ORDER BY Pelanggan.nama ASC";

    $sql = mysqli_query($link, $query);
?>

<html>
<head>
    <title>Data Perbaikan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Perbaikan (Belum Selesai)</h2>
    <div class="grid-container">
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
                </div>
            </div>
        <?php } ?>
    </div>
    <br><br>
</body>
</html>
