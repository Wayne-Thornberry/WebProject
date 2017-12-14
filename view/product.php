<?php

use itb\Database;

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);
$database = new Database();

echo $twig->render('header.twig', array(
    'LoggedIn' => $_SESSION['LoggedIn'],
    'Privilege' => $_SESSION['User']->getUPrivilege(),
    'Active' => $_GET['view'],
)); // Header/Navbar

if(!isset($_GET['edit']) || $_GET['edit'] == null) {
    $edit = 0;
}else{
    $edit = $_GET['edit'];
}

if(!isset($_GET['product']) || $_GET['product'] == null){
    $product = 0;
}else{
    $product = $database->getProduct($_GET['product'])->fetch();
}

echo $twig->render('product.twig', array(
    'Product' => $product,
    'Privilege' => $_SESSION['User']->getUPrivilege(),
    'Edit' => $edit,
));

echo $twig->render('footer.twig'); // Footer/SiteMap