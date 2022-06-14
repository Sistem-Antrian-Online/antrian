<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$query = mysqli_query($connection, "SELECT max(no_antrian) as no_antrianTerbesar FROM antrian");
$poli = mysqli_query($connection, "SELECT * FROM poli");
$poi = mysqli_fetch_array($poli);
$idpoi = $poi['id_poli'];
$namapoi = $poi['nama'];
$data = mysqli_fetch_array($query);
$no_antrianpoli = $data['no_antrianTerbesar'];

// mengambil angka dari no_antrian barang terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($no_antrianpoli, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membentuk no_antrian barang baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan no_antrian huruf yang kita inginkan, misalnya BRG 
$huruf = "M";
$no_antrianpoli = $huruf . sprintf("%03s", $urutan);
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Mata</h1>
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
                <td>No Antrian</td>
                <td><input class="form-control" type="text" name="no_antrian" size="20" value="<?php echo $no_antrianpoli ?>" required readonly></td>
              </tr>
              <tr>
                <td>Waktu</td>
                <td><input class="form-control" type="datetime-local" name="waktu" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                          echo date("Y-m-d\TH:i:s", time()); ?>" required readonly /></td>
              </tr>
              <tr>
                <td>Status</td>
                <td>
                  <select class="form-control" name="status" id="status" required>
                    <option value="">--Pilih Status--</option>
                    <option value="sudah">Sudah</option>
                    <option value="proses">Proses</option>
                    <option value="Belum">Belum</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>ID Poli</td>
                <td><input class="form-control" type="text" name="id_poli" size="20" value="2" required readonly></td>
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