<?php
    include "../koneksi.php";
    if (isset($_GET['id'])) {
        $id_berita = $_GET['id'];
    } else {
        die ("Error. No Id Selected! ");
    }
?>
<html>
    <head><title>Delete Berita</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <?php //include "header.php";
            include "menu.php"; ?>
        <?php
        //proses delete berita
        if (!empty($id_berita) && $id_berita != "") {
            $query = "DELETE FROM berita WHERE id_berita='$id_berita'";
            $sql = mysqli_query ($link,$query);
                if ($sql) {
                    echo "<h2><font color=blue>Berita telah berhasil
                    dihapus</font></h2>";
                } else {
                    echo "<h2><font color=red>Berita gagal dihapus</font></h2>";
                }
            echo "Klik <a href='index.php'>di sini</a> untuk kembali ke halaman arsip berita";
        } else {
            die ("Access Denied");
        }

        //include "footer.php"; ?>
    </body>
</html>
