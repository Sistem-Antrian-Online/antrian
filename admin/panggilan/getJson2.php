<?php 
    require_once '../helper/connection.php';

    $id = $_GET['id'];
    // $loket = $_GET['loket'];

    $sql = "SELECT no_antrian, status, MIN(no_antrian) AS antrian_panggil FROM antrian WHERE STATUS = 'Dilayani' AND id_poli = $id LIMIT 1";
    $query = mysqli_query($connection, $sql);

    $res = array();
    $res['data'] = array(); 
    while($d = mysqli_fetch_array($query)) {
        
        $nomor_dilayani = isset($d['antrian_panggil']) ? $d['antrian_panggil'] : '---';
        // $nomor_dilayani = $d['antrian_panggil'];

        $data['nomor_dilayani'] = $nomor_dilayani;
        $data['status'] = $d['status'];
        $data['message'] = 'Data Ada!';
        array_push($res['data'], $data); 
    }

    echo json_encode($res);




?>