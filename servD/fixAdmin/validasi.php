<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai id_perbaikan dari form
    $idPerbaikan = $_POST["id_perbaikan"];

    // Update status perbaikan menjadi "Dalam Proses"
    $queryUpdate = "UPDATE Perbaikan SET status = 'Dalam Proses' WHERE id_perbaikan = ?";
    $stmtUpdate = mysqli_prepare($link, $queryUpdate);
    mysqli_stmt_bind_param($stmtUpdate, "i", $idPerbaikan);
    $resultUpdate = mysqli_stmt_execute($stmtUpdate);

    if ($resultUpdate) {
        echo "<script> alert('Data telah berhasil diedit'); window.location ='index.php';</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat mengubah status perbaikan.";
    }
}

$query = "SELECT Pelanggan.nama AS 'Nama Pelanggan', Device.merek AS 'Merek Device', Device.model AS 'Model Device', Device.tipe AS 'Tipe Device', Perbaikan.desk_kerusakan AS 'Deskripsi Kerusakan', Perbaikan.status AS 'Status Perbaikan', Perbaikan.tanggal_masuk AS 'Tanggal Masuk', Perbaikan.id_perbaikan
FROM Pelanggan
JOIN Perbaikan ON Pelanggan.id_user = Perbaikan.id_user
JOIN Device ON Perbaikan.id_device = Device.id_device
WHERE Perbaikan.status = 'Tertunda'
ORDER BY Pelanggan.nama ASC";

$sql = mysqli_query($link, $query);
?>

<html>
<head>
    <title>Data Perbaikan</title>
    <link rel="stylesheet" href="style.css">
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

    <h2>Data Perbaikan yang belum di Setujui</h2>
    <br>
    <div class="grid-container" id="grid-container-dalamProses">
        <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
            <div class="card">
                <div class="card-header"><?php echo $row['Nama Pelanggan']; ?></div>
                <div class="card-content">
                    <p><strong>Merek Device:</strong> <?php echo $row['Merek Device']; ?></p>
                    <p><strong>Model Device:</strong> <?php echo $row['Model Device']; ?></p>
                    <p><strong>Tipe Device:</strong> <?php echo $row['Tipe Device']; ?></p>
                    <p><strong>Deskripsi Kerusakan:</strong> <?php echo $row['Deskripsi Kerusakan']; ?></p>
                    <p><strong>Status Perbaikan:</strong> <?php echo $row['Status Perbaikan']; ?></p>
                    <p><strong>Tanggal Masuk:</strong> <?php echo $row['Tanggal Masuk']; ?></p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" name="id_perbaikan" value="<?php echo $row['id_perbaikan']; ?>">
                        <input type="submit" value="Setujui">
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
    <br><br>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
</style>
</html>
