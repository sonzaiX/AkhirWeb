<script>

  const confirmed = confirm('Apakah Anda yakin ingin logout?');

  if (confirmed) {
    
    session_destroy();
    window.location.href = '../index.php';
  }

  else {
    window.location.href = 'index.php';
  }
</script>
