<?php
use itb\Database;

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);
$db = new Database();


if(!isset($_GET['error']) || $_GET['error'] == null){
    $_GET['error'] = 0;
}

echo $twig->render('header.twig', array(
    'LoggedIn' => $_SESSION['LoggedIn'],
    'Privilege' => $_SESSION['User']->getUPrivilege(),
    'Active' => $_GET['view'],
)); // Header/Navbar


if(isset($_GET['manage']) && $_GET['manage'] != null) {
    switch($_GET['manage']){
        case 0:
            $data = $db->getAllUsers()->fetchAll(0);
            $columns = array_keys($db->getAllUsers(0)->fetchAll(2)[0]);
            $limit = $db->getAllUsers()->columnCount();
            break;
        case 1:
            $data = $db->getAllProducts()->fetchAll(0);
            $columns = array_keys($db->getAllProducts()->fetchAll(2)[0]);
            $limit = $db->getAllProducts()->columnCount();
            break;
        case 2:
            $data = $db->getAllSubscribers()->fetchAll(0);
            $columns = array_keys($db->getAllSubscribers()->fetchAll(2)[0]);
            $limit = $db->getAllSubscribers()->columnCount();
            break;
    }

    echo $twig->render('display/control-display.twig', array(
        'Error' => $_GET['error'],
        'Manage' => $_GET['manage'],
        'Privilege' => $_SESSION['User']->getUPrivilege(),
        'Data' => $data,
        'Columns' => $columns,
        'Limit' => $limit,
    ));
}else{
    echo $twig->render('control.twig', array(
        'Privilege' => $_SESSION['User']->getUPrivilege(),
    ));
}

echo $twig->render('footer.twig'); // Footer/SiteMap