<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$dokter = mysqli_query($connection, "SELECT * FROM dokter");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Poli</h1>
    <a href="./index.php" class="btn btn-light">Kembali</a>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- // Form -->
          <form action="./store.php" method="POST">
            <table cellpadding="8" class="w-100">
              <tr>
                <td>ID Poli</td>
                <td><input class="form-control" type="text" name="id_poli"></td>
              </tr>
              <tr>
                <td>Nama Poli</td>
                <td><input class="form-control" type="text" name="nama"></td>
              </tr>
              <tr>
                <td>Deksripsi</td>
                <td><textarea name="deskripsi" class="form-control"></textarea></td>
              </tr>
              <tr>
                <td>Loket</td>
                <td><input class="form-control" type="text" name="loket"></td>
              </tr>
              <tr>
                <td>ID Dokter</td>
                <td>
                <select class="form-control" name="id_dokter" id="id_dokter" required>
                    <option value="">--Pilih Dokter--</option>
                    <?php
                    while ($r = mysqli_fetch_array($dokter)) :
                    ?>
                      <option value="<?= $r['id_dokter'] ?>"><?= $r['nama'] ?></option>
                    <?php
                    endwhile;
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <input class="btn btn-primary" type="submit" name="proses" value="Simpan">
                  <input class="btn btn-danger" type="reset" name="batal" value="Bersihkan">
                </td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>