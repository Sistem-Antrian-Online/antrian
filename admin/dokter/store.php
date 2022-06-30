<?php
session_start();
require_once '../helper/connection.php';

$result = mysqli_query($connection, "SELECT COUNT(*) as jumlah FROM dokter");
$row = mysqli_fetch_assoc($result);
$count = $row['jumlah'];
$no = (int)$count + 1;

$nama = $_POST['nama'];
$jk = $_POST['jk'];
$spesialis = $_POST['spesialis'];

$query = mysqli_query($connection, "insert into dokter(id_dokter, nama, jk, spesialis) value('$no', '$nama', '$jk', '$spesialis')");
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