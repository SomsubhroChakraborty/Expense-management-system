<?php
session_start();
require_once '../../database/AuthController.php';

$auth = new AuthController();
$auth->logout();
