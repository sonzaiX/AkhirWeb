<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai id_perbaikan dan estimasi dari form
    $idPerbaikan = $_POST["id_perbaikan"];
    $estimasiSelesai = $_POST["estimasi_selesai"];

    // Update estimasi selesai dan status ke dalam tabel Perbaikan
    $queryUpdate = "UPDATE Perbaikan SET estimasi_selesai = ?, status = 'Dalam Proses' WHERE id_perbaikan = ?";
    $stmtUpdate = mysqli_prepare($link, $queryUpdate);
    mysqli_stmt_bind_param($stmtUpdate, "si", $estimasiSelesai, $idPerbaikan);
    $resultUpdate = mysqli_stmt_execute($stmtUpdate);

    if ($resultUpdate) {
        echo "<script> alert('Estimasi selesai telah berhasil diubah'); window.location ='index.php';</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat mengubah estimasi selesai.";
    }
}

$query = "SELECT Pelanggan.nama AS 'Nama Pelanggan', Device.merek AS 'Merek Device', Device.model AS 'Model Device', Device.tipe AS 'Tipe Device', Perbaikan.desk_kerusakan AS 'Deskripsi Kerusakan', Perbaikan.status AS 'Status Perbaikan', Perbaikan.perangkat_masuk AS 'Tanggal Masuk', Perbaikan.estimasi_selesai AS 'Estimasi Selesai', Perbaikan.id_perbaikan
FROM Pelanggan
JOIN Perbaikan ON Pelanggan.id_pelanggan = Perbaikan.id_pelanggan
JOIN Device ON Perbaikan.id_device = Device.id_device
WHERE Perbaikan.status = 'Tertunda'
ORDER BY Pelanggan.nama ASC";

$sql = mysqli_query($link, $query);
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
            <h2>Data Perbaikan yang masih antri</h2>
            <br>
            <div class="main">
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
                    <p><strong>Tanggal Masuk:</strong> <?php echo $row['Tanggal Masuk']; ?></p><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" name="id_perbaikan" value="<?php echo $row['id_perbaikan']; ?>">
                        <label for="estimasi_selesai">Estimasi Selesai:</label>
                        <input type="date" name="estimasi_selesai" id="estimasi_selesai">
                        <input type="submit" value="Setujui">
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

</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
</style>
</html>
