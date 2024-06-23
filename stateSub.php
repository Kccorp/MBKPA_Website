<?php
session_start();
require 'fonctions.php';

echo "<pre>";
print_r($_SESSION);
echo "</pre>";


// delete package if the user is admin && $get["id"] is set and is an integer

if ( $_SESSION["auth"] && $_SESSION["info"]["isAdmin"] && isset($_GET["idPackage"]) && is_numeric($_GET["idPackage"]) && $_GET["state"] == "hs" ) {
    $connection = connectDB();
    $queryPrepared = $connection->prepare("UPDATE ".PRE."package SET status = 'hs' WHERE idPackage = ?");
    $queryPrepared->execute([$_GET["idPackage"]]);

    echo "Success";

}

if ( $_SESSION["auth"] && $_SESSION["info"]["isAdmin"] && isset($_GET["idPackage"]) && is_numeric($_GET["idPackage"]) && $_GET["state"] == "ok" ) {
    $connection = connectDB();
    $queryPrepared = $connection->prepare("UPDATE ".PRE."package SET status = 'ok' WHERE idPackage = ?");
    $queryPrepared->execute([$_GET["idPackage"]]);

    echo "Success";

}
header("Location: gestion_formules.php");

