<?php 
    require_once '../helper/connection.php';

    $id = $_GET['id'];
    $loket = $_GET['loket'];

    // antrian 
    $sql = "SELECT *, MIN(no_antrian) AS antrian, COUNT(no_antrian) AS sisa_antrian FROM antrian WHERE status = 'Belum' AND no_antrian LIKE '%$loket%' AND id_poli = '$id' LIMIT 1";
    $query = mysqli_query($connection, $sql);

    $res = array();
    $res['data'] = array(); 
    while($d = mysqli_fetch_array($query)) {
        $antrian = isset($d['antrian']) ? $d['antrian'] : '000';
        $sisa = isset($d['sisa_antrian']) ? $d['sisa_antrian'] : 0;
        $data['antrian'] = $antrian;
        $data['sisa_antrian'] = $sisa;
        $data['message'] = 'Antrian Belum Dilayani';
        array_push($res['data'], $data); 
    }

    echo json_encode($res);





?>