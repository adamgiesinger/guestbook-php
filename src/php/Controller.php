<?php

namespace Guestbook\Core;

use Symfony\Component\HttpFoundation\Response;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Controller
{

    public function __construct($autoloader)
    {
    }

    public function handle($request)
    {
        exec("rm -rf /Users/agiesinger/twig-cache/");

        $response = new Response();

        $query = $request->query->get("q");

        if (strtolower($query) == "index") {
            $page = IndexPage::showPosts();
            $response->setContent($page);
            $response->setStatusCode(200);
        } elseif (strtolower($query) == "guestbook") {
            $page = Guestbook::showPosts();
            $response->setContent($page);
            $response->setStatusCode(200);
        } elseif (strtolower($query) == "about") {
            $page = AboutPage::showPage();
            $response->setContent($page);
            $response->setStatusCode(200);
        } elseif (strtolower($query) == "contact") {
            $page = ContactPage::showPage();
            $response->setContent($page);
            $response->setStatusCode(200);
        } else {
            $response->setContent("404");
            $response->setStatusCode(404);
        }

        $response->headers->set("Content-Type", "text/html");
        return $response;
    }


}