<?php
session_start();

function isLogin()
{
  if (!isset($_SESSION['level'])) {
    header('Location: ../login.php');
  }
}
