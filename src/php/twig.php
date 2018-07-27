<?php
$loader = new Twig_Loader_Filesystem('/Applications/MAMP/htdocs/test123/src/templates');
$twig = new Twig_Environment($loader, array(
    'cache' => '/Users/agiesinger/twig-cache',
    'auto-reload' => true
));