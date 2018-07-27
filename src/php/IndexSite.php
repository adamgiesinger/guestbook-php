<?php


namespace Guestbook\Core;

use Twig_Loader_Filesystem;
use Twig_Environment;


class IndexSite
{

    public static function getPosts()
    {
        $rows = [];
        require_once "db.php";
        $result = $conn->query("SELECT * FROM posts");
        while ($row = $result->fetch()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public static function showPosts()
    {
        $twig = new TwigEnvironmentLoader("indexSite");
        $twigMain = new TwigEnvironmentLoader();
        $rows = self::getPosts();

        $indexSiteSection = "";
        try {
            $indexSiteSection = $twig->render('indexSite.html.twig', [
            ]);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }

        $page = "";
        try {
            $page = $twigMain->render('page.html.twig', [
                "headElems" => [
                    "<title>Startseite</title>"
                ],
                "document" => $indexSiteSection,
                "menu" => SideNav::getMenu()
            ]);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }
        return $page;
    }
}