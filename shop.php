<?php
include 'header.php';


if (!empty($_SESSION["listOfErrors"])) {
    echo "<div class='alert alert-danger container'  >";

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
            echo "<form action='create-checkout-session.php' method='post'>";
            echo "<input type='hidden' name='id' value='".$info."'>";
            echo "<input type='text' name='quantity' placeholder='Quantité voulu'>";
            echo "<button type='submit'>Acheter</button></form>";
        }





    }
}




include 'footer.php';
?>