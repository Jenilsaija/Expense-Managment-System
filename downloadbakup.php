<?php
  header('Content-Type: application/download');
  header('Content-Disposition: attachment; filename="Bakupeddata.txt"');
  header("Content-Length: " . filesize("Bakupeddata.txt"));
  $fp = fopen("Bakupeddata.txt", "r");
  fpassthru($fp);
  fclose($fp);
  echo "<script>window.close();</script>";
?>