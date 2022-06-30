<?php
session_start();
require_once '../helper/connection.php';

$id_poli = $_GET['id_poli'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$loket = $_POST['loket'];
$id_dokter = $_POST['id_dokter'];

$query = mysqli_query($connection, "UPDATE poli SET nama = '$nama', deskripsi = '$deskripsi', loket = '$loket', id_dokter = '$id_dokter' WHERE id_poli = '$id_poli'");
if ($query) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil mengubah data'
  ];
  header('Location: ./index.php');
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($connection)
  ];
  header('Location: ./index.php');
}