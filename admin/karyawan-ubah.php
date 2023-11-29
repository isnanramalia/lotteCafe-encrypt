<?php
$title = 'Ubah data karyawan';
require 'functions.php';

$db = dbConnect();
require '../db/encrypt.php';
$jabatan = ['Admin', 'Kasir'];
$id_karyawan = base64_decode($_GET['id']);
$query = "SELECT * FROM karyawan WHERE id_karyawan = '$id_karyawan'";
$karyawan = row_array($conn, $query);
$keyMatrixArray = generateMatrix('keyword');

if (isset($_POST['btn_simpan'])) {
    if ($db->errno == 0) {
        // Ambil nilai dari formulir yang diedit
        $nama = $db->escape_string($_POST['nama']);
        // $noTlp = $db->escape_string($_POST['noTlp']);
        $jabatan = $db->escape_string($_POST['jabatan']);
        $jabatan = $db->escape_string($_POST['alamat']);
        $username = $db->escape_string($_POST['username']);
        $password = $db->escape_string($_POST['password']);

        // Lakukan enkripsi pada data yang akan disimpan
        $encryptedNama = encrypt($keyMatrixArray, $nama);
        $encryptedAlamat = encrypt($keyMatrixArray, $alamat);
        // $encryptedNoTlp = encrypt($keyMatrixArray, $noTlp);
        $encryptedPassword = encrypt($keyMatrixArray, $password);

        // Buat query UPDATE dengan data yang sudah terenkripsi
        $query = "UPDATE karyawan SET nm_karyawan='$encryptedNama',  jabatan='$jabatan', username='$username', alamat ='$encryptedAlamat', pass='$encryptedPassword' WHERE id_karyawan='$id_karyawan'"; //noTlp='$encryptedNoTlp',

        // Eksekusi query untuk menyimpan data terenkripsi ke database
        $execute = execute($conn, $query);
        if ($execute == 1) {
            header('location:karyawan.php?msg=2');
        } else {
            header('location:karyawan.php?msg=5');
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
                        <label>Nama Karyawan</label>
                        <input type="text" name="nama" class="form-control" maxlength="30" value="<?= decrypt($keyMatrixArray, $karyawan['nm_karyawan']); ?>" required oninvalid="this.setCustomValidity('Silahkan isi nama karyawan')" oninput="setCustomValidity('')">
                    </div>
                    <!-- <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" name="noTlp" class="form-control" maxlength="15" value="<?= decrypt($keyMatrixArray, $karyawan['noTlp']); ?>" required oninvalid="this.setCustomValidity('Silahkan isi no. telepon')" oninput="setCustomValidity('')">
                    </div> -->
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="jabatan" class="form-control">
                            <?php foreach ($jabatan as $j) : ?>
                                <?php if ($j == $karyawan['jabatan']) : ?>
                                    <option value="<?= $j ?>" selected><?= $j ?></option>
                                <?php else : ?>
                                    <option value="<?= $j ?>"><?= $j ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" maxlength="200" value="<?= decrypt($keyMatrixArray, $karyawan['alamat']); ?>" required oninvalid="this.setCustomValidity('Silahkan isi alamat karyawan')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" maxlength="30" value="<?= $karyawan['username']; ?>" required oninvalid="this.setCustomValidity('Silahkan isi username')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <span id="eye-button" onclick="change()" class="input-group-text">
                            <i class="fas fa-fw fa-eye" title="tampilkan password"></i>
                        </span>
                        <input type="password" id="password" name="password" class="form-control" maxlength="15" value="<?= decrypt($keyMatrixArray, $karyawan['pass']); ?>" required oninvalid="this.setCustomValidity('Silahkan isi password')" oninput="setCustomValidity('')">
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