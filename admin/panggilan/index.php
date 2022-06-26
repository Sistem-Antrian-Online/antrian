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
            <?php foreach($query as $poli){ ?>
            <a href="" data-toggle="modal" data-target="#myModal" style="text-decoration:none;">
                <div class="col-3 ml-2 mr-2 m-2">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <h2 class="card-title" style="font-size: 1rem;">Loket <?= $poli['loket']; ?></h2>
                            <h1 class="card-text" style="font-size: 2rem;"><?= $poli['nama']; ?></h1>
                        </div>
                    </div>
                </div>
            </a>
            <?php } ?>
        </div>
    </div>
    <!-- Akhir Daftar Poli -->
    

</section>

    <!-- live Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Poli Apa Nich!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 25rem;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <div class="sisa-panggilan">
                                    <h1>Antrian Selanjutnya</h1>
                                    <h2>PY001</h2>
                                    <h3>Sisa Antrian 100</h3>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="panggilan-pasien bg-warning">
                                    <h1>Panggil</h1>
                                    <h2>PY001</h2>
                                    <div class="mt-5">
                                        <button type="button" class="btn btn-success">Lanjut</button>
                                        <button type="button" class="btn btn-danger">Panggil</button>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info">Status Pasien Selsai</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>



<!-- akhir layout -->
<?php require_once '../layout/_bottom.php'; ?>
