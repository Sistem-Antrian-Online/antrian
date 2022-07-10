<?php
session_start();
unset($_SESSION['nama']);
unset($_SESSION['level']);
unset($_SESSION['username']);
unset($_SESSION['id_poli']);
$_SESSION['level'] = null;
$_SESSION['nama'] = null;
$_SESSION['username'] = null;
$_SESSION['id_poli'] = null;
header('Location: index.php');
