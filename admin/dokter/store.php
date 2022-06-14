<?php
session_start();
require_once '../helper/connection.php';

$id_dokter = $_POST['id_dokter'];
$nama = $_POST['nama'];
$jk = $_POST['jk'];
$spesialis = $_POST['spesialis'];

$query = mysqli_query($connection, "insert into dokter(id_dokter, nama, jk, spesialis) value('$id_dokter', '$nama', '$jk', '$spesialis')");
if ($query) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil menambah data'
  ];
  header('Location: ./index.php');
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($connection)
  ];
  header('Location: ./index.php');
}
