<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$poli = mysqli_query($connection, "SELECT * FROM poli WHERE id_poli");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Antrian Poli</h1>
  </div>
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
    $i = 0;
    $newrow = true;
    while ($data = mysqli_fetch_array($poli)) :
      $nama = $data['nama'];
      $deskripsi = $data['deskripsi'];
      $idpoli = $data['id_poli'];
      if ($newrow) {
        echo '<div class="col text-center">';
        $newrow = false;
      }
      echo '<div class="card text-center" style="max-width: 18rem;">';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">' . $nama . '</h5>';
      echo '<p class="card-text">' . $deskripsi . '</p>';
      echo '<a class="btn btn-primary" href="create.php?id_poli=' . $idpoli . '">Daftar</a>';
      echo '</div>';
      echo '</div>';

      $i++;
      if ($i == 2) {
        echo '</div>';
        $newrow = true;
        $i = 0;
      }
    endwhile;
    ?>
  </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>
<!-- Page Specific JS File -->
<?php
if (isset($_SESSION['info'])) :
  if ($_SESSION['info']['status'] == 'success') {
?>
    <script>
      iziToast.success({
        title: 'Sukses',
        message: `<?= $_SESSION['info']['message'] ?>`,
        position: 'topCenter',
        timeout: 5000
      });
    </script>
  <?php
  } else {
  ?>
    <script>
      iziToast.error({
        title: 'Gagal',
        message: `<?= $_SESSION['info']['message'] ?>`,
        timeout: 5000,
        position: 'topCenter'
      });
    </script>
<?php
  }

  unset($_SESSION['info']);
  $_SESSION['info'] = null;
endif;
?>
<script src="../../assets/js/page/modules-datatables.js"></script>