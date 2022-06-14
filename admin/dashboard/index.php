<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$dokter = mysqli_query($connection, "SELECT COUNT(*) FROM dokter");
$poli = mysqli_query($connection, "SELECT COUNT(*) FROM poli");
$antrian = mysqli_query($connection, "SELECT COUNT(*) FROM antrian");
$users = mysqli_query($connection, "SELECT COUNT(*) FROM users");

$total_dokter = mysqli_fetch_array($dokter)[0];
$total_poli = mysqli_fetch_array($poli)[0];
$total_antrian = mysqli_fetch_array($antrian)[0];
$total_users = mysqli_fetch_array($users)[0];
?>

<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
  <div class="column">
    <div class="row">
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
    <div class="row">
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
</section>

<?php
require_once '../layout/_bottom.php';
?>