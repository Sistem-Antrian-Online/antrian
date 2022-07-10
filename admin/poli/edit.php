<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$id_poli = $_GET['id_poli'];
$query = mysqli_query($connection, "SELECT * FROM poli WHERE id_poli='$id_poli'");
$dokter = mysqli_query($connection, "SELECT * FROM dokter WHERE id_dokter");
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Ubah Data Poli</h1>
        <a href="./index.php" class="btn btn-light">Kembali</a>
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
                            <input type="hidden" name="id_poli" value="<?= $row['id_poli'] ?>">
                            <table cellpadding="8" class="w-100">
                                <tr>
                                    <td>Nama Poli</td>
                                    <td><input class="form-control" type="text" name="nama" required value="<?= $row['nama'] ?>" onkeypress="InputWord(event)" required></td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td colspan="3"><textarea class="form-control" name="deskripsi" id="deskripsi" onkeypress="InputWord(event)" required><?= $row['deskripsi'] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td>Loket</td>
                                    <td><input class="form-control" type="text" name="loket" required value="<?= $row['loket'] ?>" onkeypress="InputWord(event)" required></td>
                                </tr>
                                <tr>
                                    <td>ID Dokter</td>
                                    <td>
                                        <select class="form-control" name="id_dokter" id="id_dokter" required value="<?= $row['id_dokter'] ?>">
                                            <option value="<?= $row['id_dokter'] ?>">Ubah atau Tidak</option>
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
                                        <input class="btn btn-primary d-inline" type="submit" name="proses" value="Ubah">
                                        <a href="./index.php" class="btn btn-danger ml-1">Batal</a>
                                    <td>
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