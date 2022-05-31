<?php
include 'header.php';
?>

<h1>Formules</h1>

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
    <div class="boxBack shadow border col-md mt-5 mb-5">
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
                        <th scope="col">Prix</th>
                        <th scope="col">Trajet</th>
                        <th scope="col">Status</th>
                        <th scope="col">PPM</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <div id="searchSub" >

                    <?php
                    $connection = connectDB();
                    $queryPrepared = $connection->prepare("SELECT *  FROM ".PRE."package ");
                    $queryPrepared->execute();
                    $packages = $queryPrepared->fetchAll( PDO::FETCH_ASSOC );

                    foreach ($packages as $package => $infopakage ) {
                        foreach ($infopakage as $key => $value){
                            if ($key == 'idPackage'){
                                echo "<th scope=row>".$value."</th>";
                            } elseif ($key == "name" || $key == "price" || $key == "pricePerMin" || $key == "description" ){
                                echo "<td>".$value."</td>";
                            } elseif ( $key == "duration" || $key == "status"){
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

                                              <div class="form-group my-2">
                                                  <label for="recipient-name" class="col-form-label col-5">Nombre de trajets :</label>
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
                                <label for="recipient-name" class="col-form-label col-5">Nombre de trajets :</label>
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


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

