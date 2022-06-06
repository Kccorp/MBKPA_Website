<?php
session_start();
require 'fonctions.php';

if (isset($_SESSION['auth']) && isset($_SESSION['info']) && $_SESSION['auth'] && $_SESSION['info']['isAdmin']) {


    if ($_FILES["fichier"]["size"] == 0) { // vérifie sui le fichier est vide

        $path = $_GET["image"];

    } else {
        $message = "";
        [$path, $message] = BackController::upload($message);
        if (!$path) {
            $listOfErrorsShop[] = $message;
            $_SESSION["listOfErrorsShop"] = $listOfErrorsShop;
            header('Location: catalog.php#product');
        }
    }


    if (count($_POST) == 4 &&
        !empty($_GET["idMerchandise"]) &&
        !empty($_POST["fullname"]) &&
        !empty($_POST["idStrip"]) &&
        !empty($_POST["price"]) &&
        !empty($_POST["description"])
    ) {
        $listOfErrorsShop = [];

        $idMerchandise = trim($_GET["idMerchandise"]);
        $fullname = trim($_POST["fullname"]);
        $idStrip = trim($_POST["idStrip"]);
        $price = trim($_POST["price"]);
        $description = trim($_POST["description"]);


        if (strlen($fullname) < 3 || strlen($fullname) > 100) {
            $listOfErrorsShop[] = "Le nom complet de l'article ne doit pas dépasser les 100 caractères";
        }

        if (strlen($description) < 3 || strlen($description) > 500) {
            $listOfErrorsShop[] = "L'identifiant de l'article ne doit pas dépasser les 500 caractères";
        }

        if (!is_numeric($price)) {
            $listOfErrorsShop[] = "Le prix de l'article doit être un nombre";
        }

        if (empty($listOfErrorsShop)) {

            echo $fullname . "<br>";
            echo $idStrip . "<br>";
            echo $price . "<br>";
            echo $description . "<br>";
            echo $path . "<br>";
            echo $idMerchandise . "<br>";

            $connection = connectDB();
            $queryPrepared = $connection->prepare("UPDATE " . PRE . "merchandise SET fullname = :fullname, idStripe = :idStripe, price = :price, description = :description, urlImage = :urlImage WHERE idMerchandise = :idMerchandise");
            $queryPrepared->execute([
                "fullname" => $fullname,
                "idStripe" => $idStrip,
                "price" => $price,
                "description" => $description,
                "urlImage" => $path,
                "idMerchandise" => $idMerchandise]);

        } else {
            $_SESSION["listOfErrorsShop"] = $listOfErrorsShop;
            print_r($listOfErrorsShop);
        }
    }
}

header('Location: catalog.php#product');

