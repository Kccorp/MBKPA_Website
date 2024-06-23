<?php /** @noinspection SqlResolve */
session_start();
require 'fonctions.php';

echo "<pre>";
print_r($_POST);
echo "</pre>";

if (
    count ( $_POST ) == 3
    && !empty( $_POST[ "name" ] )
    && !empty( $_POST[ "montant" ] )
    && !empty( $_POST[ "type" ] )
) {
    echo 6;

    $listOfErrors = [];

    $name        = trim ( $_POST[ "name" ] );
    $montant       = trim ( $_POST[ "montant" ] );
    $type = trim ( $_POST[ "type" ] );

    if ( strlen ( $name ) < 2 || strlen ( $name ) > 150 ) {
        $listOfErrors[] = "le nom de du coupon doit faire minimum 2 caractéres et maximum 150 caractéres";
    }
    if (strpos($name, ' ') !== false) {
        $listOfErrorsShop[] = "Le nom du coupon ne doit pas contenir d'espace";
    }
    if ( str_word_count ( $name ) > 1 ) {
        $listOfErrors[] = "le nom du coupon doit être en un seul mot";
    }

    if ( !is_numeric ( $montant ) || $montant <= 0 ) {
        $listOfErrors[] = "le prix doit être un nombre positif";
    }
    if ( $type != "Pourcent" && $type != "Fixe") {
        $listOfErrors[] = "Le type du montant doit être un de ceux proposés dans la liste";
    }

    if ($type == "Pourcent"){
        $type = true;
    }elseif ($type == "Fixe"){
        $type = false;
    }




    if (empty($listOfErrors)){
        createAdminPromoCode($montant,$type,$name);
    } else{
        $_SESSION["listOfErrors"] = $listOfErrors;
    }
}

echo '<script> window.location.href = "gestion_users.php"; </script>';
?>