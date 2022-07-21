<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';
$query = mysqli_query($connection, 'SELECT * FROM poli');
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Antrian Poli</h1>
    </div>
    
    <!-- Daftar Poli -->
    <div class="container-fluid">
        <div class="row">
            <?php while($data = mysqli_fetch_array($query)) {
                $poli = $data['nama'];
                $loket = $data['loket'];
                $id_poli = $data['id_poli'];
            ?>
                <a href="panggilan.php?id=<?= $id_poli ?>&poli=<?= $poli; ?>&loket=<?= $loket; ?>" style="text-decoration:none;">
                    <div class="col-3 ml-2 mr-2 m-2 data">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body text-center">
                                <h2 class="card-title" style="font-size: 1rem;">Loket <?= $loket; ?></h2>
                                <h1 class="card-text" style="font-size: 2rem;"><?= $poli; ?></h1>
                            </div>
                        </div>
                    </div>
                </a>  
            <?php } ?>            
        </div>        
</section>    

<!-- akhir layout -->
<?php require_once '../layout/_bottom.php'; ?>



