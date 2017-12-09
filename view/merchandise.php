<?php

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);

$LoggedIn =
$Privilege = Null;

echo $twig->render('header.twig', array(
    'LoggedIn' => $_SESSION['LoggedIn'],
    'Privilege' => $_SESSION['User']->getUPrivilege(),
)); // Header/Navbar

echo $twig->render('display/product-display.twig'); // Product Display

echo $twig->render('footer.twig'); // Footer/SiteMap