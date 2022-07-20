<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';
    $id_poli = $_GET['id'];
    $poli = $_GET['poli'];
    $loket = $_GET['loket'];

    $sql = "SELECT no_antrian, MIN(no_antrian) AS nomor_selanjutnya FROM antrian WHERE STATUS = 'Belum' AND id_poli = $id_poli LIMIT 1";
    $query = mysqli_query($connection, $sql);
    $data = mysqli_fetch_array($query);
    $nomor_selanjutnya = isset($data['nomor_selanjutnya']) ? $data['nomor_selanjutnya'] : '000';

    // panggilan
    $sql2 = "SELECT no_antrian, MIN(no_antrian) AS antrian_panggil, SUBSTR(no_antrian, 1, 4) AS nomor FROM antrian WHERE STATUS = 'Dilayani' AND id_poli = $id_poli LIMIT 1";
    $query2 = mysqli_query($connection, $sql2);
    $data2 = mysqli_fetch_array($query2);
    $nomor_dilayani = isset($data2['antrian_panggil']) ? $data2['antrian_panggil'] : '---';
    $nomor_antrian = $data2['nomor'];

?>

<section class="section">
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
                    <div class="box-nomor-selanjutnya" data-id="<?= $id_poli; ?>" data-loket="<?= $loket; ?>">
                        <h2 id="nomor-antrian-selanjutnya" data-nomor="<?= $nomor_selanjutnya; ?>"></h2>
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
                            <button class="text-center btn btn-secondary" data-nomor="<?= $nomor_dilayani ?>" onclick="lewati(this)">Lewati</button>
                            <button class="text-center btn btn-warning " data-nomor="<?= $nomor_dilayani ?>"  onclick="panggil(this)">Panggil</button> 
                            <div id="selesai"></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

<audio id="bel">
    <source src="audio/bel.mp3" type="audio/mpeg">
</audio>            

<audio id="perhatian">
    <source src="audio/Perhatian.m4a" type="audio/x-m4a">
</audio>

<audio id="huruf">
    <source src="audio/<?= substr($nomor_antrian, 0, 1); ?>.m4a" type="audio/x-m4a">
</audio>

<audio id="audio1">
    <source src="audio/<?= substr($nomor_antrian, 1, 1); ?>.m4a" type="audio/x-m4a">
</audio>

<audio id="audio2">
    <source src="audio/<?= substr($nomor_antrian, 2, 1); ?>.m4a" type="audio/x-m4a">
</audio>

<audio id="audio3">
    <source src="audio/<?= substr($nomor_antrian, 3, 1); ?>.m4a" type="audio/x-m4a">
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
    // realtime
    var id = $('.box-nomor-selanjutnya').data('id');
    var loket = $('.box-nomor-selanjutnya').data('loket');
    function getJson(){
        let url = 'http://localhost/antrian/admin/panggilan/getJson.php?id=' + id + '&loket=' + loket;
        $.getJSON(url, function (hasil) {
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
            $('#selesai').html("<button class='text-center btn btn-primary' id='dilayani'  data-nomor='"+nomor_belum+"' onclick='selesai(this)'>Selesai</button>");
        });
    }
    setInterval(getJson, 1000);

    function getJson2() {
        let url = 'http://localhost/antrian/admin/panggilan/selesai.php?id=' + id;
        $.getJSON(url, function(hasil) {
            let data = hasil.data;
            let nomor = '';
            data.forEach(kolom => {
                let nomor_dilayani = kolom.nomor_dilayani;
                nomor += nomor_dilayani;
            });  
            $('#nomor-panggilan').html(nomor);
        });
    }
    setInterval(getJson2, 1000);


    // Panggilan Ketika Dilayani
    function dilayani() {   
        let nomor_lanjut = $('#nomor-antrian-selanjutnya').data('nomor');
        $.ajax({
            url: 'dilayani.php',
            type: 'POST',
            data: {nomor: nomor_lanjut},
            cache: false,
            success: (data) => {
                console.log(data);
            }
        })
    }

    // button selesai
    function selesai(el) {
        event.preventDefault();
        let nomor = $(el).data('nomor');      
        alert(nomor + ' test');
        // $.ajax({
        //     url: 'selesai.php',
        //     type: 'POST',
        //     data: {nomor: nomor},
        //     cache: false,
        //     success: (data) => {}
        // });

        dilayani();
    }

    function lewati(el) {
        let nomor = $(el).data('nomor');
        $.ajax({
            url: 'lewati.php',
            type: 'POST',
            data: {nomor: nomor},
            cache: false,
            success: (data) => {
                location.reload();
            },
        });
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
        // atribut poli
        let nomor_dilayani = $('#dilayani').data('nomor');
        let nomor_selanjutnya = $('#nomor-antrian-selanjutnya').data('nomor');
        let poli = $('#poli').data('poli');

        // console.log(id + loket + nomor_selanjutnya + nomor_dilayani + poli);
        
        // waktu
        let d = new Date();
        let h = d.getHours();
        let m = d.getMinutes();
        let menit = m > 9 ? m : '0' + m;
        let jam = h > 9 ? h : '0' + h;  
        let waktu = jam + ' : ' + menit;      

        db.ref('antrian_dilayani/' + id).set({
                    loket: loket,
                    nama_poli: poli,
                    nomor_dilayani: nomor_dilayani,
                    waktu_dilayani: waktu,
                    nomor_selanjutnya: nomor_selanjutnya,
                    status: 'Sedang Melayani'
                });
    }

    sendData();
    
    // btn panggilan
    function panggil(el) {
        event.preventDefault();
        var bel = document.getElementById('bel');
        let poli = $('#poli').data('poli');
        let nomor = $(el).data('nomor');
        let nomor2 = nomor.slice(1);
        let textNomor = nomor2.split('').join(', ');
        let perhatian = document.getElementById('perhatian');
        let audio_huruf = document.getElementById('huruf');
        let audio_nomor1 = document.getElementById('audio1');
        let audio_nomor2 = document.getElementById('audio2');
        let audio_nomor3 = document.getElementById('audio3');
        let audio_loket = document.getElementById('loket');
        let audio_tujuan = document.getElementById('tujuan');

        bel.play();    
        setTimeout(() => {perhatian.play()}, 8100);
        setTimeout(() => {audio_huruf.play()}, 9900);
        setTimeout(() => {audio_nomor1.play()}, 11000);
        setTimeout(() => {audio_nomor2.play()}, 12000);
        setTimeout(() => {audio_nomor3.play()}, 13000);
        setTimeout(() => {audio_tujuan.play()}, 14000);
        setTimeout(() => {audio_loket.play()}, 16000);
        
        db.ref('panggilan').set({
            loket: loket,
            nomor: nomor,
            poli: poli,
            status: 'Sedang Melayani'
        });
        
    }

</script>

<!-- akhir layout -->
<?php require_once '../layout/_bottom.php'; ?>