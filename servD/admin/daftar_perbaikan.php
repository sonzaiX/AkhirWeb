<?php
    include "..\koneksi.php";
?>
<html>
    <head><title>Daftar Perbaikan</title>
        <link rel="stylesheet" href="style.css">
        <script language="javascript"> function tanya() {
            if (confirm ("Apakah Anda yakin akan menghapus berita ini ?")) {
                return true;
            } else { return false; }
        }
        </script>
    </head>
        <body>
        <br><br>
        <h2>Daftar Perbaikan</h2>
        <ol>
        <?php
            $query = "SELECT Pelanggan.nama AS 'Nama Pelanggan', Device.merek AS 'Merek Device', Device.model AS 'Model Device', Device.tipe AS 'Tipe Device', Perbaikan.desk_kerusakan AS 'Deskripsi Kerusakan', Perbaikan.status AS 'Status Perbaikan', Perbaikan.tanggal_masuk AS 'Tanggal Masuk'
            FROM Pelanggan
            JOIN Perbaikan ON Pelanggan.id_user = Perbaikan.id_user
            JOIN Device ON Perbaikan.id_device = Device.id_device
            WHERE Perbaikan.status = 'Dalam Proses'
            ORDER BY Pelanggan.nama ASC";
             
            $sql = mysqli_query ($link,$query);
            while ($hasil = mysqli_fetch_array($sql)) {
                $namaPelanggan = stripslashes($hasil['Nama Pelanggan']);
                $merekDevice = stripslashes($hasil['Merek Device']);
                $modelDevice = stripslashes($hasil['Model Device']);
                $tipeDevice = stripslashes($hasil['Tipe Device']);
                $deskripsiKerusakan = stripslashes($hasil['Deskripsi Kerusakan']);
                $statusPerbaikan = stripslashes($hasil['Status Perbaikan']);
                $tanggalMasuk = stripslashes($hasil['Tanggal Masuk']);
                
                echo "<tr>";
                echo "<td>$namaPelanggan</td>";
                echo "<td>$merekDevice</td>";
                echo "<td>$modelDevice</td>";
                echo "<td>$tipeDevice</td>";
                echo "<td>$deskripsiKerusakan</td>";
                echo "<td>$statusPerbaikan</td>";
                echo "<td>$tanggalMasuk</td>";
                echo "</tr>";
            }
        ?>
        </ol>
        </body>
</html>