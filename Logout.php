<?php

$url = "";
session_start();
if ($_SESSION['nama_roles'] == 'Admin' || $_SESSION['nama_roles'] == 'Transaksi' || $_SESSION['nama_roles'] == 'Pencatatan' || $_SESSION['nama_roles'] == 'Setor') {
    $url = "Auth/LoginAdmin.php";
} else if ($_SESSION['nama_roles'] == 'Peternak') {
    $url = "Auth/LoginPage.php";
}

session_destroy();

header("Location: $url");
