<?php

require 'fonctions.php';

if (!empty($_SESSION["listOfErrors"])) {
    echo "<div class='alert alert-danger'>";

    foreach ($_SESSION["listOfErrors"] as $error) {
        echo $error . "<br>";
    }

    echo "</div>";
    unset($_SESSION["listOfErrors"]);

}
$connection=connectDB();
$queryPrepared = $connection->prepare("SELECT name, price, description,idStripe FROM ".PRE."merchandise");
$queryPrepared->execute([]);
$results = $queryPrepared->fetchALL(PDO::FETCH_ASSOC);

foreach ($results as $article => $infoArticle ) {
    foreach ($infoArticle as $cle => $info) {
        if ($cle == "name") {
            echo "<div><p>".$info."</p>";
        } elseif ($cle == "price") {
            echo "<p>".$info."€</p>";
        } elseif ($cle == "description") {
            if(empty($info)){
                echo "<p> N/A </p>";
            } else{
                echo "<p>".$info."</p></div>";
            }
        } elseif ($cle == "idStripe") {
            echo "<a href='create-checkout-session.php?id=".$info."' class='btn btn-primary'>Acheter</a></div>";
        }





}
}





?>