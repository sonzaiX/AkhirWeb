<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $idUser = $_GET['id'];

    // Mengambil data client berdasarkan ID
    $query = "SELECT id_user, nama AS 'Nama Pelanggan', alamat AS 'Alamat', NomorKontak AS 'Kontak', Email AS 'E-Mail', username AS 'Nama User' FROM Pelanggan WHERE id_user = ?";
    
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $idUser);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Form untuk mengedit data client
        ?>
        <html>
        <head>
            <?php include "menu.php"; ?>
            <title>Edit Data Client</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h2>Edit Data Client</h2>
            <form action="update_client.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id_user']; ?>">
                <label for="nama">Nama Pelanggan:</label>
                <input type="text" name="nama" id="nama" value="<?php echo $row['Nama Pelanggan']; ?>"><br>
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" id="alamat" value="<?php echo $row['Alamat']; ?>"><br>
                <label for="kontak">Kontak:</label>
                <input type="text" name="kontak" id="kontak" value="<?php echo $row['Kontak']; ?>"><br>
                <label for="email">E-Mail:</label>
                <input type="email" name="email" id="email" value="<?php echo $row['E-Mail']; ?>"><br>
                <label for="username">Nama User:</label>
                <input type="text" name="username" id="username" value="<?php echo $row['Nama User']; ?>"><br>
                <input type="submit" value="Update">
                <input type="reset" value="Reset">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Data client tidak ditemukan.";
    }
} else {
    echo "ID client tidak diberikan.";
}
?>
