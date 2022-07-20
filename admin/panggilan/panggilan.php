<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';
$id_poli = $_GET['id'];
$poli = $_GET['poli'];
$loket = $_GET['loket'];

$sql = "SELECT *, MIN(no_antrian) AS antrian, COUNT(no_antrian) AS sisa_antrian FROM antrian WHERE STATUS = 'Belum' AND no_antrian 
            LIKE '%$loket%' AND id_poli = '$id_poli' LIMIT 1";
$query = mysqli_query($connection, $sql);
$data = mysqli_fetch_array($query);
$antrian_belum = $data['antrian'];

$sql2 = "SELECT no_antrian, status, MIN(no_antrian) AS antrian_panggil FROM antrian WHERE STATUS = 'Dilayani' AND id_poli = '$id_poli' LIMIT 1";
$query2 = mysqli_query($connection, $sql2);
$data2 = mysqli_fetch_array($query2);
$antrian_dilayani = $data2['antrian_panggil'];

?>

<section class="section" data-id="<?= $id_poli ?>" data-loket="<?= $loket ?>" data-poli="<?= $poli; ?>" data-nomor_belum="<?= $antrian_belum; ?>">
    <div class="section-header d-flex justify-content-between">
        <h2 id="poli" data-poli="<?= $poli ?>"><?= $poli ?></h2>
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
                        <h2 id="nomor-antrian-selanjutnya"></h2>
                    </div>
                    <div class="bg-sisa-antrian">
                        <h2 id="sisa"></h2>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="container-panggil-antrian shadow p-3 mb-5 rounded">
                    <div class="bg-title-panggilan">
                        <h1>PANGGILAN</h1>
                    </div>
                    <div class="box-nomor ">
                        <h2 id="nomor-panggilan"></h2>
                    </div>
                    <div class="button-panggilan">
                        <button type="submit" class="btn btn-warning" onclick="panggil()">Panggil</button>
                        <button type="submit" class="" data-nomor='<?= $antrian_dilayani; ?>' onclick="lewati(this)">Lewati</button>
                        <button type="submit" class="btn btn-primary" data-nomor='<?= $antrian_dilayani; ?>' onclick="selesai(this)">Selesai</button>
                        <button type="submit" class="btn btn-danger" onclick="tutup()">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- audio -->
<audio id="bel">
    <source src="audio/bel.mp3" type="audio/mpeg">
</audio>

<audio id="perhatian">
    <source src="audio/Perhatian.m4a" type="audio/x-m4a">
</audio>

<audio id="huruf">
    <source src="audio/<?= substr($antrian_dilayani, 0, 1); ?>.m4a" type="audio/x-m4a">
</audio>

<audio id="audio1">
    <source src="audio/<?= substr($antrian_dilayani, 1, 1); ?>.m4a" type="audio/x-m4a">
</audio>
<audio id="audio2">
    <source src="audio/<?= substr($antrian_dilayani, 2, 1); ?>.m4a" type="audio/x-m4a">
</audio>
<audio id="audio3">
    <source src="audio/<?= substr($antrian_dilayani, 3, 1); ?>.m4a" type="audio/x-m4a">
</audio>

<audio id="tujuan">
    <source src="audio/Tujuan.m4a" type="audio/x-m4a">
</audio>

<audio id="loket">
    <source src="audio/<?= $loket ?>.m4a" type="audio/x-m4a">
</audio>


