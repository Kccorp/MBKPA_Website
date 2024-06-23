<?php
session_start();
require 'fonctions.php';

if ($_SESSION["auth"]){

    $connection = connectDB();
    $queryPrepared = $connection->prepare("UPDATE ".PRE."user SET idPackage = ? WHERE idUser = ?");
    $queryPrepared->execute([$_GET["id"], $_SESSION["info"]["idUser"]]);

    echo "Success";

} else {
    header("Location: login.php");
}
