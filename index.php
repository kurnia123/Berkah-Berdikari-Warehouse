<!-- 
    created by Helmyawan for Consonant
    @ 2021
 -->

<?php
    require './conf/init.php';
    cek();

    $tahun = date('Y');
    $bulan = date('m');
    $tanggal = date('Y-m-d');

    $sql = "select 
            (select count(proid) from produk) as totalbarang,
            (select sum(tratotal) from transaksi t where tratanggal='{$tanggal}') as hari,
            (select sum(tratotal) from transaksi t where month (tratanggal) = {$bulan} and year(tratanggal) = {$tahun}) as bulan" ;

    $res = query($sql);
    $row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Consonant</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=3c16114e461561544db42dd299b535e5">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css?h=d41d8cd98f00b204e9800998ecf8427e">
    <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body id="page-top">
    <div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" id="accordion-sidenav">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Consonant</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav text-light flex-column" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="../index.php"><i class="fas fa-tachometer-alt" style="font-size: 20px;"></i><span style="margin-left: 10px;font-size: 18px;">Dashboard</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="pages/barang.php"><i class="icon-layers" style="font-size: 20px;"></i><span style="margin-left: 10px;font-size: 18px;">Data Barang</span></a></li>
                    <li class="nav-item accordion-item" role="presentation">
                        <a class="nav-link accordion-header" type="button" id="headingTransaksi" data-bs-toggle="collapse" data-bs-target="#collapseTransaksi" aria-expanded="true" aria-controls="collapseTransaksi">
                            
                            <i class="fas fa-money-bill-wave" style="font-size: 20px;"></i>
                            <span class="accordion-button" style="margin-left: 4px;font-size: 18px;">
                                Transaksi
                                <i class="fas fa-angle-right" style="margin-left: 40px;font-size: 18px;"></i>
                            </span>
                        </a>
                        <ul id="collapseTransaksi" class="accordion-collapse collapse" aria-labelledby="headingTransaksi" data-bs-parent="#accordion-sidenav">
                            <li><a class="nav-link" href="pages/barang-tambah.php">Barang Masuk</a></li>
                            <li><a class="nav-link" href="pages/transaksi.php">Barang Keluar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link accordion-header" type="button" id="headingLaporan" data-bs-toggle="collapse" data-bs-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
                            <i class="icon-list" style="font-size: 20px;"></i>
                            <span class="accordion-button" style="font-size: 18px;margin-left: 10px;">
                                Laporan
                                <i class="fas fa-angle-right" style="margin-left: 40px;font-size: 18px;"></i>
                            </span>
                        </a>
                        <ul id="collapseLaporan" class="accordion-collapse collapse" aria-labelledby="headingLaporan" data-bs-parent="#accordion-sidenav">
                            <li><a class="nav-link" href="./pages/laporan-masuk.php">Barang Masuk</a></li>
                            <li><a class="nav-link" href="./pages/laporan-keluar.php">Barang Keluar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="pages/about.php"><i class="icon-info" style="font-size: 20px;"></i><span style="font-size: 18px;margin-left: 10px;">Tentang Saya</span></a></li>
                    <li class="nav-item" role="presentation"></li>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <div class="row">
                        <div class="col"><a href="logout.php" class="btn btn-primary" style="background-color: #e74a3b;"><i class="icon-logout" style="margin-right: 10px;font-size: 18px;"></i>Logout</a></div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top"></nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <!-- Start: Chart -->
                    <div class="row">
                        <div class="col-lg-7 col-xl-8" style="width: auto;">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center" style="width: auto;">
                                    <h6 class="text-primary font-weight-bold m-0 chart-header">Grafik Omset</h6>
                                    <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                        <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in"
                                            role="menu">
                                            <p class="text-center dropdown-header">Action Graph:</p>
                                            <a class="dropdown-item Minggu" role="presentation" href="#">&nbsp;Mingguan</a>
                                            <a class="dropdown-item Bulan" role="presentation" href="#">&nbsp;Bulanan</a>
                                            <a class="dropdown-item Tahun" role="presentation" href="#">&nbsp;Tahunan</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="#">&nbsp;Something else here</a></div>
                                    </div>
                                </div>
                                <div class="card-body" style="width: auto;">
                                    <div class="chart-area">
                                    <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-4" style="width: auto;">
                            <div class="card shadow border-left-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Jumlah produk</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span><?= $row['totalbarang']?> Produk</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow border-left-success py-2" style="margin-top: 10px;width: auto;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Omset hari ini</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span><?= number_format($row['hari'], 2) ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow border-left-info py-2" style="margin-top: 10px;width: auto;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Omset Bulan ini</span></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col"><span><?= number_format($row['bulan'], 2) ?></span></div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Consonant 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
    <script src="js/app.js" type="module"></script>
    <script src="js/chart-option.js" type="module"></script>
</body>

</html>