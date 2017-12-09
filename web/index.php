<?php

use itb\WebApplication;
use itb\Database;
use itb\User;

require_once __DIR__ . '/../vendor/autoload.php';
$db = new Database();


session_start();
if(!isset($_SESSION['SessionStart'])){
    $_SESSION['LoggedIn'] = false;
    $_SESSION['LoginAttempts'] = 0;
    $_SESSION['User'] = new User('','','','','','','','');
    $_SESSION['Privilege'] = 0;
    $_SESSION['SessionStart'] = true;
}

var_dump($_SESSION);

$webApp = new WebApplication();
$webApp->run();