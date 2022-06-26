<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

//Keseluruhan
$dokter = mysqli_query($connection, "SELECT COUNT(*) FROM dokter");
$poli = mysqli_query($connection, "SELECT COUNT(*) FROM poli");
$antrian = mysqli_query($connection, "SELECT COUNT(*) FROM antrian");
$users = mysqli_query($connection, "SELECT COUNT(*) FROM users");
$total_dokter = mysqli_fetch_array($dokter)[0];
$total_poli = mysqli_fetch_array($poli)[0];
$total_antrian = mysqli_fetch_array($antrian)[0];
$total_users = mysqli_fetch_array($users)[0];

//REALTIME
$jantung = mysqli_query($connection, "SELECT COUNT(*) FROM antrian WHERE id_poli = 2 AND status = 'Belum'");
?>

<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
  <div class="container">
    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
      <div class="col-md-6 px-0">
        <h1 class="display-4 fst-italic">Iklan Video</h1>
        <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
        <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
      </div>
    </div>
    <hr>
    <div class="column">
      <p class="lead my-3 text-center">Total Keseluruhan</p>
      <div class="row justify-content-md-center">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Dokter</h4>
              </div>
              <div class="card-body">
                <?= $total_dokter ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Poli</h4>
              </div>
              <div class="card-body">
                <?= $total_poli ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-md-center">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Antrian</h4>
              </div>
              <div class="card-body">
                <?= $total_antrian ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total User</h4>
              </div>
              <div class="card-body">
                <?= $total_users ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>