<script src="../../assets/js/jquery-3.6.0.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>
<script>
    // atribut
    var id = $('section').data('id');
    var loket = $('section').data('loket');
    var poli = $('section').data('poli');
    var nomor_selanjutnya = $('section').data('nomor_belum');
    console.log(id + ' ' + loket + ' ' + poli + ' ' + nomor_selanjutnya);

    // nomor antrian yg belum
    function getJson() {
        let url = 'http://localhost/antrian/admin/panggilan/getJson.php?id=' + id + '&loket=' + loket;
        $.getJSON(url, function(hasil) {
            let data = hasil.data;
            let nomor_belum = '';
            let sisa_antrian_belum = '';
            data.forEach(kolom => {
                let antrian_belum = kolom.antrian;
                let sisa_belum = kolom.sisa_antrian;
                nomor_belum += antrian_belum;
                sisa_antrian_belum = sisa_belum;
            });
            $('#nomor-antrian-selanjutnya').html(nomor_belum);
            $('#sisa').html("Sisa Antrian : " + sisa_antrian_belum);
        });
    }
    setInterval(getJson, 1000);

    function getJson2() {
        url = 'http://localhost/antrian/admin/panggilan/getJson2.php?id=' + id;
        $.getJSON(url, function(hasil) {
            let data = hasil.data;
            let data_nomor = '';
            let btn_selesai = '';
            data.forEach(kolom => {
                var nomor_dilayani = kolom.nomor_dilayani;
                data_nomor += nomor_dilayani;
            });
            $('#nomor-panggilan').html(data_nomor);
        });
    }
    setInterval(getJson2, 1000);

    function dilayani() {
        let nomor_belum = $('section').data('nomor_belum');
        $.ajax({
            url: 'dilayani.php',
            type: 'POST',
            data: {
                nomor: nomor_belum
            },
            cache: false,
            success: (data) => {
                console.log(data);
            }
        })
    }

    function lewati(el) {
        let nomor_dilayani = $(el).data('nomor');
        $.ajax({
            url: 'lewati.php',
            type: 'POST',
            data: {
                nomor: nomor_dilayani
            },
            cache: false,
            success: (data) => {
                // alert('Nomor Antrian Dilewati');
                location.reload(true);
                console.log(data);
            },
        });

        dilayani();
    }

    function selesai(el) {
        let nomor_dilayani = $(el).data('nomor');
        // alert(nomor_dilayani);
        $.ajax({
            url: 'selesai.php',
            type: 'POST',
            data: {
                nomor: nomor_dilayani
            },
            cache: false,
            success: (data) => {
                location.reload(true);
            }
        });

        dilayani()
    }

    function tutup() {
        let nomor_dilayani = $('button:nth-child(2)').data('nomor');
        alert('Status Tidak Beroperasi');
        db.ref('antrian_dilayani/' + id).set({
            loket: loket,
            nama_poli: poli,
            nomor_dilayani: '---',
            status: 'Tidak Beroperasi'
        })
    }


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

    // set data realtime firebase
    function sendData() {
        // waktu
        let d = new Date();
        let h = d.getHours();
        let m = d.getMinutes();
        let menit = m > 9 ? m : '0' + m;
        let jam = h > 9 ? h : '0' + h;
        let waktu = jam + ' : ' + menit;

        let nomor_dilayani = $('button:nth-child(2)').data('nomor');


        db.ref('antrian_dilayani/' + id).set({
            loket: loket,
            nama_poli: poli,
            nomor_dilayani: nomor_dilayani,
            waktu_dilayani: waktu,
            nomor_selanjutnya: nomor_selanjutnya,
            status: 'Sedang Melayani'
        });
    }

    function panggil() {
        let bel = document.getElementById('bel');
        let perhatian = document.getElementById('perhatian');
        let audio_huruf = document.getElementById('huruf');
        let audio_1 = document.getElementById('audio1');
        let audio_2 = document.getElementById('audio2');
        let audio_3 = document.getElementById('audio3');
        let audio_tujuan = document.getElementById('tujuan');
        let audio_loket = document.getElementById('loket');


        bel.play();
        setTimeout(() => {
            perhatian.play()
        }, 8100);
        setTimeout(() => {
            audio_huruf.play()
        }, 10000);
        setTimeout(() => {
            audio_1.play()
        }, 11000);
        setTimeout(() => {
            audio_2.play()
        }, 11900);
        setTimeout(() => {
            audio_3.play()
        }, 12900);
        setTimeout(() => {
            audio_tujuan.play()
        }, 13500);
        setTimeout(() => {
            audio_loket.play()
        }, 15500);

        sendData();
        showPanggilan();
    }

    function showPanggilan() {
        let nomor_dilayani = $('button:nth-child(2)').data('nomor');
        db.ref('panggilan').set({
            loket: loket,
            nomor: nomor_dilayani,
            poli: poli,
            status: 'Sedang Melayani'
        })
    }
</script>

<!-- akhir layout -->
<?php require_once '../layout/_bottom.php'; ?>