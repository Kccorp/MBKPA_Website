<?php
session_start();
require 'fonctions.php';

if ($_SESSION['auth'] && is_numeric($_GET['idItem'])){

    $idItem = $_GET['idItem'];

    $connection = connectDB();
    $queryPrepare = $connection->prepare("DELETE FROM ".PRE."merchandise WHERE idMerchandise = :id");
    $queryPrepare->execute(["id" => $idItem]);


}

header('Location: gestion_items.php');