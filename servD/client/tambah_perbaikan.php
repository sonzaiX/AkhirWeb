<?php
include "../koneksi.php";
session_start();

if (isset($_SESSION["username"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form
        $merek = $_POST["merek"];
        $model = $_POST["model"];
        $sn = $_POST["sn"];
        $deskripsi = $_POST["deskripsi"];

        // Validasi dan lakukan operasi tambah laptop

        // Simpan data ke database
        $query = "INSERT INTO Device (merek, model, SN, deskripsi) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $merek, $model, $sn, $deskripsi);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Redirect ke halaman detail laptop setelah sukses tambah laptop
            header("Location: detail_laptop.php");
            exit();
        } else {
            echo "Terjadi kesalahan saat menambah laptop.";
        }
    }
} else {
    // Jika user tidak login, maka arahkan ke halaman login atau lakukan tindakan lain sesuai kebutuhan Anda.
    header("Location: login.php");
    exit(); // Hentikan eksekusi skrip setelah melakukan redirect.
}
?>

<html>
<head>
    <?php //include "header.php";
        include "menu.php"; ?>
    <title>Tambah Laptop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tambah Laptop</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="merek">Merek Device:</label>
        <input type="text" name="merek" id="merek" required><br>
        <label for="model">Model Device:</label>
        <input type="text" name="model" id="model" required><br>
        <label for="sn">Serial Number:</label>
        <input type="text" name="sn" id="sn" required><br>
        <label for="deskripsi">Deskripsi Device:</label>
        <textarea name="deskripsi" id="deskripsi" required></textarea><br>
        <input type="submit" value="Tambah">
    </form>
</body>
</html>
