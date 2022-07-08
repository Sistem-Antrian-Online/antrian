<?php
session_start();
unset($_SESSION['nama']);
unset($_SESSION['level']);
unset($_SESSION['username']);
$_SESSION['level'] = null;
$_SESSION['nama'] = null;
$_SESSION['username'] = null;
header('Location: index.php');
