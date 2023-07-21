<?php
include "../koneksi.php";
session_start();

if (isset($_SESSION["username"])) {
    // Menggunakan prepared statement untuk mencegah SQL injection
    $query = "SELECT pl.id_pelanggan, ak.id_user, pl.nama AS 'Nama Pelanggan', pl.alamat AS 'Alamat', pl.telepon AS 'Kontak', pl.email AS 'E-Mail', ak.username AS 'Nama User', ak.katasandi AS 'Password'
              FROM pelanggan pl
              JOIN akun ak ON pl.id_pelanggan = ak.id_pelanggan
              WHERE ak.username = ?";

    $stmt = mysqli_prepare($link, $query);
    $username = $_SESSION["username"];
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    if ($stmt) {
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Form untuk mengedit data client
?>
            <html>
            <head>
                <title>Edit Informasi Client</title>
                <link rel="stylesheet" href="css/styleInput.css">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
                <!--<link rel="stylesheet" href="../css/style-sidebar.css">-->
            </head>
            <body>
                <div class="container">
                    <?php include "menu2.php" ?>
                    <div class="main-content-card">
                        <h2>Edit Data Client</h2>
                        <br>
                        <div class="main">
                            <div class="grid-container" id="grid-container-dalamProses">
                                <form action="update_client.php" method="POST" name="form-login" class="form-input">
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
                                    <label for="katasandi">Password:</label>
                                    <input type="text" name="katasandi" id="katasandi" value="<?php echo $row['Password']; ?>"><br>
                                    <div class="button-section">
                                        <button type="submit" class="button-62" role="button">Update</button>
                                        <button type="reset" class="button-62-red" role="button">Reset</button>
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
            echo "Data client tidak ditemukan.";
        }
    } else {
        echo "Terjadi kesalahan dalam eksekusi prepared statement.";
    }
} else {
    // Jika user tidak login, maka arahkan ke halaman login atau lakukan tindakan lain sesuai kebutuhan Anda.
    header("Location: ../index.php");
    exit(); // Hentikan eksekusi skrip setelah melakukan redirect.
}
?>
