<?php

use itb\Database;
use itb\Product;

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);

$database = new Database();

echo $twig->render('header.twig', array(
    'LoggedIn' => $_SESSION['LoggedIn'],
    'Privilege' => $_SESSION['User']->getUPrivilege(),
    'Active' => $_GET['view'],
)); // Header/Navbar

echo $twig->render('display/product-display.twig',  array(
    'View' => $_GET['view'],
    'Products' => $database->getAllProducts()->fetchAll(),
    'Privilege' => $_SESSION['User']->getUPrivilege(),
)); // Product Display

echo $twig->render('footer.twig'); // Footer/SiteMap