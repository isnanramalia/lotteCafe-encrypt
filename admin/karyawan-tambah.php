<?php
$title = 'Tambah karyawan';
require 'functions.php';
require '../db/encrypt.php';
$db = dbConnect();

if (isset($_POST['btn_simpan'])) {
    if ($db->errno == 0) {
        // fungsi untuk mengenkripsi
        $keyMatrixArray = generateMatrix('keyword');
        $nama = $db->escape_string($_POST['nama']);
        $encryptedNama = encrypt($keyMatrixArray, formatMessage($nama));

        // $noTlp = $db->escape_string($_POST['noTlp']);
        // $encryptedNoTlp = encrypt($keyMatrixArray, $noTlp);

        $jabatan = $db->escape_string($_POST['jabatan']);

        $alamat = $db->escape_string($_POST['alamat']);
        $encryptedAlamat = encrypt($keyMatrixArray, $alamat);

        $username = $db->escape_string($_POST['username']);

        $password = $db->escape_string($_POST['password']);
        $encryptedPassword = encrypt($keyMatrixArray, $password);

        // cek username sudah ada atau belum
        $queryCheckUsername = "SELECT * FROM karyawan WHERE username = '$username'";
        $dataUsername = row_array($conn, $queryCheckUsername);
        if ($dataUsername['username'] == 0) {
            // Query untuk menyimpan data terenkripsi ke dalam database
            $query = "INSERT INTO karyawan (nm_karyawan, jabatan, username, pass, alamat)
                VALUES ('$encryptedNama', '$jabatan', '$username', '$encryptedPassword', '$encryptedAlamat')";
                // noTlp, '$encryptedNoTlp', 
            $execute = execute($conn, $query);

            if ($execute == 1) {
                header('location:karyawan.php?msg=1');
            } else {
                header('location:karyawan.php?msg=5');
            }
        } else {
            header('location:karyawan.php?msg=4');
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
    <?php if (isset($_GET['msg'])) : ?>
        <small class="text-danger"><?= $_GET['msg'];  ?></small>
    <?php endif ?>
    <div class="row">
        <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="">
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input type="text" name="nama" class="form-control" maxlength="30" required oninvalid="this.setCustomValidity('Silahkan isi nama karyawan')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <!-- <label>No. Telepon</label>
                        <input type="text" name="noTlp" class="form-control" maxlength="15" required oninvalid="this.setCustomValidity('Silahkan isi no. telepon')" oninput="setCustomValidity('')">
                    </div> -->
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="jabatan" class="form-control" required oninvalid="this.setCustomValidity('Silahkan pilih jabatan')" oninput="setCustomValidity('')">
                            <option value="">Pilih jabatan</option>
                            <option value="Admin">Admin</option>
                            <option value="Kasir">Kasir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" maxlength="200" required oninvalid="this.setCustomValidity('Silahkan isi alamat karyawan')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" maxlength="30" required oninvalid="this.setCustomValidity('Silahkan isi username')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <span id="eye-button" onclick="change()" class="input-group-text">
                            <i class="fas fa-fw fa-eye" title="tampilkan password"></i>
                        </span>
                        <input type="password" id="password" name="password" class="form-control" maxlength="15" required oninvalid="this.setCustomValidity('Silahkan isi password')" oninput="setCustomValidity('')">
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