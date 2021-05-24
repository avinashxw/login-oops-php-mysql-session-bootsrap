<?php
session_start();
if(!empty($_SESSION['user_id'])) {
    require_once './views/dashboard.php';
}
else {
    require_once './views/login.php';
}
?>