<?php
include "../koneksi.php";
session_start();

if (isset($_SESSION["username"])) {
    // Menggunakan prepared statement untuk mencegah SQL injection

    $query = "SELECT Pelanggan.nama AS 'Nama Pelanggan', Device.merek AS 'Merek Device', Device.model AS 'Model Device', Device.tipe AS 'Tipe Device', Perbaikan.desk_kerusakan AS 'Deskripsi Kerusakan', Perbaikan.status AS 'Status Perbaikan', Perbaikan.tanggal_masuk AS 'Tanggal Masuk', Perbaikan.id_perbaikan, Perbaikan.estimasi AS 'Estimasi'
    FROM Pelanggan
    JOIN Perbaikan ON Pelanggan.id_user = Perbaikan.id_user
    JOIN Device ON Perbaikan.id_device = Device.id_device
    WHERE Pelanggan.username = ?";

    $stmt = mysqli_prepare($link, $query);
    $username = $_SESSION["username"];
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    if ($stmt) {
        $result = mysqli_stmt_get_result($stmt);

        // Memeriksa apakah terdapat hasil data
        if (mysqli_num_rows($result) > 0) {
    ?>

<html>

<head>
<?php //include 'header.php';
include 'menu.php'; ?>

    <title>Status Perbaikan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Riwayat</h2>
    <div class="grid-container">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card">
                <div class="card-header"><?php echo $row['Nama Pelanggan']; ?></div>
                <div class="card-content">
                    <p><strong>Merek Device:</strong> <?php echo $row['Merek Device']; ?></p>
                    <p><strong>Model Device:</strong> <?php echo $row['Model Device']; ?></p>
                    <p><strong>Tipe Device:</strong> <?php echo $row['Tipe Device']; ?></p>
                    <p><strong>Deskripsi Kerusakan:</strong> <?php echo $row['Deskripsi Kerusakan']; ?></p>
                    <p><strong>Status Perbaikan:</strong> <?php echo $row['Status Perbaikan']; ?></p>
                    <p><strong>Tanggal Masuk:</strong> <?php echo $row['Tanggal Masuk']; ?></p>
                    <p><strong>Tanggal Selesai:</strong> <?php echo $row['Estimasi']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
    <br><br>
</body>

</html>
<?php
        } else {
            echo "<br><br><strong>Belum ada data perbaikan.</strong>";
        }
    } else {
        echo "Terjadi kesalahan dalam eksekusi prepared statement.";
    }
} else {
    // Jika user tidak login, maka arahkan ke halaman login atau lakukan tindakan lain sesuai kebutuhan Anda.
    header("Location: login.php");
    exit(); // Hentikan eksekusi skrip setelah melakukan redirect.
}
?>
