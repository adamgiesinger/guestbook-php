<?php


namespace Guestbook\Core;

class ContactPage
{

    public static function getContactData() {
        require_once "db.php";
        $result = $conn->query("SELECT * FROM contactInfo");
        while ($row = $result->fetch()) {
            return $row;
        }
        return [];
    }

    public static function showPage()
    {
        $twig = new TwigEnvironmentLoader("contactPage");
        $twigMain = new TwigEnvironmentLoader();

        $row = self::getContactData();
        $contactForm = "";
        try {
            $contactForm = $twig->render('contactForm.html.twig', [
                "fullName" => $row["fullName"],
                "phoneNumber" => $row["phoneNumber"],
                "emailAddress" => $row["emailAddress"]
            ]);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }

        $contactPageSection = "";
        try {
            $contactPageSection = $twig->render('contactPage.html.twig', [
                "contactForm" => $contactForm
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
                "document" => $contactPageSection,
                "menu" => SideNav::getMenu()
            ]);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }
        return $page;
    }
}