<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'db_lottie_cafe');

$username = $db->escape_string($_POST['username']);
$password = $db->escape_string(md5($_POST['password']));
$query = "SELECT * FROM karyawan where username='$username'";
$row = mysqli_query($db, $query);
$data = mysqli_fetch_assoc($row);

if ($db->errno == 0) {
    if (isset($_POST["btn_login"])) {
        if ($data) {
            if ($password == $data['pass']) {
                if ($data['jabatan'] == 'Admin') {
                    $_SESSION['jabatan'] = 'Admin';
                    $_SESSION['nm_karyawan'] = $data['nm_karyawan'];
                    header('location:admin');
                } else {
                    $_SESSION['jabatan'] = 'Kasir';
                    $_SESSION['nm_karyawan'] = $data['nm_karyawan'];
                    header('location:kasir/transaksi.php');
                }
            } else {
                header('location:index.php?msg=2');
            }
        } else {
            header('location:index.php?msg=3');
        }
    } else {
        header('location:index.php?msg=6');
    }
} else {
    header('location:index.php?msg=7');
}
