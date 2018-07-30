<?php

namespace Guestbook\Core;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class TwitterFeed
{
    public static function getFeed()
    {
        $feed = "";
        try {
            require_once "TwigEnvironmentLoader.php";
            $twig = new TwigEnvironmentLoader();
            $feed = $twig->render('twitter.html.twig', [
                "accountName" => "9to5google"
            ]);
            return $feed;
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }
        return $feed;
    }
}