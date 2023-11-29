<?php
require 'functions.php';
$id = base64_decode($_GET['id']);
$query = "DELETE FROM transaksi WHERE id_transaksi = '$id'";
$row = mysqli_query($conn, $query);

if ($row) {
    header('location:transaksi.php?msg=3');
} else {
    header('location:transaksi.php?msg=5');
}
