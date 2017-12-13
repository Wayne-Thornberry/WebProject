<?php

require_once __DIR__ . '/../vendor/autoload.php';
use itb\WebApplication;
use itb\User;
use itb\Database;


$pdo = new Database();

session_start();
if(!isset($_SESSION['SessionStart'])){
    $_SESSION['LoggedIn'] = false;
    $_SESSION['LoginAttempts'] = 0;
    $_SESSION['User'] = new User('NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL');
    $_SESSION['Privilege'] = 0;
    $_SESSION['SessionStart'] = true;
}

//$pdo->setup();

$webApp = new WebApplication();
$webApp->run();