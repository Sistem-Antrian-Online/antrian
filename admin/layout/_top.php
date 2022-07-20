<?php
require_once '../helper/auth.php';

isLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Antrian Online RS Jombang</title>

  <!-- Logo Title -->
  <link rel="icon" href="../../assets/img/logo/logo-header.png" type="image/x-icon">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../../assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../../assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="../../assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="../../assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="../../assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="../../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="../../assets/modules/izitoast/css/iziToast.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/components.css">
  <style>
    /* panggilan selanjutnya */
    .container-antrian-selanjutnya {
      width: 100%;
      height: 30rem;
      border-radius: 5px;
      /* background-color: salmon; */
    }

    .bg-title-selanjutnya {
      width: 100%;
      background-color: #65C18C;
      color: #fff;
      text-align: center;
      padding-top: .5rem;
    }

    .box-nomor-selanjutnya {
      display: flex;
      width: 100%;
      height: 14rem;
      margin: 0 auto;
      margin-top: 3rem;
      margin-bottom: 1rem;
      align-items: center;
      justify-content: center;
      background: #C1F4C5;
      border-radius: 5px;
    }

    .box-nomor-selanjutnya h2 {
      font-size: 6rem;
      color: #000;
    }

    .bg-sisa-antrian {
      display: flex;
      width: 100%;
      height: 15%;
      margin: 0 auto;
      margin-top: 2rem;
      justify-content: center;
      align-items: center;
      border-radius: 30rem;
      background-color: #65C18C;
      color: #fff;
    }

    .bg-sisa-antrian h2 {
      font-size: 1.7rem;
    }

    /* panggilan */
    .container-panggil-antrian {
      width: 100%;
      height: 30rem;
      border-radius: 5px;
      /* background-color: green; */
    }

    .bg-title-panggilan {
      width: 100%;
      background-color: #65C18C;
      color: #fff;
      text-align: center;
      padding-top: .5rem;
    }

    .box-nomor {
      display: flex;
      width: 100%;
      height: 14rem;
      margin: 0 auto;
      margin-top: 3rem;
      margin-bottom: 1rem;
      top: 10%;
      align-items: center;
      justify-content: center;
      color: #000;
      background: #C1F4C5;
      border-radius: 5px;
    }

    .box-nomor h2 {
      font-size: 6rem;
      color: #000;
    }

    .button-panggilan {
      display: flex;
      width: 100%;
      justify-content: space-around;
      margin: 0 auto;
    }

    .button-panggilan button {
      width: 7rem;
      height: 4rem;
      margin: 0 auto;
      font-size: 1.2rem;
      padding: auto;
    }

    .button-panggilan button:nth-child(2) {
      background-color: #787878;
      border-radius: 2px;
      color: #fff;
      border: none;
    }

    .button-panggilan button:nth-child(2):hover {
      background-color: #707070;
    }
  </style>

</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <?php
      require_once '_header.php';
      require_once '_sidenav.php';
      ?>
      <!-- Main Content -->
      <div class="main-content">