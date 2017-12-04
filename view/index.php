<?php

$twigFile = new Twig_Loader_Filesystem('../view/template');
$twig = new Twig_Environment($twigFile);

echo $twig->render('header.twig'); // Header/Navbar

echo $twig->render('image-display.twig'); // Image Display

echo $twig->render('product-display.twig'); // Product Display

echo $twig->render('news-display.twig'); // News Display

echo $twig->render('footer.twig'); // Footer/SiteMap
