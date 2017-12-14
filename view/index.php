<?php

use itb\Product;
use itb\Database;

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);
$database = new Database();


echo $twig->render('header.twig', array(
    'LoggedIn' => $_SESSION['LoggedIn'],
    'Privilege' => $_SESSION['User']->getUPrivilege(),
    'View' => $_GET['view'],
)); // Header/Navbar

echo $twig->render('display/image-display.twig'); // Image Display

echo $twig->render('display/product-display.twig',  array(
    'View' => $_GET['view'],
    'Products' => array(
        $database->getProduct(0)->fetch(),
        $database->getProduct(1)->fetch(),
        $database->getProduct(2)->fetch(),
        $database->getProduct(3)->fetch(),
        $database->getProduct(4)->fetch(),
    ),
    'Privilege' => $_SESSION['User']->getUPrivilege(),
)); // Product Display

echo $twig->render('display/news-display.twig'); // News Display

echo $twig->render('footer.twig'); // Footer/SiteMap
