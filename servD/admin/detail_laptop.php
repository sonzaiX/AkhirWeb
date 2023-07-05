<?php
    include "../koneksi.php";

    $query = "SELECT Perbaikan.id_perbaikan, Pelanggan.nama AS 'Nama Pelanggan', Device.merek AS 'Merek Device', Device.model AS 'Model Device', Device.tipe AS 'Tipe Device', Device.deskripsi AS 'Deskripsi Device'
    FROM Pelanggan
    JOIN Perbaikan ON Pelanggan.id_user = Perbaikan.id_user
    JOIN Device ON Perbaikan.id_device = Device.id_device
    ORDER BY Pelanggan.nama ASC";

    $sql = mysqli_query($link, $query);
?>

<html>
<head>
    <?php //include "header.php";
        include "menu.php"; ?>
    <title>Detail Laptop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Detail Laptop</h2>
    <div class="grid-container">
        <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
            <div class="card">
                <div class="card-header"><?php echo $row['Nama Pelanggan']; ?></div>
                <div class="card-content">
                    <p><strong>Merek Device:</strong> <?php echo $row['Merek Device']; ?></p>
                    <p><strong>Model Device:</strong> <?php echo $row['Model Device']; ?></p>
                    <p><strong>Tipe Device:</strong> <?php echo $row['Tipe Device']; ?></p>
                    <p><strong>Deskripsi Device:</strong> <?php echo $row['Deskripsi Device']; ?></p>
                    <a class="card-link" href="edit.php?id=<?php echo $row['id_perbaikan']; ?>">Edit</a>    |
                    <a class="card-link" href="hapus.php?id=<?php echo $row['id_perbaikan']; ?>">Hapus</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <br><br>
</body>
</html>
