<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$id = $_GET['id'];
$query = mysqli_query($connection, "SELECT * FROM users WHERE id='$id'");
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Ubah Data Users</h1>
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
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <table cellpadding="8" class="w-100">
                                <tr>
                                    <td>Nama</td>
                                    <td><input class="form-control" type="text" name="nama" required value="<?= $row['nama'] ?>" onkeypress="InputWord(event)" required></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><input class="form-control" type="text" name="username" required value="<?= $row['username'] ?>" onkeypress="InputWord(event)" required></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td><input class="form-control" type="password" name="password" required value="<?= $row['password'] ?>" required></td>
                                </tr>
                                <tr>
                                    <td>Levels</td>
                                    <td>
                                        <select class="form-control" name="level" id="level" required>
                                            <option value="<?= $row['level'] ?>">Jika tidak diubah biarkan</option>
                                            <option value="1">Administrator</option>
                                            <option value="2">Asisten Dokter</option>
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