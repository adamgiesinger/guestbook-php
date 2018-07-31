<?php


namespace Guestbook\Core;

class AboutPage
{

    public static function showPage()
    {
        $twig = new TwigEnvironmentLoader("aboutPage");
        $twigMain = new TwigEnvironmentLoader();

        $aboutPageSection = "";
        try {
            $aboutPageSection = $twig->render('aboutPage.html.twig', [
                "aboutText" => "Hier sind Informationen über diese Seite, wie zum Beispiel der Zweck der Webseite. Dieser Text kann beliebig angepasst werden."
            ]);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }

        $page = "";
        try {
            $page = $twigMain->render('page.html.twig', [
                "headElems" => [
                    "<title>Über uns</title>"
                ],
                "document" => $aboutPageSection,
                "menu" => SideNav::getMenu("index.php?q=about"),
                "feed" => TwitterFeed::getFeed()
            ]);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }
        return $page;
    }
}