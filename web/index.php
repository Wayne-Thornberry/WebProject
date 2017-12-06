<?php

use itb\WebApplication;
use itb\Database;

require_once __DIR__ . '/../vendor/autoload.php';
$db = new Database();

session_start();
if(!isset($_SESSION['logged_in'])){
    $_SESSION['logged_in'] = false;
    echo $_SESSION['logged_in'];
}

$webApp = new WebApplication();
$webApp->run();