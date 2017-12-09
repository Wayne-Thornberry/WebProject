<?php

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);

echo $twig->render('header.twig', array(
    'LoggedIn' => $_SESSION['LoggedIn'],
    'Privilege' => $_SESSION['User']->getUPrivilege(),
)); // Header/Navbar

echo $twig->render('display/image-display.twig'); // Image Display

echo $twig->render('display/product-display.twig'); // Product Display

echo $twig->render('display/news-display.twig'); // News Display

echo $twig->render('footer.twig'); // Footer/SiteMap
