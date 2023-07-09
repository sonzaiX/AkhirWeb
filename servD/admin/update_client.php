<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUser = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Update data client dalam database
    $query = "UPDATE Pelanggan SET nama = ?, alamat = ?, NomorKontak = ?, Email = ?, username = ? WHERE id_user = ?";
    
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "sssssi", $nama, $alamat, $kontak, $email, $username, $idUser);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<script> alert('Data telah berhasil diedit'); window.location ='info_client.php';</script>";
    } else {
        echo "Terjadi kesalahan saat memperbarui data client.";
    }
}
?>
