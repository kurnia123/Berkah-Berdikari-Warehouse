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

function getDataWeek() {
    $sql = "SELECT DAY(tratanggal) AS hari, SUM(tratotal) AS omset
                FROM transaksi
                WHERE YEARWEEK(tratanggal)=YEARWEEK(NOW())
                GROUP BY DAY(tratanggal)
                ORDER BY hari;";

    $resChartData = query($sql);
    $dataChart = array();

    while ($rowCD = mysqli_fetch_assoc($resChartData)) {
        $dataChart[strval($rowCD["hari"])] = $rowCD["omset"];
    }

    $day = date('w');

    for ($i=0; $i < 7; $i++) {
        $week_num = date('d', strtotime('+'.($i-$day).' days'));
        if (!array_key_exists(strval($week_num), $dataChart)) {
            $dataChart[strval($week_num)] = [];
        }
    }    

    // ksort($dataChart);

    return $dataChart;
}

echo json_encode(getDataWeek());
mysqli_close($koneksi);
?>