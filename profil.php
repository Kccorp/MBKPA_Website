<?php
require 'header.php';
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true") {

    echo "<div class='alert alert-success'>";
    echo "Bonjour " . $_SESSION["info"]["name"] ." ". $_SESSION["info"]["lastName"] . " !";

    echo "</div>";

}
$connection =connectDB();
$queryPrepared = $connection->prepare("SELECT fidelityPoints FROM ".PRE."user WHERE idUser = :id_user");
$queryPrepared->execute(["id_user"=>$_SESSION["info"]["idUser"]]);
$results = $queryPrepared->fetch();
$_SESSION["info"]["fidelityPoints"] = $results["fidelityPoints"];
$points=$_SESSION["info"]["fidelityPoints"];
?>


<p>votre total de point est de <?php echo $points ?></p>
<?php if ($points!=0){ ?>
<p>Voulez-vous convertir vos points ?</p>
<p>Vous pouvez actuellement convertir vos points pour <?php echo $points*0.2 ?>€</p>

<form action="create-coupon.php" method="post">
    <?php echo '<input type="hidden" name="points" value="'.$points.'">' ?>
    <input type="submit" value="convertir">
    <?php }else{
    echo "Vous n'avez pas de points à convertir";
    } ?>


<?php
include 'footer.php';
?>