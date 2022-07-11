<?php
require __DIR__ . "/header.php";
require __DIR__ . "/banner.php";

require 'vendor/autoload.php';
$stripe = new \Stripe\StripeClient(
    'sk_test_51KwpzKJW6etdvbpFazWo3CLbeSnn5VKOjpVFMTAeSHxfYlshGFvli0dFvdbdD5L1H0n6y8uzmlOXBlkvdfeUxRZW00z8fWVUDk'
);
?>

    <div class="home">
<?php
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






    <table class="table table-hover my-4">
        <thead>
        <tr>

            <th scope="col">code</th>

            <th scope="col">montant</th>
            <th scope="col">nom du coupon</th>

        </tr>
        </thead>
        <tbody id="selectMembers">

        <?php
        $coupons = $stripe->promotionCodes->all(['limit' => 100,'active' => true]);
        foreach ($coupons['data'] as $coupon) {
            echo "<tr>";

            echo "<td>" . $coupon['code'] . "</td>";
            if ($coupon['coupon']['amount_off'] == null) {
                echo "<td>" . $coupon['coupon']['percent_off'] . "%</td>";
            } else {
                echo "<td>" . number_format($coupon['coupon']['amount_off']/100,2) . "€</td>";
            }
            echo "<td>" . $coupon['coupon']['name'] . "</td>";





            echo "</tr>";
        }

        ?>
        </tbody>
    </table>



</div>




<?php
include 'footer.php';
?>