<?php
    include "../koneksi.php";
    session_start();

    if (isset($_SESSION["username"])) {
        // Menggunakan prepared statement untuk mencegah SQL injection
        $query = "SELECT ak.username AS 'Username', pl.nama AS 'Nama Pelanggan', dev.merek AS 'Merek Device',dev.tipe AS 'Tipe Device', dev.model AS 'Model Device', dev.sn AS 'Serial Number', per.status AS 'Status Perbaikan', per.desk_kerusakan AS 'Deskripsi Kerusakan', per.perangkat_masuk AS 'Tanggal Masuk', per.estimasi_selesai AS 'Tanggal Selesai'
        FROM pelanggan pl
        JOIN akun ak ON pl.id_pelanggan = ak.id_pelanggan
        JOIN perbaikan per ON pl.id_pelanggan = per.id_pelanggan
        JOIN device dev ON per.id_device = dev.id_device
        WHERE ak.username = ?";

        $stmt = mysqli_prepare($link, $query);
        $username = $_SESSION["username"];
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        
        // Memeriksa keberhasilan eksekusi prepared statement
        if ($stmt) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) { ?>

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
            <h2>Data Perbaikan yang Masih dalam Proses</h2>
            <br>
            <div class="main">
            <div class="grid-container" id="grid-container-dalamProses">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="card">
                        <div class="card-header"><?php echo $row['Nama Pelanggan']; ?></div>
                        <div class="card-content">
                            <p><strong>Merek Device:</strong> <?php echo $row['Merek Device']; ?></p>
                            <p><strong>Model Device:</strong> <?php echo $row['Model Device']; ?></p>
                            <p><strong>Tipe Device:</strong> <?php echo $row['Tipe Device']; ?></p>
                            <p><strong>Serial Number:</strong> <?php echo $row['Serial Number']; ?></p>
                            <p><strong>Deskripsi Kerusakan:</strong> <?php echo $row['Deskripsi Kerusakan']; ?></p>
                            <p><strong>Status Perbaikan:</strong> <?php echo $row['Status Perbaikan']; ?></p>
                            <p><strong>Tanggal Masuk:</strong> <?php echo $row['Tanggal Masuk']; ?></p>
                            <p><strong>Estimasi Selesai:</strong> <?php echo $row['Tanggal Selesai']; ?></p>
                        </div>
                        
                        </div>
                    
                <?php } ?>
                
            </div>
            
            </div>
           
<div style="text-align: center; display: flex;">
    <a href="tambah_perbaikan.php"><button type="button" class="button-62" role="button">Tambah</button></a>
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

<?php } else { ?>
                
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
            <h2>Belum ada data Perbaikan</h2>
            <div class="main">
            <br>
            <div class="button-section">
                <a href="tambah_perbaikan.php">Tambah Laptop untuk Diperbaiki</a>
            </div>
            </div>
            </div>
        </div>
 
        </body>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
        </style>
        </html> 

                <?php }
        } else {
            echo "Terjadi kesalahan dalam eksekusi prepared statement.";
        }
    } else {
        // Jika user tidak login, maka arahkan ke halaman login atau lakukan tindakan lain sesuai kebutuhan Anda.
        header("Location: ../index.php");
        exit(); // Hentikan eksekusi skrip setelah melakukan redirect.
    }
?>