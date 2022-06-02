<?php
require 'header.php';
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true") {

    echo "<div class='alert alert-success'>";
    echo "Bonjour " . $_SESSION["info"]["name"] ." ". $_SESSION["info"]["lastName"] . " !";
    echo "</div>";
    $connection =connectDB();
    $queryPrepared = $connection->prepare("SELECT fidelityPoints FROM ".PRE."user WHERE idUser = :id_user");
    $queryPrepared->execute(["id_user"=>$_SESSION["info"]["idUser"]]);
    $results = $queryPrepared->fetch();
    $_SESSION["info"]["fidelityPoints"] ;


 echo $points=$_SESSION["info"]["fidelityPoints"];
}
?>


<p>votre total de point est de <?php echo $points ?></p>


<?php
include 'footer.php';
?>