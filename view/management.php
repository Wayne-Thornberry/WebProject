<?php

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);
$login = filter_input(INPUT_GET, 'login');


echo $twig->render('header.twig'); // Header/Navbar

switch ($login){
    case 0: echo $twig->render('register.twig');break;
    case 1: echo $twig->render('login.twig'); break;
    default: echo $twig->render('register.twig'); break;
}

echo $twig->render('footer.twig'); // Footer/SiteMap

