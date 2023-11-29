<?php
session_start();

if ($_SESSION) {
    if ($_SESSION['jabatan'] == 'Kasir') {
    } else {
        header('location:../index.php');
    }
} else {
    header('location:../index.php?msg=4');
}

function dbConnect()
{
    $db = new mysqli("localhost", "root", "", "db_lottie_cafe");
    return $db;
}

$conn = dbConnect();

function get_data($conn, $query)
{
    $data = mysqli_query($conn, $query);
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }
}

function row_array($conn, $query)
{
    $db = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($db);
}

function execute($conn, $query)
{
    $db = mysqli_query($conn, $query);

    if ($db) {
        return 1;
    } else {
        return 0;
    }
}
