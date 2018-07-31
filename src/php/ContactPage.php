<?php


namespace Guestbook\Core;

class ContactPage
{

    public static function getContactData()
    {
        $rows = [];
        require_once "db.php";
        $result = $conn->query("SELECT * FROM contactInfo");
        while ($row = $result->fetch()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public static function showPage()
    {
        $twig = new TwigEnvironmentLoader("contactPage");
        $twigMain = new TwigEnvironmentLoader();

        $rows = self::getContactData();
        try {
            $contactForm = $twig->render('contactForm.html.twig', [
                "people" => $rows
            ]);

            $contactPageSection = $twig->render('contactPage.html.twig', [
                "contactForm" => $contactForm
            ]);

            $page = $twigMain->render('page.html.twig', [
                "headElems" => [
                    "<title>Über uns</title>"
                ],
                "document" => $contactPageSection,
                "menu" => SideNav::getMenu("index.php?q=contact"),
                "feed" => TwitterFeed::getFeed()
            ]);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }
        return $page;
    }
}