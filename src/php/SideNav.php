<?php

namespace Guestbook\Core;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class SideNav
{
    private static function getMenuItems()
    {
        $menuLinks = [];
        require "db.php";
        $result = $conn->query("SELECT * FROM menu");
        while ($row = $result->fetch()) {
            $menuLinks[$row["menuText"]] = $row["menuLink"];
        }
        return $menuLinks;
    }

    public static function getMenu($active)
    {
        $menu = "";
        try {
            require_once "TwigEnvironmentLoader.php";
            $twig = new TwigEnvironmentLoader();
            $menu = $twig->render('menu.html.twig', [
                "logoSrc" => "logo.png",
                "active" => $active,
                "menuItems" => self::getMenuItems()
            ]);
            return $menu;
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }
        return $menu;
    }
}