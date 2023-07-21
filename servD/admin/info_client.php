<?php
    include "../koneksi.php";

    $query = "SELECT p.id_pelanggan AS id_user, p.nama AS 'Nama Pelanggan', p.alamat AS 'Alamat', p.telepon AS 'Kontak', p.email AS 'E-Mail', a.username AS 'Nama User'
    FROM pelanggan AS p JOIN akun AS a ON p.id_pelanggan = a.id_pelanggan WHERE a.peran = 'biasa' ORDER BY p.nama ASC ";

    $sql = mysqli_query($link, $query);
?>

<html>
<head>
    <title>Informasi Client</title>
    <link rel="stylesheet" href="css/style-sidebar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<div class="container">
    <?php include "menu2.php" ?>
        <div class="main-content-card">
    <h2>Detail Client</h2>
    <br>
    <div class="main">
    <div class="grid-container" id="grid-container-dalamProses">
        <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
            <div class="card">
                <div class="card-header"><?php echo $row['Nama Pelanggan']; ?></div>
                <div class="card-content">
                    <p><strong>Alamat:</strong> <?php echo $row['Alamat']; ?></p>
                    <p><strong>Kontak:</strong> <?php echo $row['Kontak']; ?></p>
                    <p><strong>E-Mail:</strong> <?php echo $row['E-Mail']; ?></p>
                    <p><strong>Nama User:</strong> <?php echo $row['Nama User']; ?></p><br>
                    
                    <div class= "button-section">
                    <form action="edit_client.php" method="GET"">
                            <input type="hidden" name="id" value="<?php echo $row['id_user']; ?>">
                            <button type="submit" class="button-62" role="button">Edit</button>
                        </form>
                        <form action="hapus_client.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $row['id_user']; ?>">
                            <button type="submit" class="button-62-red" role="button">Hapus</button>
                        </form>
                    </div>
                       
                    </div>
                        </div>
                    <br>
                    
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
