<?php
date_default_timezone_set('Asia/Jakarta');

$host = "localhost" ;
$user = "root" ;
$pass = "";
$debe = "db_toko" ;

$koneksi = mysqli_connect($host,$user,$pass,$debe) ;

function query($sql){
    global $koneksi ;

    return mysqli_query($koneksi, $sql) ;
}

function getDataMonth() {
    $sql = "SELECT DAY(tratanggal) AS hari, SUM(tratotal) AS omset
                    FROM transaksi
                    WHERE MONTH(tratanggal)=MONTH(NOW())
                    GROUP BY DAY(tratanggal)
                    ORDER BY hari;";

    $resChartData = query($sql);
    $dataChart = array();

    while ($rowCD = mysqli_fetch_assoc($resChartData)) {
        $dataChart[strval($rowCD["hari"])] = $rowCD["omset"];
    }

    $dayMonth = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));

    for ($i=1; $i <= $dayMonth; $i++) { 
        if (!array_key_exists(strval($i), $dataChart)) {
            $dataChart[strval($i)] = "";
        }
    }
    ksort($dataChart);

    return $dataChart;
}

echo json_encode(getDataMonth());
mysqli_close($koneksi);
?>