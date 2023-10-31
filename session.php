<?php
    session_name("crew");
    session_start();
    $role_exists = false;
    $_SESSION['username'] = isset($_SESSION['username'])? $_SESSION['username']:'';
    $_SESSION['role'] = isset($_SESSION['role'])? $_SESSION['role']:'';
?>