<?php
session_start();
require_once '../helper/connection.php';
$statu = $_POST['statu'];

$query = mysqli_query($connection, "UPDATE poli SET statu = '$statu'");

if ($query) {
    $_SESSION['info'] = [
        'status' => 'success',
        'message' => 'Berhasil mengubah data'
    ];
    header("Location:../dashboard/index.php");
} else {
    $_SESSION['info'] = [
        'status' => 'failed',
        'message' => mysqli_error($connection)
    ];
    header("Location: ../dashboard/index.php");
}
