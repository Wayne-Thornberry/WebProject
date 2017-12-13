<?php

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);
$login = filter_input(INPUT_GET, 'login');

if(!isset($_GET['error']) || $_GET['error'] == null){
    $_GET['error'] = 0;
}

echo $twig->render('header.twig', array(
    'LoggedIn' => $_SESSION['LoggedIn'],
    'Privilege' => $_SESSION['User']->getUPrivilege(),
    'Active' => $_GET['view'],
)); // Header/Navbar

switch ($login){
    case 0: echo $twig->render('register.twig', array(
        'Error' => $_GET['error'],
    ));
    break;
    case 1: echo $twig->render('login.twig', array(
        'Error' => $_GET['error'],
    ));
    break;
    default: echo $twig->render('register.twig', array(
        'Error' => $_GET['error'],
    ));
    break;
}

echo $twig->render('footer.twig'); // Footer/SiteMap

