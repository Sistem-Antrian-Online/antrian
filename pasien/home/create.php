<?php
  require_once "../../admin/helper/connection.php";
  date_default_timezone_set("Asia/Jakarta");
  $id = $_POST["id"];
  $noantri = $_POST["noantri"];
  $jam = date("Y-m-d H:i:s");
  $sql = "INSERT INTO antrian (no_antrian, waktu, status, id_poli) VALUES ('$noantri','$jam','Belum','$id')";
  $hasil = mysqli_query($connection, $sql);
  // if($hasil){
  //   echo "1";
  // }else{
  //   echo "0";
  // }

  
  

?>