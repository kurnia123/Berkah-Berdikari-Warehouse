<!-- 
    created by Helmyawan for Consonant CO
    @ 2021
 -->
 <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tentang Consonant!</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css?h=3c16114e461561544db42dd299b535e5">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css?h=d41d8cd98f00b204e9800998ecf8427e">
    <link rel="stylesheet" href="../assets/css/main.css">
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
                    <li class="nav-item" role="presentation"><a class="nav-link" href="../index.php"><i class="fas fa-tachometer-alt" style="font-size: 20px;"></i><span style="margin-left: 10px;font-size: 18px;">Dashboard</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="barang.php"><i class="icon-layers" style="font-size: 20px;"></i><span style="margin-left: 10px;font-size: 18px;">Data Barang</span></a></li>
                    <li class="nav-item accordion-item">
                        <a class="nav-link accordion-header" type="button" id="headingTransaksi" data-bs-toggle="collapse" data-bs-target="#collapseTransaksi" aria-expanded="true" aria-controls="collapseTransaksi">
                            
                            <i class="fas fa-money-bill-wave" style="font-size: 20px;"></i>
                            <span class="accordion-button" style="margin-left: 4px;font-size: 18px;">
                                Transaksi
                                <i class="fas fa-angle-right" style="margin-left: 40px;font-size: 18px;"></i>
                            </span>
                        </a>
                        <ul id="collapseTransaksi" class="accordion-collapse collapse" aria-labelledby="headingTransaksi" data-bs-parent="#accordion-sidenav">
                            <li><a class="nav-link" href="./barang-tambah.php">Barang Masuk</a></li>
                            <li><a class="nav-link" href="transaksi.php">Barang Keluar</a></li>
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
                            <li><a class="nav-link" href="./laporan-masuk.php">Barang Masuk</a></li>
                            <li><a class="nav-link" href="laporan-keluar.php">Barang Keluar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="about.php"><i class="icon-info" style="font-size: 20px;"></i><span style="font-size: 18px;margin-left: 10px;">Tentang Saya</span></a></li>
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
                    <h3 class="text-dark mb-4">Tentang Consonant</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="../assets/img/about.png?h=a0a7d00bcd8e4f84f4d8ce636a8f94d4" width="160" height="160"></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3"></div>
                                    <header></header>
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Helmyawan S.N</h4>
                                            <h6 class="text-muted card-subtitle mb-2" style="margin-bottom: 0px;">Develop For Consonant!</h6>
                                            <p class="card-text">Yogyakarta - Indonesia</p>
                                            <p class="card-text">Contact us at&nbsp;</p><a>helmyawan.works@gmail.com</a></div>
                                    </div>
                                    <div class="card shadow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Berkah Berdikari Warehouse</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="../assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
    <script src="../js/app.js" type="module"></script>
</body>

</html>