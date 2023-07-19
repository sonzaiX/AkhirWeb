<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $idPerbaikan = $_GET['id'];

    // Mengambil data perbaikan berdasarkan ID
    $query = "SELECT Perbaikan.id_perbaikan, Device.id_device, Pelanggan.nama AS 'Nama Pelanggan', Device.merek AS 'Merek Device', Device.model AS 'Model Device', Device.tipe AS 'Tipe Device', Device.deskripsi AS 'Deskripsi Device', Device.sn AS 'Serial Number'
              FROM Pelanggan 
              JOIN Perbaikan ON Pelanggan.id_pelanggan = Perbaikan.id_pelanggan
              JOIN Device ON Perbaikan.id_device = Device.id_device 
              WHERE Perbaikan.id_perbaikan = ?";
    
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $idPerbaikan);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Form untuk mengedit data perbaikan
        ?>
        <html>
        <head>
            <title>Edit Data Perbaikan</title>
            <link rel="stylesheet" href="css/style-sidebar.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        </head>
        <body>
            <div class="container">
                <?php include "menu2.php" ?>
                <div class="main-content-card">
                    <h2>Edit Data Perbaikan</h2>
                    <br>
                    <div class="main">
                        <div class="grid-container" id="grid-container-dalamProses">
                            <form action="update_laptop.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id_device']; ?>">
                                <label for="merek">Merek Device:</label>
                                <input type="text" name="merek" id="merek" value="<?php echo $row['Merek Device']; ?>"><br>
                                <label for="model">Model Device:</label>
                                <input type="text" name="model" id="model" value="<?php echo $row['Model Device']; ?>"><br>
                                <label for="tipe">Tipe Device:</label>
                                <input type="text" name="tipe" id="tipe" value="<?php echo $row['Tipe Device']; ?>"><br>
                                <label for="sn">Serial Number:</label>
                                <input type="text" name="sn" id="sn" value="<?php echo $row['Serial Number']; ?>"><br>
                                <label for="deskripsi">Deskripsi Device:</label>
                                <textarea name="deskripsi" id="deskripsi"><?php echo $row['Deskripsi Device']; ?></textarea><br>
                                <div>
                                    <input type="submit" value="Update">
                                    <input type="reset" value="Reset">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Data perbaikan tidak ditemukan.";
    }
} else {
    echo "ID perbaikan tidak diberikan.";
}
?>
