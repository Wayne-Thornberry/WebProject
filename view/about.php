<?php

use itb\User;

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);

echo $twig->render('header.twig', array(
    'LoggedIn' => $_SESSION['LoggedIn'],
    'Privilege' => $_SESSION['User']->getUPrivilege(),
)); // Header/Navbar

echo 'About Page';
echo $twig->render('footer.twig'); // Footer/SiteMap