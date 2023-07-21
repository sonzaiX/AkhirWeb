<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $idUser = $_GET['id'];

    // Mengambil data client berdasarkan ID
    $query = "SELECT P.id_pelanggan AS id_user, P.nama AS 'Nama Pelanggan', P.alamat AS 'Alamat',
                     P.telepon AS 'Kontak', P.email AS 'E-Mail', A.username AS 'Nama User' FROM pelanggan AS P
                    JOIN akun AS A ON P.id_pelanggan = A.id_pelanggan WHERE P.id_pelanggan = ?";
    
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
            <title>Edit Informasi Client</title>
            <link rel="stylesheet" href="css/style-sidebar.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        </head>
        <body>
            <div class="container">
                <?php include "menu2.php" ?>
                <div class="main-content-card">
                    <h2>Edit Data Client</h2>
                    <br>
                    <div class="main">
                        <div class="grid-container" id="grid-container-dalamProses" >
                           
                        <form action="update_client.php" method="POST" class="form-input">
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
                            <br>
                            <div class="button-section">
                                <button type="submit" class="button-62" role="button">Update</button>
                                <button type="reset" class="button-62-red" role="button">Reset</button>
                            </div>
                        </form>

                        </div>
                    </div>
                    <br>
                </div>
            </div>
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
