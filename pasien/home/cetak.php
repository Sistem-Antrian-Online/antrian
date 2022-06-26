<?php 
date_default_timezone_set("Asia/Jakarta");
$poli = $_GET['poli'];
$no_antrian = $_GET['antri'];
$loket = $_GET['loket'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            width: 25rem;
            height: 40rem;
            border: 1px solid;
        }

        .content h2{
            margin: 3rem;
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
        }

        .content hr {
            border: 1px solid black;
        }

        .content-poli {
            text-align: center;
        }

        .content-poli h1:nth-child(1) {
            font-size: 2.2rem;
        }

        .content-poli h1:nth-child(2) {
            font-size: 6rem;
        }

        .content-poli h3 {
            font-size: 2.5rem;
        }



    </style>
</head>
<body>

    <div class="container">
        <div class="content">
            <h2>RSUD JOMBANG</h2><hr>
            <div class="content-poli">
                <h1>Loket <?php echo $loket; ?></h1>
                <h1><?php echo $no_antrian; ?></h1>
                <h3><?php echo $poli; ?></h3>
                <h4>Jangan Sampai Hilang</h4>
            </div>
        </div>

    </div>

    <script>
        // window.print();
    </script>
</body>
</html>