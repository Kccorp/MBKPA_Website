<?php
session_start();
require 'fonctions.php';

if (isset($_SESSION['auth']) && isset($_SESSION['info']) && $_SESSION['auth'] && $_SESSION['info']['isAdmin']) {

    if ($_FILES["fichier"]["size"] == 0) { // vérifie sui le fichier est vide

        $path = "Assets/Shop/noImage.png";

    } else {
        $message = "";
        [$path, $message] = BackController::upload($message);
        if (!$path) {
            $listOfErrorsShop[] = $message;
            $_SESSION["listOfErrorsShop"] = $listOfErrorsShop;
            header('Location: catalog.php#product');
        }
    }

    if (count($_POST) == 5 &&
        !empty($_POST["name"]) &&
        !empty($_POST["fullname"]) &&
        !empty($_POST["idStrip"]) &&
        !empty($_POST["price"]) &&
        !empty($_POST["description"])
    ) {
        $listOfErrorsShop = [];

        $name = trim($_POST["name"]);
        $fullname = trim($_POST["fullname"]);
        $idStrip = trim($_POST["idStrip"]);
        $price = trim($_POST["price"]);
        $description = trim($_POST["description"]);


        if (strlen($name) < 3 || strlen($name) > 25) {
            $listOfErrorsShop[] = "Le nom de l'article ne doit pas dépasser les 50 caractères";
        }

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

            $connection = connectDB();
            $queryPrepared = $connection->prepare("INSERT INTO " . PRE . "merchandise (name, fullname, idStripe, price, description, urlImage) VALUES (:name, :fullname, :idStrip, :price, :description, :urlImage)");
            $queryPrepared->execute([
                "name" => $name,
                "fullname" => $fullname,
                "idStrip" => $idStrip,
                "price" => $price,
                "description" => $description,
                "urlImage" => $path]);

        } else {
            $_SESSION["listOfErrorsShop"] = $listOfErrorsShop;
            print_r($listOfErrorsShop);
        }
    }
}
header('Location: catalog.php#product');







