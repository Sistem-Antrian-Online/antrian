<?php
session_start();
require_once '../helper/connection.php';

$id = $_GET['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$level_users = $_POST['level_users'];

$query = mysqli_query($connection, "UPDATE users SET nama = '$nama', username = '$username', password = '$password', level_users = '$level_users' WHERE id = '$id'");
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