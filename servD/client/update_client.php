<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUser = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['kontak'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Update data client dalam tabel pelanggan
    $queryPelanggan = "UPDATE pelanggan SET nama = ?, alamat = ?, telepon = ?, email = ? WHERE id_pelanggan = ?";
    
    $stmtPelanggan = mysqli_prepare($link, $queryPelanggan);
    mysqli_stmt_bind_param($stmtPelanggan, "ssssi", $nama, $alamat, $telepon, $email, $idUser);
    $resultPelanggan = mysqli_stmt_execute($stmtPelanggan);

    // Update data client dalam tabel akun
    $queryAkun = "UPDATE akun SET username = ? WHERE id_pelanggan = ?";
    
    $stmtAkun = mysqli_prepare($link, $queryAkun);
    mysqli_stmt_bind_param($stmtAkun, "si", $username, $idUser);
    $resultAkun = mysqli_stmt_execute($stmtAkun);

    if ($resultPelanggan && $resultAkun) {
        echo "<script> alert('Data telah berhasil diedit'); window.location ='info_client.php';</script>";
    } else {
        echo "Terjadi kesalahan saat memperbarui data client.";
    }
}
?>
