<?php
$title = 'Ubah data transaksi';
require 'functions.php';
$db = dbConnect();
$id = base64_decode($_GET['id']);
$menu = get_data($conn, "SELECT * FROM menu");
$query = "SELECT * FROM transaksi WHERE id_transaksi = '$id'";
$data = row_array($conn, $query);

if (isset($_POST['btn_simpan'])) {
    if ($db->errno == 0) {
        $invoice = $_POST['invoice'];
        $tgl = Date('Y-m-d h:i:s');
        $nm_karyawan = $_SESSION['nm_karyawan'];
        $pelanggan = $db->escape_string($_POST['pelanggan']);
        $id_menu = $_POST['id_menu'];
        $nm_menu = $_POST['nm_menu'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $total = $_POST['harga'] * $_POST['jumlah'];

        $query = "UPDATE transaksi SET invoice ='$invoice', tgl='$tgl', nm_karyawan='$nm_karyawan', nm_pelanggan='$pelanggan', id_menu='$id_menu', nm_menu='$nm_menu', harga='$harga', jumlah='$jumlah', total='$total'
                WHERE id_transaksi='$id'";

        $execute = execute($conn, $query);
        if ($execute == 1) {
            header('location:transaksi.php?msg=2');
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
                        <input type="text" name="invoice" class="form-control" value="<?= $data['invoice']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <input type="text" name="pelanggan" class="form-control" maxlength="30" value="<?= $data['nm_pelanggan']; ?>" required oninvalid="this.setCustomValidity('Silahkan isi nama pelanggan')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label>Menu</label>
                        <select id="id_menu" name="id_menu" class="form-control">
                            <?php foreach ($menu as $m) : ?>
                                <?php if ($m['id_menu'] == $data['id_menu']) : ?>
                                    <option value="<?= $m['id_menu']; ?>" selected><?= $m['nm_menu']; ?></option>
                                <?php else : ?>
                                    <option value="<?= $m['id_menu']; ?>"><?= $m['nm_menu']; ?></option>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group hidden">
                        <select id="nm_menu" name="nm_menu" class="form-control">
                            <?php foreach ($menu as $m) : ?>
                                <?php if ($m['nm_menu'] == $data['nm_menu']) : ?>
                                    <option value="<?= $m['nm_menu']; ?>" selected></option>
                                <?php else : ?>
                                    <option value="<?= $m['nm_menu']; ?>"></option>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <select id="harga" name="harga" class="form-control">
                            <?php foreach ($menu as $m) : ?>
                                <?php if ($m['harga'] == $data['harga']) : ?>
                                    <option value="<?= $m['harga']; ?>" selected>Rp <?= $m['harga']; ?></option>
                                <?php else : ?>
                                    <option value="<?= $m['harga']; ?>">Rp <?= $m['harga']; ?></option>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" max="99999" value="<?= $data['jumlah']; ?>" required oninvalid="this.setCustomValidity('Silahkan masukkan jumlah antara 1 sampai 99999')" oninput="setCustomValidity('')">
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