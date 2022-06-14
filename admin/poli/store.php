<?php
session_start();
require_once '../helper/connection.php';

$id_poli = $_POST['id_poli'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$loket = $_POST['loket'];
$id_dokter = $_POST['id_dokter'];

$query = mysqli_query($connection, "insert into poli (id_poli, nama, deskripsi, loket, id_dokter) value('$id_poli', '$nama', '$deskripsi', '$loket', '$id_dokter')");
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
