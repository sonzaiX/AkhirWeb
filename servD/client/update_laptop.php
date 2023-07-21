<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idDevice = $_POST['id'];
        $merekDevice = $_POST['merek'];
        $modelDevice = $_POST['model'];
        $tipeDevice = $_POST['tipe'];
        $serialNumber = $_POST['sn'];
        $deskripsiDevice = $_POST['deskripsi'];

        // Update data perbaikan
        $query = "UPDATE Device SET merek = ?, model = ?, tipe = ?, deskripsi = ?, sn = ? WHERE id_device = ?";
        
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "sssssi", $merekDevice, $modelDevice, $tipeDevice, $deskripsiDevice, $serialNumber, $idDevice);
        mysqli_stmt_execute($stmt);

        // Periksa keberhasilan update
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script> alert('Data telah berhasil diupdate'); window.location ='detail_perangkat.php';</script>";
        } else {
            echo "<script> alert('Terjadi kesalahan dalam memperbarui data'); window.location ='edit_laptop.php?id=$idDevice';</script>";
        }
} else {
    echo "Metode permintaan tidak valid.";
}
?>
