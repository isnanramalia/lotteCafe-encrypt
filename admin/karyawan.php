<?php
$title = 'Karyawan';
require 'functions.php';
require 'layout_header.php';
require '../db/encrypt.php';
$db = dbConnect();
$keyMatrixArray = generateMatrix('keyword');

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $data = mysqli_query($db, "SELECT * FROM karyawan WHERE nm_karyawan lIKE '%" . $keyword . "%' 
                                // OR noTlp LIKE '%" . $keyword . "%'
                                OR jabatan LIKE '%" . $keyword . "%'
                                OR username LIKE '%" . $keyword . "%'");
} else {
    $data = mysqli_query($db, "SELECT * FROM karyawan");
}
$i = 1;
?>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= $title ?></h4>
        </div>
    </div>

    <?php if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        if ($msg == 1) {
    ?>
            <div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Karyawan berhasil ditambahkan!</div>
        <?php
        } else if ($msg == 2) {
        ?>
            <div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Karyawan berhasil diubah!</div>
        <?php
        } else if ($msg == 3) {
        ?>
            <div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Karyawan berhasil dihapus!</div>
        <?php
        } else if ($msg == 4) {
        ?>
            <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal menambahkan data! Username telah digunakan</div>
        <?php
        } else if ($msg == 5) {
        ?>
            <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal menambahkan data!</div>
    <?php
        }
    }
    ?>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                        <a href="karyawan-tambah.php" class="btn btn-success box-title" title="Tambah Data"><i class="fa fa-plus fa-fw"></i> Tambah</a>
                        <button id="btn-refresh" class="btn btn-primary box-title" title="Refresh Data"><i class="fa fa-refresh fa-fw"></i></button>

                        <form action="" method="post" class="form-inline py-3 ">
                            <strong>Pencarian Data </strong><br>
                            <input type="text" class="form-control bg-light border-0 small" name="keyword" placeholder="Masukkan kata kunci">
                            <button class="btn btn-primary" type="submit" title="Cari Data">
                                <i class="fas fa-search fa-sm"></i> Cari
                            </button>
                        </form>
                    </div>
                </div>
                <?php
                if (isset($_POST['keyword'])) {
                    $keyword = $_POST['keyword'];
                    echo "<strong>Hasil Pencarian : " . $keyword . "</strong>";
                }
                ?>
                <div class="table-responsive">
                    <table class="table thead-dark" id="table">
                        <thead class="thead-dark">
                            <tr align="center">
                                <th>#</th>
                                <th class="hidden"></th>
                                <th>Nama Karyawan</th>
                                <!-- <th>No. Telepon</th> -->
                                <th>Jabatan</th>
                                <th>Alamat</th>
                                <th>Username</th>
                                <th><i class="fa fa-cog fa-fw"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach ($data as $karyawan) : ?>
                                <!-- menampilkan data setelah di dekrip -->
                               <tr>
                                    <td><?= $i++; ?></td>
                                    <td class="hidden"><?= $karyawan['id_karyawan'] ?></td>
                                    <td><?= decrypt($keyMatrixArray, $karyawan['nm_karyawan']); ?></td>
                                    <!-- <td><?= decrypt($keyMatrixArray, $karyawan['noTlp']); ?></td> -->
                                    <td><?= $karyawan['jabatan'];?></td>
                                    <td><?= decrypt($keyMatrixArray, $karyawan['alamat']); ?></td>
                                    <td><?= $karyawan['username']; ?></td>
                                    <td align="center">
                                    <div class="btn-group">
                                            <a href="karyawan-ubah.php?id=<?= base64_encode($karyawan['id_karyawan']); ?>" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="karyawan-hapus.php?id=<?= base64_encode($karyawan['id_karyawan']); ?>" onclick="return confirm('Hapus data yang dipilih?');" title="Hapus" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
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
