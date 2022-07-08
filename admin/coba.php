<?php
require_once 'helper/connection.php';

$result = mysqli_query($connection, "SELECT * FROM antrian");
$poli = mysqli_query($connection, "SELECT a.*, p.nama AS nama_poli FROM antrian a INNER JOIN poli p ON a.id_poli = p.id_poli");
$data = mysqli_fetch_array($poli);

date_default_timezone_set('Asia/Jakarta');
$tgl = date("j");
$ambiltanggal = $data['waktu'];
$urutan = (int) substr($ambiltanggal, 2, 4);
?>


<div>
    <?= $tgl ?>
    <?= $urutan ?>
</div>
<table class="table table-hover table-striped w-100" id="table-1">
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
                    <!-- <a class="btn btn-sm btn-info" href="edit.php?id=<?= $data['id'] ?>">
                        <i class="fas fa-edit fa-fw"></i>
                      </a> -->
                </td>
            </tr>

        <?php
            $no++;
        endwhile;
        ?>
    </tbody>
</table>