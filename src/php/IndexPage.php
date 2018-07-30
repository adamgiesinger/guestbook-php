<?php


namespace Guestbook\Core;

class IndexPage
{

    public static function showPosts()
    {
        $twig = new TwigEnvironmentLoader("indexPage");
        $twigMain = new TwigEnvironmentLoader();

        $indexSiteSection = "";
        try {
            $indexSiteSection = $twig->render('indexPage.html.twig', [
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