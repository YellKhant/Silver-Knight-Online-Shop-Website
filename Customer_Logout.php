<?php  
session_start();
session_destroy();
session_regenerate_id();

echo "<script>window.alert('SUCCESS : Account logout successfully.')</script>";
echo "<script>window.location='Home.php'</script>";
?>