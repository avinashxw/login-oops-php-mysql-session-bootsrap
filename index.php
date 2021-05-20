<?php
session_start();

if(empty($_SESSION['uid'])) {
    require_once './views/dashboard.php';
}
else {
    require_once './views/login.php';
}
?>