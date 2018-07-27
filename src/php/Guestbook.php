<?php


namespace Guestbook\Core;

class Guestbook
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
        require_once "TwigEnvironmentLoader.php";
        $twig = new TwigEnvironmentLoader("guestbook");
        $twigMain = new TwigEnvironmentLoader();
        $rows = self::getPosts();

        try {
            $guestbookEntries = $twig->render('guestbookEntries.html.twig', [
                "entries" => $rows]);

            $guestbookSection = $twig->render('guestbook.html.twig', [
                "guestbookEntries" => $guestbookEntries
            ]);


            $page = "";
            $page = $twigMain->render('page.html.twig', [
                "headElems" => [
                    "<title>Gästebuch</title>"
                ],
                "document" => $guestbookSection,
                "menu" => SideNav::getMenu()
            ]);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }
        return $page;
    }
}