<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="asset/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>RSUD JOMBANG</title>
    <link rel="stylesheet" href="asset/css/font.css">
    <link rel="stylesheet" href="asset/css/style3.css">
  </head>
  <body>

  <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparant">
        <div class="container-fluid">
            <div class="navbar-brand">
                <img src="asset/img/icon-hospital.png" alt="" width="30" class="d-inline-block">
                RSUD JOMBANG
            </div>
        </div>
    </nav>
  <!-- akhir navbar -->

  <!-- Content  -->
  <div class="container">
    <div class="row">
      <div class="col-sm-12 mb-3">
        <!-- <input type="text" id="myFilter" class="form-control" onkeyup="myFunction()" placeholder="Cari Poli..."> -->
      </div>
    </div>
    <div class="row" id="myItems">
      <div class="col-sm-12 mb-3">
        <div class="bacadata">
        
        </div>
      </div>    
    </div>
  </div>
  <!-- Akhir Content -->


  <script src="asset/js/jquery-3.6.0.js"></script>
  <script src="asset/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>
  <script type="module">
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

    var bacadata = document.querySelector('.bacadata');

    // baca data firebase
    antrianFR.on('value', bacaData);
    function bacaData(snap) {
      let card = '';
      snap.forEach(kolom => {
        let loket = kolom.val().loket;
        let poli = kolom.val().nama;
        let nomorAntrian = kolom.val().no_antrian;
        // console.log(poli);

        card += `<div class="poli card shadow rounded position-relative">
                    <img src="asset/img/icon.png" alt="icon" class="position-absolute">
                    <div class="bg-poli position-relative">
                      <h5 class="card-title position-absolute start-50 top-50 translate-middle">Loket ${loket}</h5>
                    </div>
                    <div class="bg-nomor-antrian">
                      <h6 class="card-subtitle mb-2">${nomorAntrian}</h6>
                      <p class="card-text">${poli}</p>
                    </div>
                </div>`; 
      });

      bacadata.innerHTML = card;
    }  
  </script>
  </body>
</html>