<?php
require __DIR__ . "/header.php";
require __DIR__ . "/banner.php";
require __DIR__ . "vendor/autoload.php";

if (!empty($_SESSION["listOfErrors"])) {
    echo "<div class='alert alert-danger'>";

    foreach ($_SESSION["listOfErrors"] as $error) {
        echo $error . "<br>";
    }

    echo "</div>";
    unset($_SESSION["listOfErrors"]);

}
$stripe = new \Stripe\StripeClient(
    'sk_test_51KwpzKJW6etdvbpFazWo3CLbeSnn5VKOjpVFMTAeSHxfYlshGFvli0dFvdbdD5L1H0n6y8uzmlOXBlkvdfeUxRZW00z8fWVUDk'
);



$coupons = $stripe->promotionCodes->all(['limit' => 100,'active' => true]);



?>
 <table class="table table-hover my-4">
                    <thead>
                    <tr>
                        <th scope="col">ID customer</th>
                        <th scope="col">id code promo</th>
                        <th scope="col">id coupon</th>
                        <th scope="col">code</th>
                        <th scope="col">nb de fois utilisé</th>
                        <th scope="col">montant</th>
                        <th scope="col">nom du coupon</th>

                    </tr>
                    </thead>
                    <tbody id="selectMembers">

                    <?php
                    foreach ($coupons['data'] as $coupon) {
                        echo "<tr>";
                        echo "<td>" . $coupon['customer'] . "</td>";
                        echo "<td>" . $coupon['id'] . "</td>";
                        echo "<td>" . $coupon['coupon']['id'] . "</td>";
                        echo "<td>" . $coupon['code'] . "</td>";
                        echo "<td>" . $coupon['times_redeemed'] . "</td>";
                        if ($coupon['coupon']['amount_off'] == null) {
                            echo "<td>" . $coupon['coupon']['percent_off'] . "%</td>";
                        } else {
                            echo "<td>" . number_format($coupon['coupon']['amount_off']/100,2) . "€</td>";
                        }
                        echo "<td>" . $coupon['coupon']['name'] . "</td>";



                            if (!empty($coupon['coupon']['id'])) {
                                echo '<div class="dropdown">';

                                echo '<td><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                echo '<img src="Assets/Pictures/211751_gear_icon.svg" width="20px"  id=' . $coupon['coupon']['id'] . '>';
                                echo '</button>';
                                echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                echo '<a onclick="DeleteCoupon(1,' . $coupon['coupon']['id'] . ')" class="dropdown-item" href="#">supprimer le coupon</a>';
                                echo '</div>';

                                echo '</div></td>';

                            }


                        echo "</tr>";
                    }

                    ?>
                    </tbody>
                </table>



















</body>
<?php
include 'footer.php';
?>