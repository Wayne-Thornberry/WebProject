<?php

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);
$login = filter_input(INPUT_GET, 'login');

echo $twig->render('header.twig', array(
    'LoggedIn' => $_SESSION['LoggedIn'],
    'Privilege' => $_SESSION['User']->getUPrivilege(),
)); // Header/Navbar

switch ($login){
    case 0: echo $twig->render('register.twig');break;
    case 1: echo $twig->render('login.twig', array(
        'LoginAttempts' => $_SESSION['LoginAttempts'],
    ));
    echo $_SESSION['LoginAttempts'];
    break;
    default: echo $twig->render('register.twig'); break;
}

echo $twig->render('footer.twig'); // Footer/SiteMap

