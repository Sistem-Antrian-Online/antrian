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
    $tingkat = $data['level_users'];
    // row jika user login sebagai admin
    if ($data['level_users'] == "admin") {

        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level_users'] = $tingkat;
        // alihkan ke halaman dashboard admin
        header("location:dashboard/index.php");

        // row jika user login sebagai pegawai
    } else if ($data['level_users'] == "1") {
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level_users'] = $tingkat;
        // alihkan ke halaman dashboard pegawai
        header("location:dashboard/index.php");

        // row jika user login sebagai pengurus
        // } else if ($data['level_users'] == "2") {
        //     // buat session login dan username
        //     $_SESSION['username'] = $username;
        //     $_SESSION['level_users'] = "2";
        //     // alihkan ke halaman dashboard pengurus
        //     header("location:halaman_pengurus.php");
    } else {

        // alihkan ke halaman login kembali
        header("location:index.php?pesan=gagal");
    }
} else {
    header("location:index.php?pesan=gagal");
}

// if ($row['level_users_users'] == 1) {
//     print("Dokter");
// } else if ($row['level_users_users'] != 0) {
//     print("Admin");
// } else {
//     print("Data Tidak Ditemukan");
//     header('Location: index.php');
// }

// if ($row) {
//   $_SESSION['login'] = $row;
//   header('Location: coba.php');
// }


// session_start();
// if (isset($_SESSION['login'])) {
//   header('Location: dashboard/index.php');
// } else {
//   header('Location: ./login.php');
// }
