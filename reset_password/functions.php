<?php
session_start();
define("DEVELOPMENT", TRUE);

function dbConnect()
{
    $db = new mysqli("localhost", "root", "", "db_lottie_cafe");
    return $db;
}

$conn = dbConnect();


function execute($conn, $query)
{
    $db = mysqli_query($conn, $query);

    if ($db) {
        return 1;
    } else {
        return 0;
    }
}
