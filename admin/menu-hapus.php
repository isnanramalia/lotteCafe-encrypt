<?php
require 'functions.php';
$id = base64_decode($_GET['id']);
$query = "DELETE FROM menu WHERE id_menu ='$id'";
$row = mysqli_query($conn, $query);

if ($row) {
    header('location:menu.php?msg=3');
}
