<!-- 
    created by Helmyawan for Consonant
    @ 2021
 -->
 <?php
    require '../conf/init.php' ;
    cek();

    $cari = "" ;
    $startDate = "";
    $endDate = date("Y-m-d");
    $sort = "";
    
    // Get Query Cari
    if (isset($_GET['c'])) {
        $cari = $_GET['c'];
    }

    // Get Query limit date
    if (isset($_GET['startDate'], $_GET['endDate']) && $_GET['endDate'] != '') {
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
    } else {
        $endDate = date("Y-m-d");
    }

    // Get Sort
    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
    }

    $sql = "SELECT trafaktur, trapelanggan, tratanggal, tratotal, (SELECT sum(tdjumlah) FROM transaksi_detail WHERE trafaktur=t.trafaktur ) AS jumbarang, username
            FROM transaksi t 
            INNER JOIN user u ON u.userid = t.userid
            WHERE (trafaktur LIKE '%$cari%' OR
            trapelanggan LIKE '%$cari%') AND
            tratanggal BETWEEN '$startDate' AND '$endDate'
            ORDER BY tratotal $sort";
    
    $res = query($sql) ;
    $count = total($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Laporan Penjualan - Consonant</title>
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
                            <li><a class="nav-link active" href="laporan-keluar.php">Barang Keluar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="about.php"><i class="icon-info" style="font-size: 20px;"></i><span style="font-size: 18px;margin-left: 10px;">Tentang Saya</span></a></li>
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
                    <h3 class="text-dark mb-4">Data Penjualan</h3>
                    <div class="card shadow">
                        <form class="card-body">
                            <div class="row">
                                <div class="col-md-3 text-nowrap">
                                    <a class="btn btn-success" href="../utils/export-laporan-keluar-barang.php">Export Excel</a>
                                    <a href="./laporan-keluar.php" class="btn btn-primary" title="Refresh">
                                        <i class="fas fa-redo-alt"></i>
                                    </a>
                                </div>
                                <div class="col-md-6 text-nowrap">
                                    <div class="form-row">
                                        <span class="align-self-center">From</span>
                                        <div class="col-sm-5">
                                            <input type="date" class="form-control datefield" placeholder="Date" name="startDate">
                                        </div>
                                        <span class="align-self-center">To</span>
                                        <div class="col-sm-5">
                                            <input type="date" class="form-control datefield" placeholder="To" name="endDate" value="<?= $endDate ?>">
                                        </div>
                                        <button class="btn btn-dark" type="submit" title="Filter"><i class="fas fa-filter"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-3 text-md-right">
                                    <label class="sr-only" for="inlineFormInputGroupUsername">Cari Barang</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                                        </div>
                                        <input type="search" id="inlineFormInputGroupUsername" class="form-control form-control" value="<?= $cari?>" placeholder="Cari Pelanggan & Transaksi" name="c">
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">No. Faktur</th>
                                            <th scope="col">Pelanggan</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Jum. Barang</th>
                                            <th scope="col">
                                                <div class="row">
                                                    <div class="col align-self-center">
                                                        Jum. Bayar
                                                    </div>
                                                    <div class="col">
                                                        <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-sort text-gray-400"></i></button>
                                                            <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in" role="menu">
                                                                <p class="text-center dropdown-header">Sortt By:</p>
                                                                <div class="dropdown-item sort" role="presentation" sort="DESC" style="cursor: pointer;"><i class="fas fa-sort-alpha-up-alt"></i>&nbsp; Descending</div>
                                                                <div class="dropdown-item sort" role="presentation" sort="ASC" style="cursor: pointer;"><i class="fas fa-sort-alpha-down"></i>&nbsp; Ascending</div>
                                                                <input type="hidden" class="sort-input" name="sort">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope="col">Operator</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $no = 1 ;
                                        while($row = mysqli_fetch_assoc($res)){
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><a href="./laporan-detail-keluar.php?transid=<?= $row['trafaktur'] ;?>" title="Detail Transaksi"><?= $row['trafaktur'] ;?></a></td>
                                                    <td><?= $row['trapelanggan'] ;?></td>
                                                    <td><?= $row['tratanggal'] ;?></td>
                                                    <td><?= $row['jumbarang'] ;?></td>
                                                    <td><?= number_format($row['tratotal'],2) ;?></td>
                                                    <td><?= $row['username'] ;?></td>
                                                </tr>
                                            <?php
                                            $no += 1 ;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Menampilkan <?= $count ;?> Data</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination"></ul>
                                    </nav>
                                </div>
                            </div>
                        </form>
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