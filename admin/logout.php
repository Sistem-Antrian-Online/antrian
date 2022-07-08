<?php
session_start();
unset($_SESSION['level_users']);
unset($_SESSION['username']);
$_SESSION['level_users'] = null;
$_SESSION['username'] = null;
header('Location: index.php');
