<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="asset/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Antrian Rumah Sakit Online</title>
    <link rel="stylesheet" href="asset/css/font.css">
    <link rel="stylesheet" href="asset/css/style2.css">
    <link rel="stylesheet" href="asset/css/owl.carousel.min.css">
  </head>
  <body>
    
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-transparant">
    <div class="container-fluid">
      <div class="navbar-brand text-bold text-white">
        <img src="asset/img/icon-hospital.png" alt="" width="60" class="d-inline-block">
        RSUD JOMBANG
      </div>
      <div>
        <div class="waktu-tgl text-bold text-white btn btn-info"></div>
      </div>
    </div>
  </nav>
  <!-- akhir navbar -->

  <!-- content -->
  <div class="container-fluid mt-2" >
    <div class="row content">
      <div class="col-xl-6 col-sm-4">
        <video class="shadow-sm" muted autoplay loop>
          <source src="asset/vid/vid-3.mp4">
        </video>
      </div>
      <div class="col-xl-6 col-sm-4">
        <div class="panggilan-antrian shadow rounded position-relative">
          <img src="asset/img/icon.png" alt="icon" class="position-absolute">
          <div class="bg-loket position-relative">
            <p class="position-absolute start-50 top-50 translate-middle">Loket A</p>
          </div>
          <div class="bg-nomor position-relative">
            <p class="position-absolute start-50 top-50 translate-middle text-info">B001</p>
          </div>
          <div class="bg-poli position-relative">
            <p class="position-absolute start-50 top-50 translate-middle">Poli Anak</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- akhir content -->

  <!-- data antrian poli -->
  <div class="container-fluid" style="margin-top: -4.8rem;">
    <div class="data-antrian owl-carousel" id="bacadata">
    </div>
  </div>
  <!-- akhir data antrian poli -->


  <!-- footer -->
  <footer style="margin-top: 1rem;">
    <div class="col-md-12 text-white p-3" style="background-color: black;letter-spacing: 5px;">
      <marquee behavior="" direction="">SELAMAT DATANG DI RSUD JOMBANG JL.Sudirman No.35 KAB.JOMBANG</marquee>         
    </div>
  </footer> 
  <!-- akhir footer -->


  <script src="asset/js/jquery-3.6.0.js"></script>
  <script src="asset/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="asset/js/owl.carousel.min.js"></script>
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

    var bacadata = document.getElementById('bacadata'); 
    var namaPoli1 = document.getElementById('poli');
    var nomor1 = document.getElementById('nomor-antrian');    

    // baca data firebase
    antrianFR.on('value', bacaData);
    function bacaData(snap) {
      let card = '';

      snap.forEach(kolom => {
        let loket = kolom.val().loket;
        let poli = kolom.val().nama;
        let nomorAntrian = kolom.val().no_antrian;

        card += `<div id="antrian"  class="shadow rounded position-relative">
                  <img src="asset/img/icon.png" alt="icon" class="position-absolute">
                  <div class="bg-antrian-poli position-relative text-white"> 
                    <p class="position-absolute start-50 top-50 translate-middle">${poli}</p>
                  </div>
                  <div class="bg-nomor-antrian position-relative text-info">
                    <p class="position-absolute start-50 top-50 translate-middle">${nomorAntrian}</p>
                  </div>
                </div>`;
      }); 
      bacadata.innerHTML = card;  

      $('.data-antrian').owlCarousel({
        autoplay: true,
        loop: true,
        
      });
    }

    function showTime() {
          let hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
          let bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
          let date = new Date();
          let day = date.getDay();
          let year = date.getYear();
          let month = date.getMonth();
          let Hari = hari[day];
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
          
          h = (h < 10) ? "0" + h : h;
          m = (m < 10) ? "0" + m : m;
          s = (s < 10) ? "0" + s : s; 
          var time = h + ":" + m + ":" + s + " " + session;

          // console.log(Hari+", "+day+' '+Bulan+" "+Tahun+" "+time);
          let hariTgl = Hari+", "+day+' '+Bulan+" "+Tahun+" "+time;
          $('.waktu-tgl').html(hariTgl);
          setTimeout(showTime, 1000);
        }
        showTime()
        
  </script>
  </body>
</html>