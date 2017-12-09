<?php
use itb\Database;

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);
$db = new Database();

echo $twig->render('header.twig', array(
    'LoggedIn' => $_SESSION['LoggedIn'],
    'Privilege' => $_SESSION['User']->getUPrivilege(),
)); // Header/Navbar


switch($_GET['manage']){
    case 0:
        $data = $db->getAllUsers()->fetchAll(2);
        $columns = array_keys($data[0]);
        $limit = $db->getAllUsers()->columnCount();
        break;
    case 1:
        $data = $db->getAllStaff()->fetchAll(2);
        $columns = array_keys($data[0]);
        $limit = $db->getAllStaff()->columnCount();
        break;
    case 2:
        $data = $db->getAllAdmins()->fetchAll(2);
        $columns = array_keys($data[0]);
        $limit = $db->getAllAdmins()->columnCount();
        break;
    case 3:
        $data = $db->getAllProducts()->fetchAll(2);
        $columns = array_keys($data[0]);
        $limit = $db->getAllProducts()->columnCount();
        break;
}

echo $twig->render('display/control-display.twig', array(
    'Manage' => $_GET['manage'],
    'Data' => $data,
    'Columns' => $columns,
    'Limit' => $limit,
));

echo $twig->render('footer.twig'); // Footer/SiteMap