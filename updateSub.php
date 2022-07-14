<?php
session_start();
require 'fonctions.php';


if (
    $_SESSION[ "auth" ] && $_SESSION[ "info" ][ "isAdmin" ]
    && count( $_POST ) > 1
    && (
        is_numeric( $_GET[ "idPackage" ] )
        && is_numeric( $_POST[ "price" ] )
        && is_numeric( $_POST[ "pricePerMin" ] )
        && is_numeric( $_POST[ "duration" ] )

    )
) {

    $price = trim($_POST["price"]);
    $pricePerMin = trim($_POST["pricePerMin"]);
    $duration = trim($_POST["duration"]);
    $description = trim($_POST["description"]);
    $id = trim($_GET["idPackage"]);
    $idStrip = trim($_POST["idStrip"]);


    $connection = connectDB();
    $queryPrepared = $connection->prepare("UPDATE ".PRE."package SET price = ?, idStripe = ?, pricePerMin = ?, duration = ?, description = ? WHERE idPackage = ?");
    $queryPrepared->execute([$price, $idStrip, $pricePerMin, $duration, $description, $id]);


}

header("Location: gestion_formules.php");