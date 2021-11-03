<!-- 
    created by Helmyawan for Consonant
    @ 2021
 -->
 <?php

    require('../conf/init.php');
    cek();
    
    $tanggal = date("Y-m-d") ;
    $trapelanggan = isset($_POST['trapelanggan']) ? $_POST['trapelanggan'] : "" ;

    if (isset($_POST['simpan'])){
        $cart = $_SESSION['cart'] ;
        $trafaktur = getTransFaktur("TRANS") ;
        $user = $_SESSION['user'] ;
        $userid= $user['userid'] ;
        $err = 0 ;
        $grandtotal = 0 ;

        start() ;

        if (empty($trapelanggan)){
            $msg = 'Harap masukkan data dengan benar' ;
        } else if (count($cart) == 0){
            $msg = 'Keranjang Kosong' ;
        } else {
            
            for($i=0;$i <count($cart);$i++){
                $proid = $cart[$i]['proid'];
                $harga = $cart[$i]['proharga'];
                $jumlah = $_POST['jmlBarang'][$i];
                $sub = $harga * $jumlah ;
                $tdId = getFaktur("TDID");
                $sql = "INSERT INTO transaksi_detail (tdid,trafaktur,proid,tdjumlah,tdharga,tdsubtotal) values ('$tdId','$trafaktur','$proid',$jumlah,$harga,$sub)" ;
                if (!query($sql)){
                    $err += 1;
                }
                $grandtotal += $sub ;

                // $msg = $sql . '<br>' ;
            }

            $sql = "INSERT INTO transaksi values ('$trafaktur','$tanggal','$trapelanggan',$grandtotal,$userid)" ;

            if (query($sql) && $err == 0){
                commit();
                unset($_SESSION['cart']);
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                echo '<strong>Transaksi Berhasil</strong> Barang sudah terproses';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
                echo '</div>';
            } else {
                rollback();
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                echo '<strong>Transaksi Gagal</strong> Terjadi kesalahan penjualan barang';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
                echo '</div>';
            }
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Penjualan - Consonant</title>
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
                            <li><a class="nav-link active" href="transaksi.php">Barang Keluar</a></li>
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
                    <h3 class="text-dark mb-4">Penjualan</h3>
                    <form method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Detail Penjualan</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group"><label for="address"><strong>Nama Pelanggan</strong><br></label><input class="form-control nama-pelanggan" type="text" placeholder="Nama Pelanggan" value="<?= $trapelanggan ?>" name="trapelanggan" required></div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group"><label for="city"><strong>No Faktur</strong></label><input class="form-control no-faktur" type="text" name="trafaktur" disabled value=<?= getTransFaktur("TRANS") ; ?>></div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group"><label for="country"><strong>Tanggal</strong></label><input class="form-control" type="text" disabled value=<?= $tanggal ?>></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Data Keranjang</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Produk</th>
                                                        <th>Jumlah</th>
                                                        <th>Satuan</th>
                                                        <th>Harga</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    
                                                    if (empty($_SESSION['cart'])) {
                                                        $cart = [];
                                                    } else {
                                                        $cart = $_SESSION['cart'];
                                                    }
                                                    
                                                    $total = 0 ;

                                                    if ($cart){
                                                        foreach($cart as $i => $val){
                                                            ?>
                                                                <tr>
                                                                    <td><?= $val['pronama'] ?></td>
                                                                    <td>
                                                                        <input class="jml-barang" type="number" value="<?= (int)$val['jumlah'] ?>" min="0" max="<?= (int)$val['projumlah'] ?>" name="jmlBarang[]">
                                                                    </td>
                                                                    <td><?= $val['prosatuan'] ?></td>
                                                                    <td class="harga-barang"><?= number_format($val['proharga'],2) ?></td>
                                                                    <td><a href="transaksi-hapus.php?p=<?= $val['proid']?>" class="btn btn-primary" style="background-color: #e74a3b;">Hapus</a></td>
                                                                </tr>
                                                            <?php
                                                            $total += $val['proharga'] * $val['jumlah'] ;
                                                        }
                                                    }
                                                    ?>
                                                    <tr></tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>Jumlah Pembelanjaan :</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="grand-total"><?= number_format($total,2) ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col"><a href="transaksi-pilih.php" class="btn btn-primary" style="width: 100%;background-color: #36b9cc;">Pilih Produk</a></div>
                                    <div class="col"><input class="btn btn-primary btn-simpan" type="submit" style="width: 100%;background-color: #1cc88a;" name="simpan" value="Simpan" /></div>
                                </div>
                            </div>
                        </div>
                    </form>
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