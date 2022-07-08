<?php
session_start();

function isLogin()
{
  if (!isset($_SESSION['level_users'])) {
    header('Location: ../login.php');
  }
}
