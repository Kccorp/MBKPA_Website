<?php /** @noinspection SqlResolve */
session_start();
require 'fonctions.php';

echo "<pre>";
print_r($_POST);
echo "</pre>";

if (
    count ( $_POST ) == 8
    && !empty( $_POST[ "price" ] )
    && !empty( $_POST[ "name" ] )
    && !empty( $_POST[ "status" ] )
    && !empty( $_POST[ "idStrip" ] )
    && !empty( $_POST[ "duration" ] )
    && !empty( $_POST[ "description" ] )
) {
    echo 6;

    $listOfErrors = [];

    $name        = trim ( $_POST[ "name" ] );
    $price       = trim ( $_POST[ "price" ] );
    $pricePerMin = trim ( $_POST[ "pricePerMin" ] );
    $status      = trim ( $_POST[ "status" ] );
    $idStrip     = trim ( $_POST[ "idStrip" ] );
    $description = trim ( $_POST[ "description" ] );
    $duration    = trim ( $_POST[ "duration" ] );

    if ( strlen ( $name ) < 2 || strlen ( $name ) > 150 ) {
        $listOfErrors[] = "le nom de l'offre doit faire minimum 2 caractéres et maximum 150 caractéres";
    }
    if (strpos($name, ' ') !== false) {
        $listOfErrorsShop[] = "Le nom de l'article ne doit pas contenir d'espace";
    }
    if ( str_word_count ( $name ) > 1 ) {
        $listOfErrors[] = "le nom de l'offre doit être en un seul mot";
    }

    if ( !is_numeric ( $price ) || $price <= 0 ) {
        $listOfErrors[] = "le prix doit être un nombre positif";
    }
    if ( !is_numeric ( $pricePerMin ) || $pricePerMin < 0 ) {
        $listOfErrors[] = "le prix par minute doit être un nombre positif";
    }




    if (empty($listOfErrors)){
        echo "pas d'erreurs BDDD";
        $connection = connectDB();
        $queryPrepared = $connection->prepare("INSERT INTO ".PRE."package (name, price, pricePerMin, status,  description, idStripe, duration) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $queryPrepared->execute([$name, $price, $pricePerMin, $status, $description, $idStrip, $duration]);
    } else{
        $_SESSION["listOfErrors"] = $listOfErrors;
    }
}

header("Location: gestion_formules.php");
?>