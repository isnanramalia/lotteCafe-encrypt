<?php
session_start();
require 'functions.php';
$db = mysqli_connect('localhost', 'root', '', 'db_lottie_cafe');

$username = $db->escape_string($_POST['username']);
$password1 = $db->escape_string(($_POST['password1']));
$password2 = $db->escape_string(($_POST['password2']));

$query = "SELECT * FROM karyawan where username='$username'";
$row = mysqli_query($db, $query);
$data = mysqli_fetch_assoc($row);

if ($db->errno == 0) {
    if (isset($_POST["btn_ubah"])) {
        if ($data) {
            if ($password1 == $password2) {
                $password1 = $db->escape_string(md5($_POST['password1']));
                $query = "UPDATE karyawan SET pass='$password1' WHERE username='$username'";
                $execute = execute($conn, $query);
                if ($execute == 1) {
                    header('location:../index.php?msg=8');
                } else {
                    header('location:../index.php?msg=9');
                }
            } else {
                header('location:lupa_password.php?msg=4');
            }
        } else {
            header('location:lupa_password.php?msg=3');
        }
    } else {
        header('location:lupa_password.php?msg=2');
    }
} else {
    header('location:lupa_password.php?msg=1');
}
