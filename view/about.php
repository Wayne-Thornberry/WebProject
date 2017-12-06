<?php

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);

echo $twig->render('header.twig'); // Header/Navbar

echo $twig->render('footer.twig'); // Footer/SiteMap