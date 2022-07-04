<?php
include 'header.php';
?>

<h1>Catalogue</h1>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h2>Service</h2>

            <?php if (!empty($_SESSION["listOfErrors"])) {
                echo "<div class='alert alert-danger'>";

                foreach ($_SESSION["listOfErrors"] as $error) {
                    echo $error . "<br>";
                }

                echo "</div>";
                unset($_SESSION["listOfErrors"]);

            } ?>

            <!-- Members section -->
            <div class="row">
                <div class="shadow border col-md mt-5 mb-5">
                    <div class="row">
                        <h3 class="offset-md-4 col-md-3 mt-4 font-weight-bolder mt-2" id="membres">Formules</h3>
                        <button type="button" class="btn btn-primary offset-3 col-1 my-3 " data-bs-toggle="modal" data-bs-target="#addSub" >AJOUTER</button>
                    </div>
                    <div class="row">
                        <div class="offset-md-1 col-md-10">

                            <table class="table table-hover my-4">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Trajet</th>
                                    <th scope="col">durée</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">PPM</th>

                                </tr>
                                </thead>
                                <div id="searchSub" >

                                    <?php
                                    $connection = connectDB();
                                    $queryPrepared = $connection->prepare("SELECT idPackage, name, description, price, numberOfRide, duration, status, pricePerMin  FROM ".PRE."package ");
                                    $queryPrepared->execute();
                                    $packages = $queryPrepared->fetchAll( PDO::FETCH_ASSOC );

                                    foreach ($packages as $package => $infopakage ) {
                                    foreach ($infopakage as $key => $value){
                                        if ($key == 'idPackage'){
                                            echo "<th scope=row>".$value."</th scope=row>";
                                        } elseif ($key == "name" ){
                                            echo "<td>".$value."</td>";
                                        }elseif ( $key == "price" ){
                                            echo "<td>".$value."</td>";
                                        }elseif ($key == "numberOfRide"  ){
                                            echo "<td>".$value."</td>";
                                        }elseif ( $key == "duration" ){
                                            echo "<td>".$value."</td>";
                                        } elseif ( $key == "status" ){
                                            echo "<td>".$value."</td>";
                                        }elseif ($key == "pricePerMin" ){
                                            echo "<td>".$value."</td>";
                                        }elseif ( $key == "description"){
                                            echo "<td>".$value."</td>";
                                        }
                                    }



                                    foreach ($infopakage as $cle => $info) {
                                    if ($cle == 'idPackage') {

                                    echo '<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#'.$infopakage["name"].$infopakage["idPackage"].'" >EDIT</button>';
                                    if ($infopakage["status"] != "hs"){
                                        echo '<td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#'.$infopakage["name"].$infopakage["idPackage"].'disable" >DESACTIVER</button>';
                                    } else {
                                        echo '<td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#'.$infopakage["name"].$infopakage["idPackage"].'enable" >ACTIVER</button>';
                                    }
                                    ?>

                                    <!--  Modal SUB-->
                                    <?php echo '<div class="modal fade" id="'.$infopakage["name"].$infopakage["idPackage"].'enable" tabindex="-1" role="dialog" aria-labelledby="'.$infopakage["name"].$infopakage["idPackage"].'" aria-hidden="true">'; ?>
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <?php echo '<h5 class="modal-title" >'.$infopakage["name"].'</h5>' ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <p>Voulez-vous vraiment activer la formule <b> <i> <?php echo $infopakage["name"]?> </i> </b> ?</p>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <?php echo '<a href="stateSub.php?idPackage='.$infopakage["idPackage"].'&state=ok"><button type="button" class="btn btn-success">Activer</button></a>'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- DELETE Modal SUB-->
                                <?php echo '<div class="modal fade" id="'.$infopakage["name"].$infopakage["idPackage"].'disable" tabindex="-1" role="dialog" aria-labelledby="'.$infopakage["name"].$infopakage["idPackage"].'" aria-hidden="true">'; ?>
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <?php echo '<h5 class="modal-title" >'.$infopakage["name"].'</h5>' ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Voulez-vous vraiment supprimer la formule <b> <i> <?php echo $infopakage["name"]?> </i> </b> ?</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <?php echo '<a href="stateSub.php?idPackage='.$infopakage["idPackage"].'&state=hs"><button type="button" class="btn btn-danger">Désactiver</button></a>'; ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- EDIT Modal SUB -->
                        <?php echo '<div class="modal fade" id="'.$infopakage["name"].$infopakage["idPackage"].'" tabindex="-1" role="dialog" aria-labelledby="'.$infopakage["name"].$infopakage["idPackage"].'" aria-hidden="true">'; ?>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <?php echo '<h5 class="modal-title" >'.$infopakage["name"].'</h5>' ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="updateSub.php?idPackage=<?php echo $infopakage["idPackage"]; ?>" method="post">
                                    <div class="modal-body">
                                        <div class="container-fluid">

                                            <div class="row justify-content-around my-2">
                                                <label for="id-number" class="col-form-label col-6"><b>ID : <?php echo $infopakage["idPackage"]; ?></b></label>
                                                <label for="package-name" class="col-form-label col-6"><b>Nom : <?php echo $infopakage["name"]; ?></b></label>
                                            </div>

                                            <div class="row my-2">
                                                <div class="form-group col-6" >
                                                    <label for="recipient-name" class="col-form-label ">Prix :</label>
                                                    <input type="text" class="col-4" name="price" value="<?php echo $infopakage["price"]; ?>"> €
                                                </div>

                                                <div class="form-group col-6 " >
                                                    <label for="recipient-name" class="col-form-label ">PPM :</label>
                                                    <input type="text" class="col-4" name="pricePerMin" value="<?php echo $infopakage["pricePerMin"]; ?>"> €
                                                </div>
                                            </div>

                                            <div class="row my-3">
                                                <div class="form-group col-12" >
                                                    <label for="package-name" class="col-form-label col-2">Id Strip : </label>
                                                    <input type="text" class="col-6" name="idStrip" value="<?php echo $infopakage["idStripe"] ?>" placeholder="<?php echo $infopakage["idStripe"] ?>">
                                                    <div class="row">
                                                        <a href="https://dashboard.stripe.com/test/products?active=true" target="_blank"><small class="form-text text-muted" >Veuillez créer un identifiant Strip depuis leur site </small></a>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group my-2">
                                                <label for="recipient-name" class="col-form-label col-5">Nombre de trajets (-1 pour illimités) :</label>
                                                <input type="text" class="col-4" name="duration" value="<?php echo $infopakage["numberOfRide"]; ?>">
                                            </div>

                                            <div class="form-group my-2">
                                                <label for="recipient-name" class="col-form-label col-5">Durée (en jours) :</label>
                                                <input type="text" class="col-4" name="duration" value="<?php echo $infopakage["duration"]; ?>">
                                            </div>

                                            <div class="form-group my-2">
                                                <label for="message-text" class="col-form-label">Description :</label>
                                                <textarea class="form-control" rows="4" name="description" id="message-text"><?php echo $infopakage["description"]; ?></textarea>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Modifier l'abonnement</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    </td>
                    <?php
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

    <div class="row mt-5">
        <div class="col-12">
            <div class="row">
                <h2 id="product" class="col-8 mt-3 ">Produits</h2>
                <button type="button" class="btn btn-primary offset-2 col-1 my-3 " data-bs-toggle="modal" data-bs-target="#addItem" >+</button>
            </div>
            <?php if (!empty($_SESSION["listOfErrorsShop"])) {
                echo "<div class='alert alert-danger'>";

                foreach ($_SESSION["listOfErrorsShop"] as $error) {
                    echo $error . "<br>";
                }

                echo "</div>";
                unset($_SESSION["listOfErrorsShop"]);

            } ?>
            <div class="row">
                <?php

                $connection = connectDB();
                $queryPrepare = $connection->prepare("SELECT * FROM ".PRE."merchandise");
                $queryPrepare->execute();
                $merchandises = $queryPrepare->fetchAll(PDO::FETCH_ASSOC);


                foreach ($merchandises as $row => $infoMerch){

                    ?>
                    <div class="card mt-5 me-4" style="width: 18rem;">


                        <?php if(!empty($infoMerch["urlImage"]) && file_exists($infoMerch["urlImage"])){
                            echo '<img src="'.$infoMerch["urlImage"].'" class="card-img-top" alt="...">';
                        } else {
                            echo '<img src="Assets/Shop/noImage.png" class="card-img-top" alt="...">';
                        }
                        ?>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mt-auto"><?php echo $infoMerch["name"] ?></h5>
                            <p class="card-text "><?php echo $infoMerch["fullname"] ?></p>
                            <p class="card-text "><?php echo $infoMerch["price"] ?> €</p>
<!--                            <a href="item.php?idMerchandise=--><?php //echo $infoMerch["idMerchandise"] ?><!--" class="btn btn-primary ">Modifier l'article</a>-->
                            <div class="row justify-content-around">
                                <button type="button" class="btn btn-primary col-5 " data-bs-toggle="modal" data-bs-target="#<?php echo $infoMerch["name"] ?>edit" >Modifier l'article</button>
                                <button type="button" class="btn btn-danger col-6" data-bs-toggle="modal" data-bs-target="#<?php echo $infoMerch["name"] ?>delete" >Supprimer l'article</button>

                                <!-- EDIT Modal Shop-->
                                <?php echo '<div class="modal fade" id="'.$infoMerch["name"].'edit" tabindex="-1" role="dialog" aria-labelledby="'.$infoMerch["name"].'" aria-hidden="true">'; ?>
                                    <form method="post" action="editItem.php?idMerchandise=<?php echo $infoMerch["idMerchandise"].'&image='.$infoMerch["urlImage"]; ?>" enctype="multipart/form-data">

                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modifier <?php echo $infoMerch["name"]; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="container-fluid">

                                                        <div class="row my-3">
                                                            <div class="form-group col-12" >
                                                                <label for="id-number" class="col-form-label col-6"><b>Nom : <?php echo $infoMerch["name"]; ?></b></label>
                                                            </div>
                                                        </div>

                                                        <div class="row my-3">
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Nom complet :</label>
                                                                <textarea class="form-control" rows="2" name="fullname" id="fullname" > <?php echo $infoMerch["fullname"] ?> </textarea>
                                                            </div>
                                                        </div>

                                                        <div class="row my-3">
                                                            <div class="form-group col-12" >
                                                                <label for="package-name" class="col-form-label col-2">Id Strip : </label>
                                                                <input type="text" class="col-6" name="idStrip" value="<?php echo $infoMerch["idStripe"] ?>">
                                                                <div class="row">
                                                                    <a href="https://dashboard.stripe.com/test/products?active=true" target="_blank"><small class="form-text text-muted" >Veuillez créer un identifiant Strip depuis leur site </small></a>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row my-3">
                                                            <div class="form-group col-6" >
                                                                <label for="recipient-name" class="col-form-label ">Prix :</label>
                                                                <input type="text" class="col-4" name="price" value="<?php echo $infoMerch["price"] ?>"> €
                                                            </div>

                                                        </div>

                                                        <div class="row my-3">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label ">Image :</label>
                                                                <?php
                                                                    echo '<img src="'.$infoMerch["urlImage"].'" class="col-4" alt="">';
                                                                    echo '<input type = "file" class="btn-sm mt-2" id = "images"  name = "fichier" accept = "image/png,image/jpeg,image/gif">';

                                                                ?>
                                                            </div>
                                                        </div>


                                                        <div class="row my-3">
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Description :</label>
                                                                <textarea class="form-control" rows="4" name="description" id="message-text"><?php echo $infoMerch["description"] ?></textarea>                                                              </textarea>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </div>

                                            </div>
                                        </div>

                                    </form>
                                <?php echo '</div>'; ?>

                                <!-- DELETE Modal Shop-->
                                <?php echo '<div class="modal fade" id="'.$infoMerch["name"].'delete" tabindex="-1" role="dialog" aria-labelledby="'.$infoMerch["name"].'" aria-hidden="true">'; ?>
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <?php echo '<h5 class="modal-title" >'.$infoMerch["name"].'</h5>' ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <p>Voulez-vous vraiment supprimer l'article <b> <i> <?php echo $infoMerch["name"]?> </i> </b> ?</p>
                                            </div>

                                            <div class="modal-body">
                                                <img src="<?php echo $infoMerch["urlImage"] ?>" class="card-img-top" alt="...">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <?php echo '<a href="deleteItem.php?idItem='.$infoMerch["idMerchandise"].'"><button type="button" class="btn btn-danger">Supprimer</button></a>'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <!-- Modal add Shop -->
    <form method="post" action="addItem.php" enctype="multipart/form-data">
        <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="addItem" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un item</h5>
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
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Nom complet :</label>
                                    <textarea class="form-control" rows="2" name="fullname" id="fullname"></textarea>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="form-group col-12" >
                                    <label for="package-name" class="col-form-label col-2">Id Strip : </label>
                                    <input type="text" class="col-6" name="idStrip">
                                    <div class="row">
                                        <a href="https://dashboard.stripe.com/test/products?active=true" target="_blank"><small class="form-text text-muted" >Veuillez créer un identifiant Strip depuis leur site </small></a>
                                    </div>

                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="form-group col-6" >
                                    <label for="recipient-name" class="col-form-label ">Prix :</label>
                                    <input type="text" class="col-4" name="price"> €
                                </div>

                            </div>

                            <div class="row my-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label ">Image :</label>
                                    <input type="file" class="btn-sm" id="images"  name="fichier" accept="image/png,image/jpeg,image/gif">
                                </div>
                            </div>


                            <div class="row my-3">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Description :</label>
                                    <textarea class="form-control" rows="4" name="description" id="message-text"></textarea>
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
                                    <label for="package-name" class="col-form-label col-2">Nom : </label>
                                    <input type="text" class="col-6" name="name">
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="form-group col-6" >
                                    <label for="recipient-name" class="col-form-label ">Prix :</label>
                                    <input type="text" class="col-4" name="price"> €
                                </div>

                                <div class="form-group col-6" >
                                    <label for="recipient-name" class="col-form-label ">PPM :</label>
                                    <input type="text" class="col-4" name="pricePerMin" > €
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="form-group col-12" >
                                    <label for="package-name" class="col-form-label col-2">Id Strip : </label>
                                    <input type="text" class="col-6" name="idStrip">
                                    <div class="row">
                                        <a href="https://dashboard.stripe.com/test/products?active=true" target="_blank"><small class="form-text text-muted" >Veuillez créer un identifiant Strip depuis leur site </small></a>
                                    </div>

                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label col-2">Status :</label>
                                    <input class="col-2" name="status" list="datalistOptions" id="exampleDataList">
                                    <datalist id="datalistOptions">
                                        <option value="ok">
                                        <option value="hs">
                                    </datalist>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label col-5">Nombre de trajets (-1 pour illimités) :</label>
                                    <input type="text" class="col-4" name="numberOfRide" >
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label col-5">Durée (en jours) :</label>
                                    <input type="text" class="col-4" name="duration" >
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Description :</label>
                                    <textarea class="form-control" rows="4" name="description" id="message-text"></textarea>
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

        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>