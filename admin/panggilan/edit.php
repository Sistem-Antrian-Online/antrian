<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$id = $_GET['id'];
$query = mysqli_query($connection, "SELECT * FROM antrian WHERE id='$id'");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Ubah Data</h1>
    <a href="./listantri.php" class="btn btn-light">Kembali</a>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- // Form -->
          <form action="./update.php" method="post">
            <?php
            while ($row = mysqli_fetch_array($query)) {
            ?>
              <table cellpadding="8" class="w-100">
                <tr>
                  <td>ID</td>
                  <td><input class="form-control" type="text" name="id" required value="<?= $row['id'] ?>" readonly></td>
                </tr>
                <tr>
                  <td>No Antrian</td>
                  <td><input class="form-control" type="text" name="no_antrian" required value="<?= $row['no_antrian'] ?>" readonly></td>
                </tr>
                <tr>
                  <td>Waktu</td>
                  <td><input class="form-control" type="text" name="waktu" required value="<?= $row['waktu'] ?>" readonly></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>
                    <select class="form-control" name="status" id="status" required>
                      <option value="Belum">--Pilih Status--</option>
                      <option value="Selesai">Selesai</option>
                      <option value="Lewati">Lewati</option>
                      <option value="Belum">Belum</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Poli</td>
                  <td><input class="form-control" type="text" name="id_poli" required value="<?= $row['id_poli'] ?>" readonly></td>
                </tr>
                <tr>
                  <td>
                    <input class="btn btn-primary" type="submit" name="proses" value="Simpan">
                    <a href="./listantri.php?id=<?= $id_poli ?>" class="btn btn-danger ml-1">Batal</a>
                  </td>
                </tr>
              </table>

            <?php } ?>
          </form>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>