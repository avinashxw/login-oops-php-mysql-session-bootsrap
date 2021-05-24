<?php
namespace LoginQ;

use \LoginQ\Member;

if(!empty($_POST['submit'])) {
    session_start();

    $userid = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    //echo $userid.' | '.$password.'<br>';
    require_once("class/Member.php");

    $member = new Member();

    $isloggedin = $member->processLogin($userid,$password);
    //exit;
    if(!$isloggedin) {
        echo '<script> alert("Invalid username or password!"); </script>';
        header("Location: ./index.php");
    }
    header("Location: ./index.php");
    exit();
}
?>