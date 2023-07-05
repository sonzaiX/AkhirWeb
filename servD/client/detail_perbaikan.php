<?php
    include "../koneksi.php";
    session_start();

    if (isset($_SESSION["username"])) {
        // Menggunakan prepared statement untuk mencegah SQL injection
        $query = "SELECT pl.username AS 'Username', d.merek AS 'Merek Device', d.model AS 'Model Device', d.SN AS 'Serial Number', p.status AS 'Status Perbaikan', p.desk_kerusakan AS 'Deskripsi Kerusakan', p.tanggal_masuk AS 'Tanggal Masuk'
        FROM Pelanggan pl
        JOIN Perbaikan p ON pl.id_user = p.id_user
        JOIN Device d ON p.id_device = d.id_device
        WHERE pl.username = ?";

        $stmt = mysqli_prepare($link, $query);
        $username = $_SESSION["username"];
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        
        // Memeriksa keberhasilan eksekusi prepared statement
        if ($stmt) {
            $result = mysqli_stmt_get_result($stmt);

            // Memeriksa apakah terdapat hasil data
            if (mysqli_num_rows($result) > 0) {
                // Tampilkan data
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <br><br>
                    <div class="card">
                        <div class="card-header"><?php echo $row['Username']; ?></div>
                        <div class="card-content">
                            <p><strong>Merek Device:</strong> <?php echo $row['Merek Device']; ?></p>
                            <p><strong>Model Device:</strong> <?php echo $row['Model Device']; ?></p>
                            <p><strong>Serial Number:</strong> <?php echo $row['Serial Number']; ?></p>
                            <p><strong>Deskripsi Kerusakan:</strong> <?php echo $row['Deskripsi Kerusakan']; ?></p>
                            <p><strong>Status Perbaikan:</strong> <?php echo $row['Status Perbaikan']; ?></p>
                            <p><strong>Tanggal Masuk:</strong> <?php echo $row['Tanggal Masuk']; ?></p>
                        </div>
                        <a href="tambah_perbaikan.php">Tambah Laptop untuk Diperbaiki</a>
                    </div>
                <?php }
            
            } else {
                echo "<br><br><strong>Belum ada data perbaikan.";
            }
        } else {
            echo "Terjadi kesalahan dalam eksekusi prepared statement.";
        }
    } else {
        // Jika user tidak login, maka arahkan ke halaman login atau lakukan tindakan lain sesuai kebutuhan Anda.
        header("Location: login.php");
        exit(); // Hentikan eksekusi skrip setelah melakukan redirect.
    }
?>