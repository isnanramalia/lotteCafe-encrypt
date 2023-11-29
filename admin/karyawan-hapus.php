<?php
require 'functions.php';
$id_karyawan = base64_decode($_GET['id']);
$query = "DELETE FROM karyawan WHERE id_karyawan = '$id_karyawan'";
$row = mysqli_query($conn, $query);

if ($row) {
    header('location:karyawan.php?msg=3');
}
