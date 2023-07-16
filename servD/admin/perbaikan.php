<?php
include "../koneksi.php";

// Proses perubahan status dan tanggal estimasi selesai
if (isset($_POST['submit'])) {
    $idPerbaikan = $_POST['id_perbaikan'];
    $status = $_POST['status'];
    $estimasiSelesai = $_POST['Estimasi'];

    // Update status dan estimasi selesai ke dalam tabel
    $query = "UPDATE Perbaikan SET status = '$status', estimasi = '$estimasiSelesai' WHERE id_perbaikan = '$idPerbaikan'";
    $sql = mysqli_query($link, $query);

    if ($sql) {
        echo "<script> alert('Status dan tanggal estimasi selesai telah diperbarui');
        window.location = 'index.php';</script>";
    } else {
        echo "<h2><font color=red>Gagal memperbarui status dan tanggal estimasi selesai</font></h2>";
    }
}

$query = "SELECT Pelanggan.nama AS 'Nama Pelanggan', Device.merek AS 'Merek Device', Device.model AS 'Model Device', Device.tipe AS 'Tipe Device', Perbaikan.desk_kerusakan AS 'Deskripsi Kerusakan', Perbaikan.status AS 'Status Perbaikan', Perbaikan.tanggal_masuk AS 'Tanggal Masuk', Perbaikan.id_perbaikan, Perbaikan.estimasi AS 'Estimasi'
FROM Pelanggan
JOIN Perbaikan ON Pelanggan.id_user = Perbaikan.id_user
JOIN Device ON Perbaikan.id_device = Device.id_device
where Perbaikan.status != 'Selesai'
ORDER BY Pelanggan.nama ASC";

$sql = mysqli_query($link, $query);
?>

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

    <h2>Data Perangkat yang dalam Perbaikan</h2>
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
                    <p><strong>Tanggal Selesai:</strong> <?php echo $row['Estimasi']; ?></p>
                    <form action="" method="POST">
                        <input type="hidden" name="id_perbaikan" value="<?php echo $row['id_perbaikan']; ?>">
                        <label for="status">Ubah Status:</label>
                        <select name="status" id="status">
                            <option value="Dalam Proses">Dalam Proses</option>
                            <option value="Tertunda">Tertunda</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                        <br><br>
                        
                        <label for="Estimasi">Tanggal Estimasi Selesai:</label>
                        <input type="date" name="Estimasi" id="Estimasi">
                        <br><br>
                        <input type="submit" name="submit" value="Submit">
                        <input type="reset" value="Reset">
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
