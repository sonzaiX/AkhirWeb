<html>
<head>
  <link rel="stylesheet" href="css/style-sidebar.css">
</head>
<body>
  <nav>
    <div class="sidebar-top">
      <span class="expand-btn">
        <img src="assets/chevron.svg" alt="Chevron">
      </span>
      <img src="assets/svd.svg" class="logo" alt="Laplace Logo">
      <h3 class="hide">ServD</h3>
    </div>
    <div class="sidebar-links">
      <ul>
        <li>
          <a href="index.php" class="<?php echo ($activeIndex === 0) ? 'active' : ''; ?>" title="Portfolio link">
            <div class="icon">
              <img src="assets/newIcon/Home.png" title="Portfolio Icon">
            </div>
            <span class="link hide">Beranda</span>
          </a>
        </li>
        <li>
          <a href="dalam_perbaikan.php" class="<?php echo ($activeIndex === 1) ? 'active' : ''; ?>" title="Analytics link">
            <div class="icon">
                <img src="assets/newIcon/perbaikan.png" title="Analytics Icon">
            </div>
            <span class="link hide">Dalam Perbaikan</span>
          </a>
        </li>
        <li>
          <a href="detail_perangkat.php" class="<?php echo ($activeIndex === 2) ? 'active' : ''; ?>" title="Performance link">
            <div class="icon">
                <img src="assets/newIcon/detail perangkat.png" title="Performance Icon">
            </div>
            <span class="link hide">Detail Perangkat</span>
          </a>
        </li>
         <li>
          <a href="info_client.php" class="<?php echo ($activeIndex === 3) ? 'active' : ''; ?>" title="Performance link">
            <div class="icon">
                <img src="assets/newIcon/info pelanggan.png" title="Performance Icon">
            </div>
            <span class="link hide">Informasi Pelanggan</span>
          </a>
        </li>
        <li>
          <a href="perbaikan.php" class="<?php echo ($activeIndex === 4) ? 'active' : ''; ?>" title="Reports Link">
            <div class="icon">
                <img src="assets/newIcon/perbaikan.png" title="Reports Icon">
            </div>
            <span class="link hide">Perbaikan</span>
          </a>
        </li>
        <li>
          <a href="riwayat_perbaikan.php" class="<?php echo ($activeIndex === 5) ? 'active' : ''; ?>" title="Reports Link">
            <div class="icon">
                <img src="assets/newIcon/riwayat.png" title="Reports Icon">
            </div>
            <span class="link hide">Riwayat</span>
          </a>
        </li>
        <li>
          <a href="validasi.php" class="<?php echo ($activeIndex === 6) ? 'active' : ''; ?>" title="Reports Link">
            <div class="icon">
                <img src="assets/newIcon/validasi.png" title="Reports Icon">
            </div>
            <span class="link hide">Validasi</span>
          </a>
        </li>
        <li>
          <a href="logout.php" class="<?php echo ($activeIndex === 7) ? 'active' : ''; ?>" title="Reports Link">
            <div class="icon">
                <img src="assets/newIcon/logout.png" title="Reports Icon">
            </div>
            <span class="link hide">Keluar</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <script src="javascript/script.js"></script>
</body>
</html>