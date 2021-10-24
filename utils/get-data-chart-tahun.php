<?php
date_default_timezone_set('Asia/Jakarta');

$host = "localhost" ;
$user = "root" ;
$pass = "" ;
$debe = "db_toko" ;

$koneksi = mysqli_connect($host,$user,$pass,$debe) ;

function query($sql){
    global $koneksi ;

    return mysqli_query($koneksi, $sql) ;
}

function getDataYear() {
    $sql = "SELECT MONTH(tratanggal) AS bulan, SUM(tratotal) AS omset
                FROM transaksi
                WHERE YEAR(tratanggal)=YEAR(NOW())
                GROUP BY MONTH(tratanggal)
                ORDER BY bulan;";

    $resChartData = query($sql);
    $dataChart = array();

    while ($rowCD = mysqli_fetch_assoc($resChartData)) {
        $dataChart[strval($rowCD["bulan"])] = $rowCD["omset"];
    }

    for ($i=1; $i <= 12; $i++) { 
        if (!array_key_exists(strval($i), $dataChart)) {
            $dataChart[strval($i)] = "";
        }
    }
    ksort($dataChart);
    
    foreach ($dataChart as $key => $value) {
        $month = date("F", mktime(0, 0, 0, (int)$key, 10));
        $dataChart[$month] = $dataChart[$key];
        unset($dataChart[$key]);
    }
    
    return $dataChart;
}

echo json_encode(getDataYear());
mysqli_close($koneksi);
?>