<?php

use itb\Database;

$login = filter_input(INPUT_GET, 'login');

if(isset($_GET['login']) && $_GET['login'] != null){
    switch($login){
        case 0:
            echo 'time to process some register info bois';
            break;
        case 1:
            echo 'time to process some login info bois';
            break;
    }
}else{
    header('location: ?view=0');
}