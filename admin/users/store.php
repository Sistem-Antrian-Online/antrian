<?php
session_start();
require_once '../helper/connection.php';

$result = mysqli_query($connection, "SELECT COUNT(*) as jumlah FROM users");
$row = mysqli_fetch_assoc($result);
$count = $row['jumlah'];
$no = (int)$count + 1;

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];
$query = mysqli_query($connection, "insert into users (id, nama, username, password, level) value ('$no', '$nama', '$username', '$password', '$level')");

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
