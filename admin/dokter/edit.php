<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$id_dokter = $_GET['id_dokter'];
$query = mysqli_query($connection, "SELECT * FROM dokter WHERE id_dokter='$id_dokter'");
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Ubah Data Dokter</h1>
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
                        <input type="hidden" name="id_dokter" value="<?= $row['id_dokter'] ?>">
                        <table cellpadding="8" class="w-100">
                            <tr>
                                <td>Nama Dokter</td>
                                <td><input class="form-control" type="text" name="nama" size="20"
                                        onkeypress="InputWord(event)" required value="<?= $row['nama'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>
                                    <select class="form-control" name="jk" id="jk" required>
                                        <option value="Pria" <?php if ($row['jk'] == "Pria") {
                                              echo "selected";
                                            } ?>>Pria</option>
                                        <option value="Wanita" <?php if ($row['jk'] == "Wanita") {
                                                echo "selected";
                                              } ?>>Wanita</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Spesialis</td>
                                <td colspan="3"><textarea class="form-control" name="spesialis" id="spesialis"
                                        onkeypress="InputWord(event)" required><?= $row['spesialis'] ?></textarea></td>
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