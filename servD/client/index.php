<?php
    include "../koneksi.php";
    session_start();
    
    $username = $_SESSION["username"];

    if (isset($_SESSION["username"])) { ?>
        <!DOCTYPE html>
        <html>
            <head>
            <title>Data Perbaikan</title>
            <link rel="stylesheet" href="css/style-sidebar.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
            <!--<link rel="stylesheet" href="../css/style-sidebar.css">-->
            </head>
            <body>
            <div class="container">
            <?php include "menu2.php" ?>
                <div class="main-content">
                <section>
                <div class="main">
                    <div class="detail">
                        <h1><span>Hi, Selamat Datang <?php echo $username ?></span> <br> Kami Kelompok <span style="color:#00E8F8;">3</span></h1>
                        <p>Ini adalah website manajemen perbaikan <br> perangkat komputer </p>
                        <div class="social">
                            <a href="#"><i class="bi bi-github"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <br>
                        </div>
                    </div>
                    <div class="images">
                        <img src="assets/newIcon/us.jpg" alt="" width="100%">
                    </div>
                </div>
            </section>
                </div>
                </div>
            </div>
            </body>
            
            <script src="javascript/script.js"></script>
            <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
        </style>
        </html>

    <?php } else {
        // Jika user tidak login, maka arahkan ke halaman login atau lakukan tindakan lain sesuai kebutuhan Anda.
        header("Location: ../index.php");
        exit(); // Hentikan eksekusi skrip setelah melakukan redirect.
    }
?>   