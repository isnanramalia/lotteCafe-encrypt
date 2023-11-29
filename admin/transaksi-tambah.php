<?php
$title = 'Tambah transaksi';
require 'functions.php';
date_default_timezone_set("Asia/Jakarta");

$query = "SELECT * FROM menu";
$data = get_data($conn, $query);
$invoice = 'INV/' . Date('Ymdsi');
$db = dbConnect();

if (isset($_POST['btn_simpan'])) {
    if ($db->errno == 0) {
        $invoice = $_POST['invoice'];
        $tgl = Date('Y-m-d H:i:s');
        $nm_karyawan = $_SESSION['nm_karyawan'];
        $pelanggan = $db->escape_string($_POST['pelanggan']);
        $id_menu = $_POST['id_menu'];
        $nm_menu = $_POST['nm_menu'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $total =  $_POST['harga'] * $_POST['jumlah'];

        $query = "INSERT INTO transaksi (invoice,tgl,nm_karyawan,nm_pelanggan,id_menu,nm_menu,harga,jumlah,total)
                VALUES ('$invoice','$tgl','$nm_karyawan','$pelanggan','$id_menu','$nm_menu','$harga','$jumlah','$total')";

        $execute = execute($conn, $query);
        if ($execute == 1) {
            header('location:transaksi.php?msg=1');
        } else {
            header('location:transaksi.php?msg=4');
        }
    } else {
        echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
    }
}

require 'layout_header.php';
?>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= $title; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="">
                    <div class="form-group">
                        <label>No. Invoice</label>
                        <input type="text" name="invoice" class="form-control" value="<?= $invoice; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <input type="text" name="pelanggan" class="form-control" maxlength="30" required oninvalid="this.setCustomValidity('Silahkan isi nama pelanggan')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label>Menu</label>
                        <select id="id_menu" name="id_menu" class="form-control" required oninvalid="this.setCustomValidity('Silahkan pilih menu')" oninput="setCustomValidity('')">
                            <option value="">Pilih menu</option>
                            <?php foreach ($data as $menu) : ?>
                                <option value="<?= $menu['id_menu']; ?>"><?= $menu['nm_menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group hidden">
                        <select id="nm_menu" name="nm_menu" class="form-control">
                            <option value="">Pilih menu</option>
                            <?php foreach ($data as $menu) : ?>
                                <option value="<?= $menu['nm_menu']; ?>"></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <select id="harga" name="harga" class="form-control">
                            <option value="">Pilih harga</option>
                            <?php foreach ($data as $menu) : ?>
                                <option value="<?= $menu['harga']; ?>">Rp <?= $menu['harga']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" max="99999" required oninvalid="this.setCustomValidity('Silahkan masukkan jumlah antara 1 sampai 99999')" oninput="setCustomValidity('')">
                    </div>

                    <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" name="btn_simpan" class="btn btn-success text-right">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require 'layout_footer.php';
?>