<?php
require __DIR__ . "/header.php";
require __DIR__ . "/banner.php";
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true") {

    $stripe = new \Stripe\StripeClient(
        'sk_test_51KwpzKJW6etdvbpFazWo3CLbeSnn5VKOjpVFMTAeSHxfYlshGFvli0dFvdbdD5L1H0n6y8uzmlOXBlkvdfeUxRZW00z8fWVUDk'
    );
    $coupons = $stripe->promotionCodes->all(['limit' => 100,'active' => true]);

}
?>
<section class="home" style="">

    <div class="dash-content">
        <div class="overview">

            <div class="activity">
                <div class="title">
                    <h2>Gestion des utilisateurs</h2>
                </div>
                <div class="boxBack shadow col-md mt-5 mb-5">
                    <form class="form-inline my-2 my-lg-0 offset-1 col-md-2">
                        <input onkeyup="searchMembres()" class="form-control mr-sm-2 mt-3" id="searchMembers" type="searchMembers" placeholder="Rechercher" aria-label="search">
                    </form>
                    <table class="table table-hover my-2">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Banni</th>
                            <th scope="col">Partenaire</th>
                            <th scope="col">Admin</th>
                            <th scope="col">Points de fidélités</th>
                            <th scope="col">Actions</th>

                        </tr>
                        </thead>
                        <tbody id="selectMembers">

                        <?php
                        $connection = connectDB();
                        $queryPrepared = $connection->prepare("SELECT idUser, name, lastName, email, isBanned, isPartner, isAdmin, fidelityPoints FROM ".PRE."user");
                        $queryPrepared->execute();
                        $results = $queryPrepared->fetchALL(PDO::FETCH_ASSOC);

                        foreach ($results as $users => $infousers ) {
                            foreach ($infousers as $cle => $info) {
                                if ($cle == "idUser") {
                                    echo "<th scope=row>".$info."</th>";
                                } elseif ($cle == "email" || $cle == "name" || $cle == "lastName") {
                                    echo "<td>".$info."</td>";
                                }elseif ($cle== "isBanned" || $cle == "isPartner" || $cle == "isAdmin") {
                                    if ($info==1){
                                        echo "<td>True</td>";
                                    }else {
                                        echo"<td></td>";
                                    }
                                }elseif ($cle == "fidelityPoints") {
                                    echo "<td class='text-center'>".$info."</td>";
                                }
                            }


                            foreach ($infousers as $cle => $info) {
                                if ($cle == 'idUser') {
                                    echo '<div class="dropdown">';

                                    echo '<td><button class="bx bxs-color btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                    echo '<i class="bx bxs-color" id='.$info.'></i>';
                                    echo '</button>';
                                    echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                    echo '<a onclick="changeStatus(1,'.$info.')" class="dropdown-item" href="#">Bannir</a>';
                                    echo '<a onclick="changeStatus(2,'.$info.')" class="dropdown-item" href="#">Promouvoir Admin</a>';
                                    echo '<a onclick="changeStatus(3,'.$info.')" class="dropdown-item" href="#">Promouvoir Partenaire</a>';
                                    echo '<a onclick="changeStatus(4,'.$info.')" class="dropdown-item" href="#">Débannir</a>';
                                    echo '<a onclick="changeStatus(5,'.$info.')" class="dropdown-item" href="#">Retirer Admin</a>';
                                    echo '<a onclick="changeStatus(6,'.$info.')" class="dropdown-item" href="#">Retirer Partenaire</a>';
                                    echo '<a onclick="changeStatus(7,'.$info.')" class="dropdown-item" href="#">Supprimer le compte</a>';
                                    echo '</div>';

                                    echo '</div></td>';

                                }
                            }
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <h2>Gestion des coupons de réduction</h2>
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
    <button type="button" class="btn btn-primary offset-3 col-1 my-3 " data-bs-toggle="modal" data-bs-target="#addCoupon" >AJOUTER</button>
</section>


<!-- Modal add sub -->
<form method="post" action="addCoupon.php">
    <div class="modal fade" id="addCoupon" tabindex="-1" role="dialog" aria-labelledby="addCoupon" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="container-fluid">

                        <div class="row my-3">
                            <div class="form-group col-12" >
                                <label for="package-name" class="col-form-label col-2">Nom : </label>
                                <input type="text" class="col-6" name="name">
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="form-group col-12" >
                                <label for="package-name" class="col-form-label col-3">Montant :</label>
                                <input type="text" class="col-6" name="montant">
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label col-6">Type de montant :</label>
                                <input class="col-6" name="type" list="datalistOptions" id="exampleDataList">
                                <datalist id="datalistOptions">
                                    <option value="Pourcent">
                                    <option value="Fixe">
                                </datalist>
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


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<script src="js/backoffice.js"></script>
<script src="js/header.js"></script>

<?php
require __DIR__ . "/footer.php";
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>