<?php
include "../koneksi.php";
session_start();

if (isset($_SESSION["username"])) {
    // Menggunakan prepared statement untuk mencegah SQL injection
    $query = "SELECT pb.id_perbaikan, pl.nama AS 'Nama Pelanggan', dv.merek AS 'Merek Device', dv.model AS 'Model Device', dv.tipe AS 'Tipe Device', dv.sn AS 'Serial Number', dv.deskripsi AS 'Deskripsi Device'
    FROM pelanggan pl
    JOIN akun ak ON pl.id_pelanggan = ak.id_pelanggan
    JOIN perbaikan pb ON pl.id_pelanggan = pb.id_pelanggan
    JOIN device dv ON pb.id_device = dv.id_device
    WHERE ak.username = ?";



    $stmt = mysqli_prepare($link, $query);
    $username = $_SESSION["username"];
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    if ($stmt) {
        $result = mysqli_stmt_get_result($stmt);

        // Memeriksa apakah terdapat hasil data
       
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
            <h2>Detail Perangkat</h2>
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
                        <p><strong>Deskripsi Device:</strong> <?php echo $row['Deskripsi Device']; ?></p>
                        
                        <div class="button-section">
                        <!-- Menggunakan tombol Edit dan Hapus -->
                        <form action="edit_laptop.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $row['id_perbaikan']; ?>">
                            <button type="submit" class="button-62" role="button">Edit</button>
                        </form>
                        <form action="hapus_laptop.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $row['id_perbaikan']; ?>">
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

<?php
        
    } else {
        echo "Terjadi kesalahan dalam eksekusi prepared statement.";
    }
} else {
    // Jika user tidak login, maka arahkan ke halaman login atau lakukan tindakan lain sesuai kebutuhan Anda.
    header("Location: ../index.php");
    exit(); // Hentikan eksekusi skrip setelah melakukan redirect.
}
?>
