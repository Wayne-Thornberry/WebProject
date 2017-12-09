<?php

use itb\Database;
use itb\User;

$db = new Database();
$login = filter_input(INPUT_GET, 'login');

if(isset($_POST['Username'])) {
    $username = $_POST['Username'];
}
if(isset($_POST['Password'])) {
    $password = $_POST['Password'];
}
if(isset($_POST['Email'])) {
    $email = $_POST['Email'];
}
if(isset($_POST['FirstName'])) {
    $firstname = $_POST['FirstName'];
}
if(isset($_POST['LastName'])) {
    $lastname = $_POST['LastName'];
}
if(isset($_POST['DOB'])) {
    $dob = $_POST['DOB'];
}

if((isset($_GET['login']) && $_GET['login'] != null)&& (isset($_POST['Username']) && $_POST['Username'] != null)){
    switch($login){
        case 0:
            echo 'time to process some register info bois<br>';
            if ($db->doesUserExist($username, $email)){
                echo 'user already exists';
            }else{
                $db->insertUser(0,$username, $email ,$password,$firstname,$lastname,$dob);
                $_SESSION['LoginAttempts'] = 0;
                $_SESSION['LoggedIn'] = true;
                $_SESSION['User'] = new User($db->getUser($username)[0],$db->getUser($username)[1],$db->getUser($username)[2],$db->getUser($username)[3],$db->getUser($username)[4],$db->getUser($username)[5],$db->getUser($username)[6],$db->getUser($username)[7]);
                $_SESSION['Privilege'] = $db->getUser($username)[1];
                header('location: ?view=0');
            }
            break;
        case 1:
            if ($db->verifyUser($username, $password)) {
                $_SESSION['LoginAttempts'] = 0;
                $_SESSION['LoggedIn'] = true;
                $_SESSION['User'] = new User($db->getUser($username)[0],$db->getUser($username)[1],$db->getUser($username)[2],$db->getUser($username)[3],$db->getUser($username)[4],$db->getUser($username)[5],$db->getUser($username)[6],$db->getUser($username)[7]);
                $_SESSION['Privilege'] = $db->getUser($username)[1];
                header('location: ?view=0');
            } else {
                echo 'user does not exist';
                $_SESSION['LoginAttempts']++;
                header('location: ?view=5&login=1');
            }
            break;
        }
}else{
    header('location: ?view=5&login=1');
}

//