<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$query = mysqli_query($connection, "SELECT * FROM users ");
$poli = mysqli_query($connection, "SELECT * FROM poli WHERE id_poli");
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Tambah Users</h1>
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
                                <td>Nama User</td>
                                <td><input class="form-control" type="text" name="nama" onkeypress="InputWord(event)" required></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td><input class="form-control" type="text" name="username" onkeypress="InputWord(event)" required></td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Password</td>
                                <td><input class="form-control" type="password" name="password" required></td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Level User</td>
                                <td>
                                    <select class="form-control" name="level" id="level" required>
                                        <option value="">--Pilih Level User--</option>
                                        <option value="1">Administrator</option>
                                        <option value="2">Asisten Dokter</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Poli</td>
                                <td>
                                    <select class="form-control" name="id_poli" id="id_poli" required>
                                        <option value="<?= $row['id_poli'] ?>">Jika tidak diubah biarkan</option>
                                        <?php
                                        while ($r = mysqli_fetch_array($poli)) :
                                        ?>
                                            <option value="<?= $r['id_poli'] ?>"><?= $r['nama'] ?></option>
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