<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$pol = $_GET['id'];
$result = mysqli_query($connection, "SELECT * FROM antrian");
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Antrian Poli</h1>
        <!-- <a href="./antripoli.php" class="btn btn-primary">Tambah Data</a> -->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col">
                        <form method="POST" class="form-inline">
                            <input type="date" name="tglstart" class="form-control">
                            <button type="submit" name="filter_tgl" class="btn btn-info"></button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped w-100">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>No Antrian</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Poli</th>
                                    <th style="width: 150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['filter_tgl'])) {
                                    $mulai = $_POST['tglstart'];
                                    if ($mulai != null) {
                                        $poli = mysqli_query($connection, "SELECT a.*, p.nama AS nama_poli FROM antrian a INNER JOIN poli p ON a.id_poli = p.id_poli WHERE a.id_poli = '$pol' AND a.waktu like '$mulai%'");
                                    } else {
                                        $poli = mysqli_query($connection, "SELECT a.*, p.nama AS nama_poli FROM antrian a INNER JOIN poli p ON a.id_poli = p.id_poli WHERE a.id_poli = '$pol'");
                                    }
                                } else {
                                    $poli = mysqli_query($connection, "SELECT a.*, p.nama AS nama_poli FROM antrian a INNER JOIN poli p ON a.id_poli = p.id_poli WHERE a.id_poli = '$pol'");
                                }
                                $no = 1;
                                while ($data = mysqli_fetch_array($poli)) :
                                ?>
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <tr class="text-center">
                                        <td><?= $no ?></td>
                                        <td><?= $data['no_antrian'] ?></td>
                                        <td><?= $data['waktu'] ?></td>
                                        <td><?= $data['status'] ?></td>
                                        <td><?= $data['nama_poli'] ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-danger mb-md-0 mb-1" href="delete.php?id=<?= $data['id'] ?>">
                                                <i class="fas fa-trash fa-fw"></i>
                                            </a>
                                            <a class="btn btn-sm btn-info" href="edit.php?id=<?= $data['id'] ?>">
                                                <i class="fas fa-edit fa-fw"></i>
                                            </a>
                                        </td>
                                    </tr>

                                <?php
                                    $no++;
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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