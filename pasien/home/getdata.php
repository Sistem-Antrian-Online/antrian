<?php
    require_once '../layout/_top.php';
    require_once '../../admin/helper/connection.php';
?>

<!-- Buat Cetak Ya MasEEE -->
<section class="latest-blog-area" style="margin-top: 20px; text-align: center;">
    <div class="container">
        <h1 style="color: grey;">AMBIL ANTRIAN</h1><hr>
        <div class="row row-cols-1 row-cols-md-4 g-2">
            <?php
                $i = 0;
                $newrow = true;
                $poli = mysqli_query($connection, "SELECT * FROM poli ORDER BY id_poli ASC");
                while ($data = mysqli_fetch_array($poli)){
                    $huruf = $data['loket'];
                    $nama = $data['nama'];
                    $idpoli = $data['id_poli'];
                    
                    $query = mysqli_query($connection, "SELECT *, COUNT(no_antrian) as no_antrianTerbesar FROM antrian WHERE no_antrian LIKE '$huruf%' GROUP BY id_poli");
                    $antri = mysqli_fetch_array($query);
                    $no_antrianpoli = isset($antri['no_antrianTerbesar']) == null ?  1 : $antri['no_antrianTerbesar'];
                    $urutan = (int) substr($no_antrianpoli, 1, 3);
                    $urutan++;
                    $no_antrianpoli = $huruf . sprintf("%03s", $no_antrianpoli);

                    if ($newrow) {
                        echo '<div class="col text-center">';
                        $newrow = false;
                    }
            ?>
                <div onclick="update(this)" data-idpoli="<?= $idpoli; ?>" data-loket="<?= $huruf; ?>" data-nama="<?= $nama; ?>" data-antrian="<?= $no_antrianpoli; ?>">
                    <div class="card text-bg-success mb-3 " style="width: 275px;height: 200px; cursor: pointer;">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <h4 class="card-title text-uppercase" id=""><?= $nama; ?></h4>
                                <br>
                                <h4 class="card-title text-uppercase" id=""><?= $no_antrianpoli; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                    
            <?php
                    $i++;
                    if ($i == 2) {
                        echo '</div>';
                        $newrow = true;
                        $i = 0;
                    }
                }
            ?>
</section>
</body>
<script src="../assets/js/jquery-3.6.0.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>
<script>
    //-----KONFIGURASI FIREBASE-----
    var Config = {
        apiKey: "AIzaSyD7ZByCdIRx7B_lIwYGcX4J9NG9_PkxxL0",
        authDomain: "siantri.firebaseapp.com",
        databaseURL: "https://siantri-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "siantri",
        storageBucket: "siantri.appspot.com",
        messagingSenderId: "106626247639",
        appId: "1:106626247639:web:e873bd63c82515d794f992",
        measurementId: "G-0KYBJYRPEQ"
    };
    firebase.initializeApp(Config);
    var db = firebase.database();
    var antrianFR = db.ref("antrian");

    function update(el) {
        let id = $(el).data("idpoli");
        let noantri = $(el).data("antrian");
        let loket = $(el).data("loket");
        let poli = $(el).data("nama");
        
        if(confirm('Yakin?') == true) {
            $.ajax({
                url: "create.php",
                method: "POST",
                data: {id: id, noantri: noantri},
                cache: "false", 
                success: function(y){
                    window.open(`cetak.php?poli=${poli}&antri=${noantri}&loket=${loket}`, 'print karcis', "width=500,height=500");
                },
                error: function(){
                    swal({title: "Gagal", text: "API Tidak Terhubung", icon: "error"});
                }
            })
        } else {
            alert('tidak jadi cetak nomor antrian')
        }
    }

    // function update(el) {
    //     let id = $(el).data("idpoli");
    //     let noantri = $(el).data("antrian");
    //     let loket = $(el).data("loket");
    //     let poli = $(el).data("nama");
    //     // if(confirm('Yakin?') == true) {
    //         $.ajax({
    //             url: "create.php",
    //             method: "POST",
    //             data: {id: id, noantri: noantri},
    //             cache: "false", 
    //             success: function(y){
    //                 // if(y == 1){
    //                 //     db.ref("antrian/" + id).set({
    //                 //         no_antrian: noantri,
    //                 //         nama: poli,
    //                 //         loket: loket
    //                 //     }, (error) => {
    //                 //         if (error) {
    //                 //             alert("Gagal");
    //                 //         } else {
    //                 //             alert("Berhasil");
    //                 //             window.location = "";
    //                 //         }
    //                 //     });
    //                 // }else{
    //                 //     alert("sistem error");
    //                 // }  
    //                 alert('berhasail menambahkan');     
    //             },
    //             error: function(){
    //                 swal({title: "Gagal", text: "API Tidak Terhubung", icon: "error"});
    //             }
    //         })
    //     // }  else {
    //     //     return false;
    //     // }
    //     // db.ref("antrian/" + id).set({
    //     //     no_antrian: noantri,
    //     //     nama: poli,
    //     //     loket: loket
    //     // }, (error) => {
    //     //     if (error) {
    //     //         alert("Gagal");
    //     //     } else {
    //     //         alert("Berhasil");
    //     //     }
    //     // });
    // }


</script>