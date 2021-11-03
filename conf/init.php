<?php
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    require ("globalvar.php");

    $host = "localhost" ;
    $user = "root" ;
    $pass = "" ;
    $debe = "db_toko" ;

    $koneksi = mysqli_connect($host,$user,$pass,$debe) ;

    if (!$koneksi){
        echo "<h1>KONEKSI GAGAL</h1>" ;
    } else {
        // echo 'KONEKSI BERHASIL' ;
    }

    function query($sql){
        global $koneksi ;

        return mysqli_query($koneksi, $sql) ;
    }

    function total($sql){
        global $koneksi ;

        $res = query($sql) ;
        return mysqli_num_rows($res) ;
    }

    function start(){
        query("START TRANSACTION") ;
    }

    function commit(){
        query("COMMIT") ;
    }

    function rollback(){
        query("ROLLBACK") ;
    }

    function getFaktur($signature){
        $no = $signature.bin2hex(random_bytes(2));

        if ($signature == "TDID") {
            $no = $signature.bin2hex(random_bytes(4));
        }

        return $no ;
    }

    function  getTransFaktur($signature){
        $uid = bin2hex(random_bytes(2));

        $noId = $signature.date("Ymd").$uid;
        return $noId ;
    }

    function cek(){
        global $base_url ;

        if (empty($_SESSION['user'])) header("Location:{$base_url}pages/login.php");
    }

    function logout(){
        session_unset();
    }

    function generatorChart($data, $k) {
        $numItems = count($data);
        $i = 0;
        foreach ($data as $key => $value) {
            if(++$i == $numItems) {
                if ($k) {
                    echo "$key";
                    break;
                }
                echo "$value";
                break;
            }

            if ($k) {
                echo "$key,";
            } else {
                echo "$value,";
            }
        }
    }
?>