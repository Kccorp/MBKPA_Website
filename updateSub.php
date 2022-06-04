<?php
session_start();
require 'fonctions.php';


if ( count($_POST) == 4 &&
    is_numeric($_GET["idPackage"]) &&
    is_numeric($_POST["price"]) &&
    is_numeric($_POST["pricePerMin"]) &&
    is_numeric($_POST["duration"]) &&
    $_SESSION["auth"] && $_SESSION["info"]["isAdmin"]
) {

    $price = trim($_POST["price"]);
    $pricePerMin = trim($_POST["pricePerMin"]);
    $duration = trim($_POST["duration"]);
    $description = trim($_POST["description"]);
    $id = trim($_GET["idPackage"]);


    $connection = connectDB();
    $queryPrepared = $connection->prepare("UPDATE ".PRE."package SET price = ?, pricePerMin = ?, duration = ?, description = ? WHERE idPackage = ?");
    $queryPrepared->execute([$price, $pricePerMin, $duration, $description, $id]);

    header("Location: catalog.php");
}

