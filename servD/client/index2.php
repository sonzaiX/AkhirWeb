<?php
    include "../koneksi.php";
    session_start();

    if (isset($_SESSION["username"])) {
        // Menggunakan prepared statement untuk mencegah SQL injection
        $query = "SELECT ak.username AS 'Username', pl.nama AS 'Nama Pelanggan', dv.merek AS 'Merek Device', dv.model AS 'Model Device', dv.sn AS 'Serial Number', pb.status AS 'Status Perbaikan', pb.desk_kerusakan AS 'Deskripsi Kerusakan', pb.perangkat_masuk AS 'Tanggal Masuk'
        FROM pelanggan pl
        JOIN akun ak ON pl.id_pelanggan = ak.id_pelanggan
        JOIN perbaikan pb ON pl.id_pelanggan = pb.id_pelanggan
        JOIN device dv ON pb.id_device = dv.id_device
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
                    <title>Data Perbaikan</title>
                    <link rel="stylesheet" href="css/style.css">
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

                <h2>Data Perbaikan (Belum Selesai)</h2>
                    <br>
                    <div class="grid-container" id="grid-container-dalamProses">
            
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="card">
                        <div class="card-header"><?php echo $row['Nama Pelanggan']; ?></div>
                        <div class="card-content">
                            <p><strong>Merek Device:</strong> <?php echo $row['Merek Device']; ?></p>
                            <p><strong>Model Device:</strong> <?php echo $row['Model Device']; ?></p>
                            <p><strong>Serial Number:</strong> <?php echo $row['Serial Number']; ?></p>
                            <p><strong>Deskripsi Kerusakan:</strong> <?php echo $row['Deskripsi Kerusakan']; ?></p>
                            <p><strong>Status Perbaikan:</strong> <?php echo $row['Status Perbaikan']; ?></p>
                            <p><strong>Tanggal Masuk:</strong> <?php echo $row['Tanggal Masuk']; ?></p>
                        </div>
                        <a href="tambah_perbaikan.php">Tambah Laptop untuk Diperbaiki</a>
                        </div>
                    <?php } ?>
                    </div>
            <br><br>
        </body>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
        </style>
        </html> 
            
            <?php } else { ?>
                
                <html>
                <head>
                    <title>Data Perbaikan</title>
                    <link rel="stylesheet" href="css/style.css">
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

                <h2>Belum ada data Perbaikan</h2>
                <br>
                <div style="text-align: center;">
                    <a href="tambah_perbaikan.php">Tambah Laptop untuk Diperbaiki</a>
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