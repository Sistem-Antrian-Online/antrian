<?php
require_once '../layout/_top.php';
require_once '../../admin/helper/connection.php';
?>

<!-- Buat Cetak Ya MasEEE -->
<section class="latest-blog-area" style="margin-top: 20px; text-align: center;">
    <div class="container" style="max-width: 2391px;">
        <div id="navbar_top" class="navbar-brand navbar-expand-lg" style="background-color: white;">
            <a href="" class="" style="text-decoration: none;">
                <img src="../../assets/img/logo/logo2.png" alt="logo" width="50px" height="40px">
                <img src="../../assets/img/logo/logo-header.png" alt="logo" width="190px" height="40px">
            </a><br>
            <h1 style="color: grey;">AMBIL ANTRIAN</h1>

        </div>
        <hr>
        <div class="row row-cols-1 row-cols-md-6 g-2 ">
            <?php
            date_default_timezone_set('Asia/Jakarta');
            $tgl = date("Y-m-d");
            $poli = mysqli_query($connection, "SELECT * FROM poli GROUP BY id_poli ORDER BY loket");
            while ($data = mysqli_fetch_array($poli)) {
                $nama = $data['nama'];
                $idpoli = $data['id_poli'];
                $huruf = $data["loket"];
                $statu = $data["statu"];
                $query = mysqli_query($connection, "SELECT max(no_antrian) AS antrian FROM antrian WHERE no_antrian LIKE '$huruf%' AND waktu LIKE '$tgl%'");
                while ($row = mysqli_fetch_array($query)) {
                    $kode = $row['antrian'];
                }
                $addNol = '';
                $kode = str_replace($huruf, "", $kode);
                $kode = (int) $kode + 1;
                $incrementKode = $kode;

                if (strlen($kode) == 1) {
                    $addNol = "00";
                } elseif (strlen($kode) == 2) {
                    $addNol = "0";
                }

                $no_antrianpoli = $huruf . $addNol . $incrementKode;

            ?>
            <?php if ($statu != 2) { ?>
            <div class="col col-lg-2 col-md-6 text-center">
                <div class="card text-bg-success lg-6 md-3 mb-10" style="height: 200px; cursor: pointer;"
                    data-idpoli="<?= $idpoli; ?>" data-loket="<?= $huruf; ?>" data-nama="<?= $nama; ?>"
                    data-antrian="<?= $no_antrianpoli; ?>" data-statu="<?= $statu; ?>" id="card-poli"
                    onclick="update(this)">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h4 class="card-title text-uppercase" id="">Poli <?= $nama; ?></h4>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <br>
                        <h4 class="card-title text-uppercase" id=""><?= $no_antrianpoli; ?></h4>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="col col-lg-2 col-md-6 text-center">
                <div class="card text-bg-secondary lg-6 md-3 mb-10" style="height: 200px; cursor: pointer;"
                    data-idpoli="<?= $idpoli; ?>" data-loket="<?= $huruf; ?>" data-nama="<?= $nama; ?>"
                    data-antrian="<?= $no_antrianpoli; ?>" data-statu="<?= $statu; ?>" id="card-poli"
                    onclick="update(this)">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h4 class="card-title text-uppercase" id="">Poli <?= $nama; ?></h4>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <br>
                        <h4 class="card-title text-uppercase" id=""><?= $no_antrianpoli; ?></h4>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- <div class="col text-center">
                    <div class="card text-bg-success mb-10" style="width: 215px;height: 200px; cursor: pointer;" data-idpoli="<?= $idpoli; ?>" data-loket="<?= $huruf; ?>" data-nama="<?= $nama; ?>" data-antrian="<?= $no_antrianpoli; ?>" data-statu="<?= $statu; ?>" id="card-poli" onclick="update(this)">
                        <div class="card-header d-flex justify-content-center align-items-center">
                            <h4 class="card-title text-uppercase" id="">Poli <?= $nama; ?></h4>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <br>
                            <h4 class="card-title text-uppercase" id=""><?= $no_antrianpoli; ?></h4>
                        </div>
                    </div>
                </div> -->
            <?php
            }
            ?>
</section>
</body>
<script src="../assets/js/jquery-3.6.0.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>
<script src="https://cdn.jsdelivr.net/npm/recta/dist/recta.js"></script>
<script>
//-----KONFIGURASI FIREBASE-----
var printer = new Recta('123456789', '1811')

const firebaseConfig = {
    apiKey: "AIzaSyBcj1h4Z0EHIYyuh9dEzbLnrfhnuvCUOaI",
    authDomain: "antrian-online-97d3b.firebaseapp.com",
    projectId: "antrian-online-97d3b",
    storageBucket: "antrian-online-97d3b.appspot.com",
    messagingSenderId: "933345432664",
    appId: "1:933345432664:web:fa8d54fdcb900c168de62d",
    measurementId: "G-VDK4EVDDZX",
};

firebase.initializeApp(firebaseConfig);
var db = firebase.database();
var antrianFR = db.ref("antrian");


function update(el) {
    date_check = new Date();
    let id = $(el).data("idpoli");
    let noantri = $(el).data("antrian");
    let loket = $(el).data("loket");
    let poli = $(el).data("nama");
    let status = $(el).data("status");
    let statu = $(el).data("statu");

    arrbulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
        "Oktober",
        "November", "Desember"
    ];
    date = new Date();
    millisecond = date.getMilliseconds();
    detik = date.getSeconds();
    menit = date.getMinutes();
    jam = date.getHours();
    hari = date.getDay();
    tanggal = date.getDate();
    bulan = date.getMonth();
    tahun = date.getFullYear();


    if (date_check.getHours() >= "0" && date_check.getHours() <= "16") {
        if (statu != "2") {
            if (confirm('Yakin?') == true) {
                $.ajax({
                    url: "create.php",
                    method: "POST",
                    data: {
                        id: id,
                        noantri: noantri
                    },
                    cache: "false",
                    success: function(y) {
                        if (y == 1) {
                            db.ref("antrian/" + id).set({
                                no_antrian: noantri,
                                nama: poli,
                                loket: loket
                            }, (error) => {
                                if (error) {
                                    alert("Gagal");
                                } else {
                                    printer.open().then(function() {
                                        printer.align('center')
                                            .text("RSUD JOMBANG\n")
                                            .bold(true)
                                            .font('A')
                                            .mode('A', true, true, true, false)
                                            .text('Loket ' + loket)
                                            .underline(true)
                                            .text(noantri + '\n')
                                            .underline(false)
                                            .mode('B', false, false, false, false)
                                            .bold(true)
                                            .text('POLI ' + poli + '\n')
                                            .bold(false)
                                            .underline(false)
                                            .text(tanggal + " " + arrbulan[bulan] +
                                                " " +
                                                tahun + " " + jam + ":" + menit + ":" +
                                                detik + '\n')
                                            .barcode('code39', noantri)
                                            .cut()
                                            .print()
                                    })

                                    window.location = "";
                                }
                            });
                        } else {
                            alert("sistem error");
                        }
                    },
                    error: function() {
                        swal({
                            title: "Gagal",
                            text: "API Tidak Terhubung",
                            icon: "error"
                        });
                    }
                })
            }
        } else {
            Swal.fire(
                'Maaf Poli Tutup!',
                "Silahkan Kembali Besok",
                'error'
            )
        }
    } else {
        Swal.fire(
            'Maaf Sudah Tutup!',
            "Silahkan Kembali Besok",
            'error'
        )
    }
}

