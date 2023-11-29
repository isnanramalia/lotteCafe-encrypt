<?php
$title = 'Dashboard';
require 'functions.php';
require 'layout_header.php';
$query = "SELECT * FROM transaksi";
$data = get_data($conn, $query);
?>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">admin</h3>
                <ul class="list-inline two-part">
                    <li>
                        <i class="fas fa-user-cog"></i>
                    </li>
                    <li class="text-right">
                        <span class="counter text-black">
                            <?php
                            $query = "SELECT COUNT(id_karyawan) FROM karyawan WHERE jabatan='Admin'";
                            $result = row_array($conn, $query);
                            ?>
                            <?= $result['COUNT(id_karyawan)']; ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">kasir</h3>
                <ul class="list-inline two-part">
                    <li>
                        <i class="fas fa-user-edit"></i>
                    </li>
                    <li class="text-right">
                        <span class="counter text-black">
                            <?php
                            $query = "SELECT COUNT(id_karyawan) FROM karyawan WHERE jabatan='Kasir'";
                            $result = row_array($conn, $query);
                            ?>
                            <?= $result['COUNT(id_karyawan)']; ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Menu</h3>
                <ul class="list-inline two-part">
                    <li>
                        <i class="fas fa-book-open"></i>
                    </li>
                    fg
                    <li class="text-right">
                        <span class="counter text-black">
                            <?php
                            $query = "SELECT COUNT(id_menu) FROM menu";
                            $result = row_array($conn, $query);
                            ?>
                            <?= $result['COUNT(id_menu)']; ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">transaksi</h3>
                <ul class="list-inline two-part">
                    <li>
                        <img src="../assets/images/cafe/rupiah-sign.svg" alt="rupiah" width="20">
                    </li>
                    <li class="text-right">
                        <span class="counter text-black">
                            <?php
                            $query = row_array($conn, "SELECT SUM(total) as total FROM transaksi");
                            ?>
                            <?= number_format($query['total']); ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Transaksi</h3>
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="hidden"></th>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data as $transaksi) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td class="hidden"><?= $transaksi['id_transaksi']; ?></td>
                                    <td><?= $transaksi['invoice']; ?></td>
                                    <td><?= $transaksi['tgl']; ?></td>
                                    <td><?= $transaksi['nm_pelanggan']; ?></td>
                                    <td>Rp <?= number_format($transaksi['total'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require 'layout_footer.php';
?>