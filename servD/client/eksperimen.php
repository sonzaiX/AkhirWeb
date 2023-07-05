<?php
    include "../koneksi.php";

    $query = "SELECT pl.username AS 'Username', d.merek AS 'Merek Device', d.model AS 'Model Device', d.SN AS 'Serial Number', p.status AS 'Status Perbaikan', p.desk_kerusakan AS 'Deskripsi Kerusakan', p.tanggal_masuk AS 'Tanggal Masuk'
        FROM Pelanggan pl
        JOIN Perbaikan p ON pl.id_user = p.id_user
        JOIN Device d ON p.id_device = d.id_device
        WHERE pl.username = 'admin'";

    $sql = mysqli_query($link, $query);
?>

<html>
    <head>
        <title>Data Perbaikan</title>
        <link rel="stylesheet" href="../admin/style.css">
    </head>
    <body>
        <h2>Data Perbaikan Anda</h2>
            <div class="grid-container">
                <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                    <div class="card">
                        <div class="card-header"><?php echo $row['Username']; ?></div>
                        <div class="card-content">
                            <p><strong>Merek Device:</strong> <?php echo $row['Merek Device']; ?></p>
                            <p><strong>Model Device:</strong> <?php echo $row['Model Device']; ?></p>
                            <p><strong>Serial Number:</strong> <?php echo $row['Serial Number']; ?></p>
                            <p><strong>Deskripsi Kerusakan:</strong> <?php echo $row['Deskripsi Kerusakan']; ?></p>
                            <p><strong>Status Perbaikan:</strong> <?php echo $row['Status Perbaikan']; ?></p>
                            <p><strong>Tanggal Masuk:</strong> <?php echo $row['Tanggal Masuk']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <br>
            <a href="tambah_perbaikan.php">Tambah Laptop untuk Diperbaiki</a>

        <br><br>
    </body>
    </html>