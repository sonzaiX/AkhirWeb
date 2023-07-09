<html>
    <header>
        <style>
        header {
            padding: 1.7rem 1rem;
            background-color: #fff;
            display: flex;
            justify-content: space-between;
            max-width: 80%;
            margin: auto;
            align-items: left;
            background-color: blue;
        }

        .logo {
            font-size: 1.3rem;
            font-weight: 800;
        }

        .logo a {
            color: #fff;
            text-decoration: none;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-size: .97rem;
            font-weight: 600;
            letter-spacing: .7px;
            padding: 1rem;
            padding: 0.4rem 1rem;
        }

        nav a.active,
        nav a:hover {
            color: #00E8F8;
            border-radius: 1rem;
            transition: all.3s ease-in-out;
        }

        #click {
            display: none;
        }

        .menu i {
            color: #00E8F8;
        }

        .menu {
            display: none;
        }
        </style>


        <div class="logo">
            <a href="#">Logo.</a>
        </div>
        <input type="checkbox" id="click">
        <label for="click" class="mainicon">
            <div class="menu">
                <i class="bi bi-list"></i>
            </div>
        </label>
        <nav>
            <a href="index.php" class="active">Beranda</a>
            <a href="detail_laptop.php">Detail Laptop</a>
            <a href="info_client.php">Pelanggan</a>
            <a href="perbaikan.php">Perbaikan</a>
            <a href="riwayat_perbaikan.php">Riwayat</a>
            <a href="validasi.php">Validasi</a>
        </nav>
    </header>

</html>