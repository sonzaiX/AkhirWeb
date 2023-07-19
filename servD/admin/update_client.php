<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idUser = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Validasi input (contoh: memastikan tidak ada input kosong)
    if (empty($nama) || empty($alamat) || empty($kontak) || empty($email) || empty($username)) {
        echo "Semua field harus diisi.";
        exit;
    }

    // Escape input sebelum digunakan dalam query
    $nama = mysqli_real_escape_string($link, $nama);
    $alamat = mysqli_real_escape_string($link, $alamat);
    $kontak = mysqli_real_escape_string($link, $kontak);
    $email = mysqli_real_escape_string($link, $email);
    $username = mysqli_real_escape_string($link, $username);

    // Update data client dalam database
    $query = "UPDATE pelanggan SET nama = ?, alamat = ?, telepon = ?, email = ? WHERE id_pelanggan = ?";
    
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $nama, $alamat, $kontak, $email, $idUser);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<script> alert('Data telah berhasil diedit'); window.location ='info_client.php';</script>";
    } else {
        echo "Terjadi kesalahan saat memperbarui data client.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
?>
