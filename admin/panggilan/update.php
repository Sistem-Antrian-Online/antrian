<?php
session_start();
require_once '../helper/connection.php';

$id = $_POST['id'];
$no_antrian = $_POST['no_antrian'];
$waktu = $_POST['waktu'];
$status = $_POST['status'];
$id_poli = $_POST['id_poli'];

$query = mysqli_query($connection, "UPDATE antrian SET no_antrian='$no_antrian', waktu = '$waktu', status = '$status', id_poli = '$id_poli' WHERE id='$id'");

if ($query) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil mengubah data'
  ];
  header("Location: ./listantri.php?id='$id_poli'");
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($connection)
  ];
  header("Location: ./listantri.php?id='$id_poli'");
}
