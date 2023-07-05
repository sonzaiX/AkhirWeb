<?php
    include "../koneksi.php";

    $query = "SELECT id_user, nama AS 'Nama Pelanggan',alamat AS 'Alamat',NomorKontak AS 'Kontak',Email AS 'E-Mail', username AS 'Nama User' from Pelanggan where peran ='biasa' ORDER BY nama ASC";

    $sql = mysqli_query($link, $query);
?>

<html>
<head>
    <?php //include "header.php";
        include "menu.php";?>
    <title>Informasi Client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Detail Client</h2>
    <div class="grid-container">
        <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
            <div class="card">
                <div class="card-header"><?php echo $row['Nama Pelanggan']; ?></div>
                <div class="card-content">
                    <p><strong>Alamat:</strong> <?php echo $row['Alamat']; ?></p>
                    <p><strong>Kontak:</strong> <?php echo $row['Kontak']; ?></p>
                    <p><strong>E-Mail:</strong> <?php echo $row['E-Mail']; ?></p>
                    <p><strong>Nama User:</strong> <?php echo $row['Nama User']; ?></p>
                    <a class="card-link" href="edit.php?id=<?php echo $row['id_user']; ?>">Edit</a>    |
                    <a class="card-link" href="hapus.php?id=<?php echo $row['id_user']; ?>">Hapus</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <br><br>
</body>
</html>