function showTime() {
    let hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
    let bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    let date = new Date();
    let day = date.getDay();
    let year = date.getYear();
    let month = date.getMonth();
    let Hari = hari[day];
    let Tanggal = date.getDate().toString();
    let Bulan = bulan[month];
    let Tahun = (year < 1000) ? year + 1900 : year;
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    if (h == 0) {
        h = 12;
    }

    if (h > 12) {
        h = h - 12;
        session = "PM";
    }

    if (Tanggal.length == 1) {
        Tanggal = "0" + Tanggal;
    }

    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    var time = h + ":" + m + ":" + s + " " + session;

    // console.log(Hari+", "+day+' '+Bulan+" "+Tahun+" "+time);
    let hariTgl = Hari + ", " + Tanggal + ' ' + Bulan + " " + Tahun + " " + time;
    $('.waktu-tgl').html(hariTgl);
    setTimeout(showTime, 1000);
}
showTime();
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            document.getElementById('navbar_top').classList.add('fixed-top');
            // add padding top to show content behind navbar
            navbar_height = document.querySelector('.navbar').offsetHeight;
            document.body.style.paddingTop = navbar_height + 'px';
        } else {
            document.getElementById('navbar_top').classList.remove('fixed-top');
            // remove padding top from body
            document.body.style.paddingTop = '0';
        }
    });
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>