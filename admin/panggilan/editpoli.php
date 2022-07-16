<?php
session_start();
require_once '../helper/connection.php';
$id = $_POST['id_poli'];
$statu = $_POST['statu'];

$query = mysqli_query($connection, "UPDATE poli SET statu = '$statu' WHERE id_poli='$id'");

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
