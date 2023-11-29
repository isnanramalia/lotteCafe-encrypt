<?php
require 'functions.php';
$id_menu = 0;
if (isset($_POST['id_menu'])) {
    $id_menu = $_POST['id_menu'];
}
$data = array();
if ($id_menu > 0) {
    $query = "SELECT * FROM menu WHERE id_menu='$id_menu'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $nm_menu = $row['nm_menu'];
        $harga = $row['harga'];

        $data[] = array(
            "nm_menu" => $nm_menu,
            "harga" => $harga
        );
    }
}
echo json_encode($data);
