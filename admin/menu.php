<?php
$title = 'Menu';
require 'functions.php';
require 'layout_header.php';
$db = dbConnect();

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $data = mysqli_query($db, "SELECT * FROM menu WHERE nm_menu lIKE '%" . $keyword . "%' 
                                OR harga LIKE '%" . $keyword . "%'
                                OR deskripsi LIKE '%" . $keyword . "%'
                                OR stok LIKE '%" . $keyword . "%'
                                OR tgl_input LIKE '%" . $keyword . "%'");
} else {
    $data = mysqli_query($db, "SELECT * FROM menu");
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
            <div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Menu berhasil ditambahkan!</div>
        <?php
        } else if ($msg == 2) {
        ?>
            <div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Menu berhasil diubah!</div>
        <?php
        } else if ($msg == 3) {
        ?>
            <div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Menu berhasil dihapus!</div>
        <?php
        } else if ($msg == 4) {
        ?>
            <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal menambahkan data! Nama menu telah tersedia</div>
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
                        <a href="menu-tambah.php" class="btn btn-success box-title" title="Tambah Data"><i class="fa fa-plus fa-fw"></i> Tambah</a>
                        <button id="btn-refresh" class="btn btn-primary box-title" title="Refresh Data"><i class="fa fa-refresh fa-fw"></i></button>

                        <form action="menu.php" method="post" class="form-inline">
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
                            <tr>
                                <th>#</th>
                                <th class="hidden"></th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Ketersediaan</th>
                                <th>Tanggal Ditambahkan</th>
                                <th><i class="fa fa-cog fa-fw"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $menu) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td class="hidden"><?= $menu['id_menu']; ?></td>
                                    <td><?= $menu['nm_menu']; ?></td>
                                    <td>Rp <?= number_format($menu['harga'], 0, ',', '.'); ?></td>
                                    <td><?= $menu['deskripsi']; ?></td>
                                    <td><?= $menu['stok']; ?></td>
                                    <td><?= $menu['tgl_input']; ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="menu-ubah.php?id=<?= base64_encode($menu['id_menu']); ?>" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="menu-hapus.php?id=<?= base64_encode($menu['id_menu']); ?>" onclick="return confirm('Hapus data yang dipilih?');" title="Hapus" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
