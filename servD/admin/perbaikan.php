<?php
include "../koneksi.php";

// Proses perubahan status dan tanggal estimasi selesai
if (isset($_POST['submit'])) {
    $idPerbaikan = $_POST['id_perbaikan'];
    $status = $_POST['status'];

    // Update status ke dalam tabel Perbaikan
    $query = "UPDATE Perbaikan SET status = ? WHERE id_perbaikan = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "si", $status, $idPerbaikan);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<script> alert('Status telah diperbarui');
        window.location = 'index.php';</script>";
    } else {
        echo "<h2><font color=red>Gagal memperbarui status</font></h2>";
    }
}

$query = "SELECT Pelanggan.nama AS 'Nama Pelanggan', Device.merek AS 'Merek Device', Device.model AS 'Model Device', Device.tipe AS 'Tipe Device', Perbaikan.desk_kerusakan AS 'Deskripsi Kerusakan', Perbaikan.status AS 'Status Perbaikan', Perbaikan.perangkat_masuk AS 'Tanggal Masuk', Perbaikan.estimasi_selesai AS 'Estimasi', Perbaikan.id_perbaikan
FROM Pelanggan
JOIN Perbaikan ON Pelanggan.id_pelanggan = Perbaikan.id_pelanggan
JOIN Device ON Perbaikan.id_device = Device.id_device
WHERE Perbaikan.status != 'Selesai'
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
            <h2>Data Perbaikan</h2>
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
                                <p><strong>Tanggal Masuk:</strong> <?php echo $row['Tanggal Masuk']; ?></p>
                                <p><strong>Tanggal Selesai:</strong> <?php echo $row['Estimasi']; ?></p><br>
                                <form action="" method="POST">
                                    <input type="hidden" name="id_perbaikan" value="<?php echo $row['id_perbaikan']; ?>">
                                    <label for="status">Ubah Status:</label>
                                    <select name="status" id="status" class="classic">
                                        <option value="Dalam Proses" <?php if ($row['Status Perbaikan'] == 'Dalam Proses') echo 'selected'; ?>>Dalam Proses</option>
                                        <option value="Tertunda" <?php if ($row['Status Perbaikan'] == 'Tertunda') echo 'selected'; ?>>Tertunda</option>
                                        <option value="Selesai" <?php if ($row['Status Perbaikan'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                                    </select>
                                    <br><br>
                                    <div class="button-section">
                                        <button type="submit" name="submit" class="button-62" role="button">Update</button>
                                        <button type="reset" class="button-62-red" role="button">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
</style>
</html>
