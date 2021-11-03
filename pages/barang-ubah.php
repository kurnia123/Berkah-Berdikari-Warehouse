<!-- 
    created by Helmyawan for Consonant
    @ 2021
 -->
 <?php

    require '../conf/init.php' ;
    cek();

    $sql_satuan_barang = 'SELECT * FROM satuan_barang';
    $res_satuan_barang = query($sql_satuan_barang);

    if (isset($_POST['simpan'])){
        $proid = $_GET['i'];
        $pronama = $_POST['pronama'] ;
        $proharga = $_POST['proharga'] ;
        $projumlah = $_POST['projumlah'] ;
        $prosupplier = $_POST['prosupplier'] ;
        $protanggal = date("Y-m-d H:i:s") ;
        $prosatuan = $_POST['sb'] ;

        // Cek Satuan Barang
        $sql_satuan_barang = "SELECT * FROM satuan_barang WHERE satuan=LOWER('$prosatuan')";

        if (total($sql_satuan_barang) == 0) {
            $sql_satuan_barang = "INSERT INTO satuan_barang VALUES (LOWER('$prosatuan'))";
            query($sql_satuan_barang);
        }
        // End Cek Satuan Barang

        if (empty($pronama) || empty($proharga) || empty($projumlah)){
            echo 'Harap masukkan data dengan benar' ;
        } else {
            $sql = "update produk set pronama='$pronama',proharga=$proharga,projumlah=$projumlah, protanggal='$protanggal',prosupplier='$prosupplier',prosatuan='$prosatuan' where proid='$proid'" ;
            echo $sql ;
            if (query($sql)){
                header("Location: {$base_url}pages/barang.php");
            } else {
                echo 'Gagal Mengubah Data ! Harap masukkan data dengan benar' ;
            }
        }
    }

    $proid = $_GET['i'] ;
    if (empty($proid)) header("Location: {$base_url}pages/barang.php");


    $sql = "SELECT * FROM produk WHERE proid='$proid'" ;
    $res = query($sql) ;
    $tot = total($sql) ;

    if ($tot == 0) header("Location: {$base_url}pages/barang.php");

    $row = mysqli_fetch_assoc($res) ;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ubah Produk - Consonant</title>
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
                    <h3 class="text-dark mb-4">Ubah Barang</h3>
                    <div class="row mb-3">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-body">
                                            <form method="POST" autocomplete="on">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="email"><strong>Nama Produk</strong></label><input class="form-control" type="text" placeholder="Nama Produk" value="<?= $row['pronama'] ;?>" name="pronama"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="last_name"><strong>Harga</strong><br></label><input class="form-control" type="number" placeholder="Harga" value="<?= $row['proharga'] ;?>" name="proharga"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="sb"><strong>Satuan Barang</strong></label>
                                                            <input list="sb" class="form-control" type="text" placeholder="Satuan Barang" value="<?= $row['prosatuan'] ;?>" name="sb" required>
                                                            <datalist id="sb">
                                                                <?php
                                                                    while($rowSb = mysqli_fetch_assoc($res_satuan_barang)){
                                                                        ?>
                                                                            <option value="<?=ucwords($rowSb['satuan'])?>">
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="last_name"><strong>Stok</strong></label><input class="form-control" type="number" placeholder="Sisa Stok" value="<?= $row['projumlah'] ;?>" name="projumlah"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="email"><strong>Nama Supplier</strong></label><input class="form-control" type="text" placeholder="Nama Supplier" value="<?= $row['prosupplier'] ;?>" name="prosupplier" required></div>
                                                    </div>
                                                </div>
                                                <div class="form-group"><input class="btn btn-primary btn-sm" type="submit" name="simpan" style="margin-top: 10px;background-color: #1cc88a;" value="Simpan" /></div>
                                            </form>
                                        </div>
                                    </div>
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