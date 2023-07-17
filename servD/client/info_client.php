<?php
include "../koneksi.php";
session_start();

if (isset($_SESSION["username"])) {
    // Menggunakan prepared statement untuk mencegah SQL injection
    
    $query = "SELECT pl.id_pelanggan, ak.id_user, pl.nama AS 'Nama Pelanggan', pl.alamat AS 'Alamat', pl.telepon AS 'Kontak', pl.email AS 'E-Mail', ak.username AS 'Nama User'
          FROM pelanggan pl
          JOIN akun ak ON pl.id_pelanggan = ak.id_pelanggan
          WHERE ak.username = ?";

    $stmt = mysqli_prepare($link, $query);
    $username = $_SESSION["username"];
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    if ($stmt) {
        $result = mysqli_stmt_get_result($stmt); ?>

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
        <div class="main-content-card">
            <h2>Informasi Akun Anda</h2>
            <br>
            <div class="main">
            <div class="grid-container" id="grid-container-dalamProses">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
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
                    <br>
                    
                <?php } ?>
            </div>
            </div>
        </div>
        </div>
</div>    
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
</style>
</html>

<?php
    } else {
        echo "Terjadi kesalahan dalam eksekusi prepared statement.";
    }
} else {
    // Jika user tidak login, maka arahkan ke halaman login atau lakukan tindakan lain sesuai kebutuhan Anda.
    header("Location: login.php");
    exit(); // Hentikan eksekusi skrip setelah melakukan redirect.
}
?>