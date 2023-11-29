<?php
$title = 'Tambah menu';
require 'functions.php';
$db = dbConnect();

if (isset($_POST['btn_simpan'])) {
    if ($db->errno == 0) {
        $menu = $db->escape_string($_POST['menu']);
        $harga = $db->escape_string($_POST['harga']);
        $deskripsi = $db->escape_string($_POST['deskripsi']);
        $stok = $db->escape_string($_POST['stok']);
        $tgl_input = Date('Y-m-d h:i:s');

        $query = "SELECT * FROM menu WHERE nm_menu = '$menu'";
        $data = row_array($conn, $query);
        if ($data['nm_menu'] == 0) {
            $query = "INSERT INTO menu (nm_menu,harga,deskripsi,stok,tgl_input)
                VALUES ('$menu','$harga','$deskripsi','$stok','$tgl_input')";

            $execute = execute($conn, $query);
            if ($execute == 1) {
                header('location:menu.php?msg=1');
            } else {
                header('location:menu.php?msg=5');
            }
        } else {
            header('location:menu.php?msg=4');
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
                        <label>Nama Menu</label>
                        <input type="text" name="menu" class="form-control" maxlength="20" required oninvalid="this.setCustomValidity('Silahkan isi nama menu')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" min="500" max="99999999" required oninvalid="this.setCustomValidity('Silahkan isi harga antara 500 sampai 99999999')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Menu</label>
                        <textarea name="deskripsi" class="form-control" required oninvalid="this.setCustomValidity('Silahkan isi deskripsi')" oninput="setCustomValidity('')"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ketersediaan</label>
                        <input type="number" name="stok" class="form-control" min="1" max="99999" required oninvalid="this.setCustomValidity('Silahkan isi ketersediaan menu antara 1 sampai 99999')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" name="btn_simpan" class="btn btn-success text-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require 'layout_footer.php';
?>