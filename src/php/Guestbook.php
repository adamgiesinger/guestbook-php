<?php


namespace Guestbook\Core;

use Twig_Loader_Filesystem;
use Twig_Environment;


class Guestbook
{

    public static function getPosts() {
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
        require_once "twig.php";
        $rows = self::getPosts();

        $guestbookEntries = "";
        try {
            $guestbookEntries = $twig->render('guestbookEntries.html.twig', [
                "entries" => $rows ]);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }

        $guestbookSection = "";
        try {
            $guestbookSection = $twig->render('guestbook.html.twig', [
                "guestbookEntries" => $guestbookEntries
            ]);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }

        $page = "";
        try {
            $page = $twig->render('page.html.twig', [
                "headElems" => [
                    "<title>Gästebuch</title>"
                ],
                "document" => $guestbookSection,
                "menu" => GuestbookMenu::getMenu()
            ]);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }
        return $page;
    }
}