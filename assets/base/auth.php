<?php
session_start();

function isAuthorized() {
    if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== true) {
        return false;
    }
    return true;
}

function checkAccess() {
    if (!isAuthorized() && basename($_SERVER['PHP_SELF']) == 'base.php') {
        header("Location: assets/base/login.php");
        exit;
    }
}
?>