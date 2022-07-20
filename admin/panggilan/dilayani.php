<?php 
require_once '../helper/connection.php';

    if(isset($_POST['nomor'])) {
        $nomor = $_POST['nomor'];
        $antrian_lanjut = "UPDATE antrian SET status = 'Dilayani' WHERE no_antrian = '$nomor'";
        mysqli_query($connection, $antrian_lanjut);
    }
?>