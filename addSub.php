<?php
session_start();
require 'fonctions.php';

echo "<pre>";
print_r($_POST);
echo "</pre>";

if ( count($_POST) == 6 &&
    !empty($_POST["price"]) &&
    !empty($_POST["name"]) &&
    !empty($_POST["status"]) &&
    !empty($_POST["duration"]) &&
    !empty($_POST["description"]) &&
    $_SESSION["auth"] && $_SESSION["info"]["isAdmin"]
) {

    $listOfErrors = [];

    $name = trim($_POST["name"]);
    $price = trim($_POST["price"]);
    $pricePerMin = trim($_POST["pricePerMin"]);
    $status = trim($_POST["status"]);
    $duration = trim($_POST["duration"]);
    $description = trim($_POST["description"]);

    if( strlen($name)<2 || strlen($name)>150 ) {
        $listOfErrors[] = "le nom de l'offre doit faire minimum 2 caractéres et maximum 150 caractéres";
    }
    if ( str_word_count($name) > 1 ) {
        $listOfErrors[] = "le nom de l'offre doit être en un seul mot";
    }

    if ( !is_numeric($price) || $price <= 0 ) {
        $listOfErrors[] = "le prix doit être un nombre positif";
    }
    if ( !is_numeric($pricePerMin) || $pricePerMin <= 0 ) {
        $listOfErrors[] = "le prix par minute doit être un nombre positif";
    }
    if ( !is_numeric($duration) || $duration <= 0 ) {
        $listOfErrors[] = "la durée doit être un nombre positif";
    }



    if (empty($listOfErrors)){
        $connection = connectDB();
        $queryPrepared = $connection->prepare("INSERT INTO ".PRE."package (name, price, pricePerMin, status, duration, description) VALUES (?, ?, ?, ?, ?, ?)");
        $queryPrepared->execute([$name, $price, $pricePerMin, $status, $duration, $description]);
    } else{
        $_SESSION["listOfErrors"] = $listOfErrors;
        header("location: backofficeSub.php");
    }


    header("Location: backofficeSub.php");

}