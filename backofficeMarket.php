<?php
require 'header.php';
require "banner.php";
include 'vendor/autoload.php';

?>
<section class="home">
<?php
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true" && $_SESSION["info"]["isAdmin"]== "1") {

    echo "<div class='alert alert-success'>";
    echo "Bonjour " . $_SESSION["info"]["name"] ." ". $_SESSION["info"]["lastName"] . " !";
    echo "</div>";




$stripe = new \Stripe\StripeClient(
    'sk_test_51KwpzKJW6etdvbpFazWo3CLbeSnn5VKOjpVFMTAeSHxfYlshGFvli0dFvdbdD5L1H0n6y8uzmlOXBlkvdfeUxRZW00z8fWVUDk'
);

?>

        <div class="boxBack shadow border col-md mt-5 mb-5">
            <div class="row">
                <h3 class="offset-md-4 col-md-4 mt-4 font-weight-bolder mt-2" id="membres">Partners</h3>
                <form class="form-inline my-2 my-lg-0 offset-1 col-md-2">
                    <input onkeyup="searchMembres(1)" class="form-control mr-sm-2 mt-3" id="searchMembers" type="searchMembers" placeholder="Rechercher" aria-label="search">
                </form>
            </div>
            <div class="row">
                <div class="offset-md-1 col-md-10">
<?php
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
                                echo "<a onclick=\"deleteCoupon('".$coupon['coupon']['id'] ."')\" class=\"dropdown-item\" href=\"#\">supprimer le coupon</a>";
                                echo '</div>';

                                echo '</div></td>';

                            }


                            echo "</tr>";
                        }

                        ?>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-primary offset-3 col-1 my-3 " data-bs-toggle="modal" data-bs-target="#addSub" >AJOUTER</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal add sub -->
    <form method="post" action="addSub.php">
        <div class="modal fade" id="addSub" tabindex="-1" role="dialog" aria-labelledby="addSub" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter une formule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="container-fluid">

                            <div class="row my-3">
                                <div class="form-group col-12" >
                                    <label for="package-name" class="col-form-label col-2">Nom du code promo : </label>
                                    <input type="text" class="col-6" name="name">
                                </div>
                            </div>



                            <div class="row my-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label col-2">en pourcentage ?</label>
                                    <input class="col-2" name="isPercent" list="datalistOptions" id="exampleDataList">
                                    <datalist id="datalistOptions">
                                        <option value="true">
                                        <option value="false">
                                    </datalist>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label col-5">Pourcentage ou Montant (sans décimal) :</label>
                                    <input type="text" class="col-4" name="amount" >
                                </div>
                            </div>




                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</section>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="js/backoffice.js"></script>
    <script src="js/header.js"></script>
    </body>
    </html>

<?php
require "footer.php";
}else{
    echo "<script>alert('Vous n avez pas accès à cette page') </script>";

}