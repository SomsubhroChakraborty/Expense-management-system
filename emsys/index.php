<?php
session_start();

require_once 'database/DBController.php';

$db = new DBController();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("location: views/auth/login.php");
} else {
    header("location: views/dashboard.php");
}
