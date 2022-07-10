<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';
$id_poli = $_GET['id'];
$poli = $_GET['poli'];
$loket_poli = $_GET['loket'];

// antrian selanjutnya & sisa antrian
$sql = "SELECT *, COUNT(SUBSTR(no_antrian, 1)) AS sisa_antrian, MIN(no_antrian) AS nomor_selanjutnya FROM antrian WHERE STATUS = 'Belum' AND no_antrian LIKE '%$loket_poli%' ORDER BY id ASC LIMIT 1";
$query = mysqli_query($connection, $sql);
$data = mysqli_fetch_array($query);

// nomor antrian selanjutnya
$nomor_selanjutnya = isset($data['nomor_selanjutnya']) ? $data['nomor_selanjutnya'] : $loket_poli . '000';

// sisa antrian pasien poli
$sisa_antrian_poli = isset($data['sisa_antrian']) ? $data['sisa_antrian'] : '0';

// panggilan
$sql2 = "SELECT *, MAX(no_antrian) AS nomor_panggilan FROM antrian WHERE STATUS = 'Melayani' AND no_antrian LIKE '%$loket_poli%' LIMIT 1";
$query2 = mysqli_query($connection, $sql2);
$data2 = mysqli_fetch_array($query2);

// panggilan ketika dilayani
$nomor_panggilan_dilayani = isset($data2['nomor_panggilan']) ? $data2['nomor_panggilan'] : $loket_poli . '---';
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h2><?= $poli ?></h2>
        <a href="index.php" class="btn btn-danger">Kembali</a>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="container-antrian-selanjutnya shadow-sm p-3 mb-5 rounded">
                    <div class="bg-title-selanjutnya">
                        <h1>Antrian Selanjutnya</h1>
                    </div>
                    <div class="box-nomor-selanjutnya">
                        <h2 id="nomor-antrian-selanjutnya"><?= $nomor_selanjutnya; ?></h2>
                    </div>
                    <div class="bg-sisa-antrian">
                        <h2>Sisa Antrian : <?= $sisa_antrian_poli; ?> </h2>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="container-panggil-antrian shadow p-3 mb-5 rounded">
                    <div class="bg-title-panggilan">
                        <h1>PANGGILAN</h1>
                    </div>
                    <!-- <form > -->
                    <div class="box-nomor ">
                        <h2><?= $nomor_panggilan_dilayani ?></h2>
                    </div>

                    <input type="text" id="id" value="<?= $id_poli ?>" hidden> <!-- id poli -->
                    <input type="text" id="poli" value="<?= $poli; ?>" hidden> <!-- nama poli -->
                    <input type="text" id="nomor_dilayani" value="<?= $nomor_panggilan_dilayani ?>" hidden> <!-- nomor dilayani -->
                    <input type="text" id="nomor_selanjutnya" value="<?= $nomor_selanjutnya ?>" hidden> <!-- nomor selanjutnya -->
                    <input type="text" id="loket" value="<?= $loket_poli; ?>" hidden> <!-- loket -->

                    <div class="button-panggilan">
                        <button class="btn btn-primary text-center" onclick="lanjut(this)" data-antrian="<?= $nomor_selanjutnya ?>">
                            <span>Lanjut</span>
                        </button>
                        <button class="btn btn-secondary text-center" onclick="lewati(this)" data-antrian="<?= $nomor_panggilan_dilayani ?>">
                            <span>Lewati</span>
                        </button>
                        <button class="btn btn-warning text-center" data-loket="<?= $loket_poli; ?>" data-nomor="<?= $nomor_panggilan_dilayani ?>" data-poli="<?= $poli; ?>" onclick="panggil(this)">
                            <span>Panggil</span>
                        </button>
                        <button class="btn btn-success text-center" onclick="selesai(this)" data-nomor="<?= $nomor_panggilan_dilayani ?>">
                            <span>Selesai</span>
                        </button>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</section>

<audio id="bel">
    <source src="audio/bel.mp3" type="audio/mpeg">
</audio>

<script src="../../assets/js/jquery-3.6.0.js"></script>
<script src="https://code.responsivevoice.org/responsivevoice.js?key=LJri0j9i"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>
<script>
    /*
        menghubungkan firebase untuk menampilkan informasi 
        antrian dilayani saat ini LCD sama Mobile
    */
    const firebaseConfig = {
        apiKey: "AIzaSyBcj1h4Z0EHIYyuh9dEzbLnrfhnuvCUOaI",
        authDomain: "antrian-online-97d3b.firebaseapp.com",
        projectId: "antrian-online-97d3b",
        storageBucket: "antrian-online-97d3b.appspot.com",
        messagingSenderId: "933345432664",
        appId: "1:933345432664:web:fa8d54fdcb900c168de62d",
        measurementId: "G-VDK4EVDDZX",
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    var db = firebase.database();


    // btn panggilan
    function panggil(el) {
        event.preventDefault();
        var bel = document.getElementById('bel');
        let loket = $(el).data('loket');
        let nomor = $(el).data('nomor');
        let poli = $(el).data('poli')
        let textNomor = nomor.split('').join(', ');

        bel.play();

        db.ref('panggilan').set({
            loket: loket,
            nomor: nomor,
            poli: poli,
        });

        var panggilan = "Panggilan Nomor Antrian, " + textNomor + ", Silahkan Menuju Ke Loket, " + loket + ",";
        // alert(panggilan);
        setTimeout(() => {
            responsiveVoice.speak(panggilan, 'Indonesian Female', {
                pitch: 1,
                rate: 1,
                volume: 1
            });
        }, 8100);
    }

    // antrian nomor lanjut
    function lanjut(el) {
        var id_poli = $(el).data('id');
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

    // set data realtime firebase
    function setData() {
        let id = $('#id').val();
        let poli = $('#poli').val();
        let nomor_dilayani = $('#nomor_dilayani').val();
        let nomor_selanjutnya = $('#nomor_selanjutnya').val();
        let loket = $('#loket').val();

        db.ref('antrian_dilayani/' + id).set({
            loket: loket,
            nama_poli: poli,
            nomor_dilayani: nomor_dilayani,
            nomor_selanjutnya: nomor_selanjutnya,
            status: 'Sedang Melayani'
        });
    }
    setData();

    // btn lewati 
    function lewati(el) {
        let nomorSaatIni = $(el).data('antrian');
        $.ajax({
            url: 'nomorlewati.php',
            type: 'POST',
            data: {
                nomor: nomorSaatIni
            },
            cache: false,
            success: (data) => {
                alert('Nomor Antrian Dilewati');
                console.log(data);
            },
        });
    }

    // btn selesai 
    function selesai(el) {
        let nomorSaatIni = $(el).data('nomor');
        $.ajax({
            url: 'nomorselesai.php',
            type: 'POST',
            data: {
                nomor: nomorSaatIni
            },
            cache: false,
            success: (data) => {
                alert('Nomor Antrian Selesai');
                console.log(data);
            },
        });
    }
</script>

<!-- akhir layout -->
<?php require_once '../layout/_bottom.php'; ?>