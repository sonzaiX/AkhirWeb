<?php
include "../koneksi.php";
session_start();

if (isset($_SESSION["username"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form
        $merek = $_POST["merek"];
        $model = $_POST["model"];
        $tipe = $_POST["tipe"];
        $sn = $_POST["sn"];
        $deskripsi = $_POST["deskripsi"];
        $desk_kerusakan = $_POST["desk_kerusakan"];

        // Ambil ID user yang sedang login dari session
        $username = $_SESSION["username"];

        // Ambil ID user berdasarkan username
        $queryUser = "SELECT id_user FROM Pelanggan WHERE username = ?";
        $stmtUser = mysqli_prepare($link, $queryUser);
        mysqli_stmt_bind_param($stmtUser, "s", $username);
        mysqli_stmt_execute($stmtUser);
        $resultUser = mysqli_stmt_get_result($stmtUser);

        // Memeriksa apakah terdapat hasil data
        if (mysqli_num_rows($resultUser) == 1) {
            $rowUser = mysqli_fetch_assoc($resultUser);
            $idUser = $rowUser['id_user'];

            // Simpan data ke tabel Device
            $query1 = "INSERT INTO Device (merek, model, tipe, SN, deskripsi) VALUES (?, ?, ?, ?, ?)";
            $stmt1 = mysqli_prepare($link, $query1);
            mysqli_stmt_bind_param($stmt1, "sssss", $merek, $model, $tipe, $sn, $deskripsi);
            $result1 = mysqli_stmt_execute($stmt1);

            if ($result1) {
                // Dapatkan ID data yang baru saja disimpan di tabel Device
                $deviceID = mysqli_insert_id($link);

                // Simpan data ke tabel Perbaikan dengan nilai id_user yang sudah didapatkan
                $query2 = "INSERT INTO Perbaikan (id_user, id_device, desk_kerusakan, status, tanggal_masuk) VALUES (?, ?, ?, 'Tertunda', NOW())";
                $stmt2 = mysqli_prepare($link, $query2);
                mysqli_stmt_bind_param($stmt2, "iis", $idUser, $deviceID, $desk_kerusakan);
                $result2 = mysqli_stmt_execute($stmt2);

                if ($result2) {
                    // Redirect atau tampilkan pesan sukses setelah selesai menyimpan data di kedua tabel
                    header("Location: detail_laptop.php");
                    exit();
                } else {
                    echo "Terjadi kesalahan saat menambah data ke tabel Perbaikan.";
                }
            } else {
                echo "Terjadi kesalahan saat menambah data ke tabel Device.";
            }
        } else {
            echo "User tidak ditemukan.";
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
    <title>Tambah Laptop</title>
    <link rel="stylesheet" href="css/styleInput.css">
    <?php include "menu.php"; ?>
</head>
<body>
    <div id="formInput">
    <h2>Tambah Laptop</h2>
    <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="form-login">
            <label for="merek">Merek Device:</label>
            <input type="text" name="merek" id="merek" required class="formtambah"><br>
            <label for="model">Model Device:</label>
            <input type="text" name="model" id="model" required class="formtambah"><br>
            <label for="tipe">Tipe Device:</label>
            <input type="text" name="tipe" id="tipe" required class="formtambah"><br>
            <label for="sn">Serial Number:</label>
            <input type="text" name="sn" id="sn" required class="formtambah"><br>
            <label for="deskripsi">Deskripsi Device:</label>
            <textarea name="deskripsi" id="deskripsi" required class="formtambah"></textarea><br>
            <label for="desk_kerusakan">Deskripsi Kerusakan:</label>
            <textarea name="desk_kerusakan" id="desk_kerusakan" required class="formtambah"></textarea><br>
            <input type="submit" value="Tambah" class="submitbtn">
        </form>
    </div>
</body>
</html>