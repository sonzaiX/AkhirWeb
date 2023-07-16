<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $idPerbaikan = $_GET['id'];

    // Menghapus data perbaikan berdasarkan ID
    $query = "DELETE FROM Perbaikan WHERE id_perbaikan = ?";
    
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $idPerbaikan);
    mysqli_stmt_execute($stmt);

    // Periksa keberhasilan penghapusan
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Data perbaikan berhasil dihapus.";
    } else {
        echo "Gagal menghapus data perbaikan.";
    }
} else {
    echo "ID perbaikan tidak diberikan.";
}
?>
