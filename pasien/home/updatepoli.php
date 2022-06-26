<?php
    require_once '../../admin/helper/connection.php';
    
    $poli = mysqli_query($connection, "SELECT * FROM poli ORDER BY id_poli ASC");
    while($data =  mysqli_fetch_array($poli)) {
        $nama = $data['nama']; // nama poli
        $huruf = $data['loket']; // loket poli
        
        $query = mysqli_query($connection, "SELECT *, COUNT(no_antrian) as no_antrianTerbesar FROM antrian WHERE no_antrian LIKE '$huruf%' GROUP BY id_poli");
        $antri = mysqli_fetch_array($query);
        $no_antrianpoli = isset($antri['no_antrianTerbesar']) == null ? 0 : $antri['no_antrianTerbesar'];
        $urutan = (int) substr($no_antrianpoli, 1, 3);
        $urutan++;
        $no_antrianpoli = $huruf . sprintf("%03s", $no_antrianpoli);



        

    }

    
    

?>