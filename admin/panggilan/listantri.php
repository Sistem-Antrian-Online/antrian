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
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="float-right">
                            <form method="POST" class="form-inline pb-3">
                                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                <input type="date" name="tglstart" id="tglan" class="form-control" value="2022-06-24">
                                <input type="submit" name="filter_tgl" class="btn btn-info" value="Cari">
                            </form>
                        </div>
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
                            <tbody id="isitab">
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
                                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                    <tr class="text-center">
                                        <td><?= $no ?></td>
                                        <td><?= $data['no_antrian'] ?></td>
                                        <td><?= $data['waktu'] ?></td>
                                        <td><?= $data['status'] ?></td>
                                        <td><?= $data['nama_poli'] ?></td>
                                        <td>
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
                        <form method="POST" class="form-inline pb-3" action="editpoli.php">
                            <input type="text" id="id_poli" name="id_poli" value=" <?= $_SESSION['id_poli'] ?>" hidden>
                            <select class="form-control" name="statu" id="statu" required>
                                <option value="1">--Pilih Status--</option>
                                <option value="1">Buka</option>
                                <option value="2">Tutup</option>
                            </select>
                            <input type="submit" class="btn btn-info" value="Ubah">
                        </form>
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
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#isitab tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<script>
    function status(el) {
        var id_poli = $(el).data('');
        var loket = $(el).data('loket');
        var nama_poli = $(el).data('poli');
        var no_antrian = $(el).data('antrian');

        $.ajax({
            url: 'nomorlanjutnya.php',
            type: 'POST',
            data: {
                nomor: no_antrian
            },
            cache: false,
            success: (data) => {
                location.reload(true);
            },
            error: (e) => {
                alert("Ada Kesalahan Cek Lagi " + e);
            }
        });
    }
</script>