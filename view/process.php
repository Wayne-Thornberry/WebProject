<?php

use itb\Database;
use itb\User;

$process = filter_input(INPUT_GET, 'process');

switch($process){
    case 0: ; logout(); break; // logout
    case 1: ; login(); break; // login
    case 2: ; register(); break; // register
    case 3: ; updateEntry(); break; // update  entry
    case 4: ; removeEntry(); break; // remove entry
    case 5: ; createEntry(); break; // update entry
};

function login(){
    $database = new Database();
    if(isset($_POST['Username']) && isset($_POST['Password'])){ // User entered info
        $username = $_POST['Username'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $accountverified = $database->verifyUser($username, $email);
        $passordverrified = password_verify($password, $database->getUser($username)[4]);
        if($accountverified && $passordverrified){
            $_SESSION['LoginAttempts'] = 0;
            $_SESSION['LoggedIn'] = true;
            $_SESSION['User'] = new User($database->getUser($username)[0],$database->getUser($username)[1],$database->getUser($username)[2],$database->getUser($username)[3],$database->getUser($username)[4],$database->getUser($username)[5],$database->getUser($username)[6],$database->getUser($username)[7]);
            header('location: ?view=0');
        }else{
            $_SESSION['LoginAttempts']++;
            $_SESSION['LoggedIn'] = false;
            $_SESSION['User'] = new User('NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL');
            header('location: ?view=5&login=1&error=1');
        }
    }else{
       header('location: ?view=5&login=1');
    }
};

function logout(){
    $_SESSION['LoginAttempts'] = 0;
    $_SESSION['LoggedIn'] = false;
    $_SESSION['User'] = new User('NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL');
    header('location: ?view=5&login=1');
};

function register(){
    $database = new Database();
    if(isset($_POST['Username']) && isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['DOB'])) { // User entered info
        $username = $_POST['Username'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $firstname = $_POST['FirstName'];
        $lastname = $_POST['LastName'];
        $dob = $_POST['DOB'];
        $exists = $database->verifyUser($username, $email);
        if(!$exists){
            $database->createUser(0, $username, $email, $password, $firstname, $lastname, $dob);
            $_SESSION['UserExists'] = false;
            login();
        }else{
            $_POST['UserExists'] = true;
            header('location: ?view=5&login=0&error=2');
        }
    }else{
       header('location: ?view=5&login=0');
    }

};

/// Control Panel ///

function updateEntry(){
    $manage = $_GET['manage'];
    switch ($manage){
        case 0: updateUser(); break;
        case 1: updateProduct(); break;
        case 2: updateSubscriber(); break;
    }
}

function createEntry(){
    $manage = $_GET['manage'];
    switch ($manage){
        case 0: createUser(); break;
        case 1: createProduct(); break;
        case 2: createSubscriber(); break;
    }
}

function removeEntry(){
    $manage = $_GET['manage'];
    switch ($manage){
        case 0: removeUser(); break;
        case 1: removeProduct(); break;
        case 2: removeSubscriber(); break;
    }
}

/// Update ///


function updateUser(){
    $database = new Database();
    $privilege = $_POST['uPrivilege'];
    $username = $_POST['uName'];
    $email = $_POST['uEmail'];
    $password = $_POST['uPassword'];
    $firstname = $_POST['uFirstName'];
    $lastname = $_POST['uLastName'];
    $dob = $_POST['uDOB'];
    $database->updateUser($_GET['index'], $privilege, $username, $email, $password, $firstname, $lastname, $dob);
    header('location: ?view=8&manage=0');
}

function updateProduct(){
    $database = new Database();
    $name = $_POST['pName'];
    $price = $_POST['pPrice'];
    $quantity = $_POST['pQuantity'];
    $image = $_POST['pImage'];
    $description = $_POST['pDescription'];
    $tagone = $_POST['pTagOne'];
    $tagtwo = $_POST['pTagTwo'];
    $database->updateProduct($_GET['index'], $name, $price, $quantity, $image, $description, $tagone, $tagtwo);
    header('location: ?view=8&manage=1');
}

function updateSubscriber(){
    $database = new Database();
    $sEmail = $_POST['sEmail'];
    $database->updateSubscriber($_GET['index'], $sEmail);
    header('location: ?view=8&manage=2');
}

/// Create ///

function createUser(){
    $database = new Database();
    $privilege = $_POST['uPrivilege'];
    $username = $_POST['uName'];
    $email = $_POST['uEmail'];
    $password = $_POST['uPassword'];
    $firstname = $_POST['uFirstName'];
    $lastname = $_POST['uLastName'];
    $dob = $_POST['uDOB'];
    $database->createUser($privilege, $username, $email, $password, $firstname, $lastname, $dob);
    header('location: ?view=8&manage=0');
}

function createProduct(){
    $database = new Database();
    $name = $_POST['pName'];
    $price = $_POST['pPrice'];
    $quantity = $_POST['pQuantity'];
    $image = $_POST['pImage'];
    $description = $_POST['pDescription'];
    $tagone = $_POST['pTagOne'];
    $tagtwo = $_POST['pTagTwo'];
    $database->createProduct($name, $price, $quantity, $image, $description, $tagone, $tagtwo);
    header('location: ?view=8&manage=1');
}

function createSubscriber(){
    $database = new Database();
    $sEmail = $_POST['sEmail'];
    $database->createSubscriber($sEmail);
    header('location: ?view=8&manage=2');
}

/// Remove ///

function removeUser(){
    $database = new Database();
    $privilege = $_POST['uPrivilege'];
    if( $privilege != 2) {
        $database->removeUser($_GET['index']);
        header('location: ?view=8&manage=0');
    }else{
        header('location: ?view=8&manage=0&error=1');
    }
};

function removeProduct(){
    $database = new Database();
    $database->removeProduct($_GET['index']);
    header('location: ?view=8&manage=1');
};

function removeSubscriber(){
    $database = new Database();
    $database->removeSubscriber($_GET['index']);
    header('location: ?view=8&manage=2');
}