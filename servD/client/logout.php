<script>

  const confirmed = confirm('Apakah Anda yakin ingin logout?');

  if (confirmed) {
   
    window.location.href = '../index.php';
    
  
  }

  else {
    window.location.href = 'index.php';
  }
</script>
