<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$id_poli = $_GET['id_poli'];
$poli = mysqli_query($connection, "SELECT loket,nama AS nam_pol FROM poli WHERE id_poli = '$id_poli'");
if (mysqli_num_rows($poli) > 0) {
  while ($row = mysqli_fetch_assoc($poli)) {
    $huruf = $row["loket"];
    $nam_pol = $row["nam_pol"];
  }
} else {
  echo "0 results";
}
$query = mysqli_query($connection, "SELECT max(no_antrian) as no_antrianTerbesar FROM antrian WHERE no_antrian LIKE '$huruf%'");
$data = mysqli_fetch_array($query);
$no_antrianpoli = $data['no_antrianTerbesar'];

// mengambil angka dari no_antrian barang terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($no_antrianpoli, 1, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membentuk no_antrian barang baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan no_antrian huruf yang kita inginkan, misalnya BRG 
$no_antrianpoli = $huruf . sprintf("%03s", $urutan);
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Antrian</h1>
    <a href="./antripoli.php" class="btn btn-light">Kembali</a>
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
                <td><input class="form-control" type="text" name="no_antrian" id="no_antrian" size="20" value="<?php echo $no_antrianpoli ?>" required readonly></td>
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
                    <option value="Belum">--Pilih Status--</option>
                    <option value="Sudah">Sudah</option>
                    <option value="Proses">Proses</option>
                    <option value="Belum">Belum</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>ID Poli</td>
                <td><input class="form-control" type="text" name="id_poli" id="id_poli" size="20" value="<?php echo $id_poli; ?>" required readonly></td>
              </tr>
              <tr>
                <td>Nama Poli</td>
                <td><input class="form-control" type="text" size="20" id="nama_poli" value="<?php echo $nam_pol; ?>" required readonly></td>
              </tr>
              <tr>
                <td>Loket</td>
                <td><input class="form-control" type="text" size="20" id="nama_loket" value="<?php echo $huruf; ?>" required readonly></td>
              </tr>
              <tr>
                <td>
                  <input class="btn btn-primary" type="submit" onclick="update()" name="proses" value="Simpan">
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

<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>
<script>
  //-----KONFIGURASI FIREBASE-----
  var Config = {
    apiKey: "AIzaSyD7ZByCdIRx7B_lIwYGcX4J9NG9_PkxxL0",
    authDomain: "siantri.firebaseapp.com",
    databaseURL: "https://siantri-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "siantri",
    storageBucket: "siantri.appspot.com",
    messagingSenderId: "106626247639",
    appId: "1:106626247639:web:e873bd63c82515d794f992",
    measurementId: "G-0KYBJYRPEQ"
  };
  firebase.initializeApp(Config);
  var db = firebase.database();
  var antrianFR = db.ref("antrian");

  function update() {
    let id = $("#id_poli").val();
    let noantri = $("#no_antrian").val();
    let loket = $("#nama_loket").val();
    let poli = $("#nama_poli").val();
    db.ref("antrian/" + id).set({
      no_antrian: noantri,
      nama: poli,
      loket: loket
    }, (error) => {
      if (error) {
        alert("Gagal");
      } else {
        alert("Berhasil");
      }
    });
  }
</script>