<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua field telah diisi
    if (!empty($_POST['id']) && !empty($_POST['merek']) && !empty($_POST['model']) && !empty($_POST['tipe']) && isset($_POST['deskripsi']) && isset($_POST['sn'])) {
        $iddevice = $_POST['id'];
        $merekDevice = $_POST['merek'];
        $modelDevice = $_POST['model'];
        $tipeDevice = $_POST['tipe'];
        $serialNumber = $_POST['sn'];
        $deskripsiDevice = $_POST['deskripsi'];

        // Update data perbaikan
        $query = "UPDATE device
                  SET merek = ?, model = ?, tipe = ?, deskripsi = ?, sn = ?
                  WHERE id_device = ?";
        
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "sssssi", $merekDevice, $modelDevice, $tipeDevice, $deskripsiDevice, $serialNumber, $iddevice);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script> alert('Data telah berhasil diedit'); window.location ='detail_perangkat.php';</script>";
        } else {
            echo "Terjadi kesalahan dalam memperbarui data perbaikan.";
        }
    } else {
        echo "Silakan lengkapi semua field.";
    }
} else {
    echo "Metode permintaan tidak valid.";
}
?>
