<?php
session_start();
include 'helper/connection.php';
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($connection, $sql);
$row = mysqli_num_rows($result);

if ($row > 0) {
    $data = mysqli_fetch_assoc($result);
    $nama = $data['nama'];
    $tingkat = $data['level'];
    // row jika user login sebagai admin
    if ($data['level'] == "1") {
        // buat session login dan username
        $_SESSION['nama'] = $nama;
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $tingkat;
        // alihkan ke halaman dashboard admin
        header("location:dashboard/index.php");

        // row jika user login sebagai asdok
    } else if ($data['level'] == "2") {
        // buat session login dan username
        $_SESSION['nama'] = $nama;
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $tingkat;
        // alihkan ke halaman dashboard asdok
        header("location:dashboard/index.php");
    } else {
        // alihkan ke halaman login kembali
        header("location:index.php?pesan=Akun Tidak Terdaftar !");
    }
} else {
    header("location:index.php?pesan=Akun Tidak Terdaftar !");
}
