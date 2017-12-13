<?php

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);

$LoggedIn = $_SESSION['LoggedIn'];
$Privilege = Null;

echo $twig->render('header.twig', array(
    'LoggedIn' => $_SESSION['LoggedIn'],
    'Privilege' => $_SESSION['User']->getUPrivilege(),
    'Active' => $_GET['view'],
)); // Header/Navbar

echo $twig->render('display/news-display.twig'); // News Display

echo $twig->render('footer.twig'); // Footer/SiteMap