<?php

namespace Guestbook\Core;

use Twig_Environment;
use Twig_Loader_Filesystem;

class TwigEnvironmentLoader extends Twig_Environment
{
    public function __construct($subfolder = false)
    {
        if (!$subfolder) {
            $loader = new Twig_Loader_Filesystem('/Applications/MAMP/htdocs/guestbook-php/src/templates');
        } else {
            $loader = new Twig_Loader_Filesystem('/Applications/MAMP/htdocs/guestbook-php/src/templates/' . $subfolder);
        }
        parent::__construct($loader, [
            'cache' => '/Users/agiesinger/twig-cache',
            'auto-reload' => true
        ]);
    }
}