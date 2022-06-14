<?php
session_start();
require_once '../helper/connection.php';

$id = $_POST['id'];
$no_antrian = $_POST['no_antrian'];
$waktu = $_POST['waktu'];
$status = $_POST['status'];
$id_poli = $_POST['id_poli'];

$query = mysqli_query($connection, "insert into antrian (id, no_antrian, waktu, status, id_poli) value('$id', '$no_antrian', '$waktu', '$status', '$id_poli')");

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
