<?php
include 'header.php';
?>

<h1>Formules</h1>

<!-- Members section -->
<div class="row">
    <div class="boxBack shadow border col-md mt-5 mb-5">
        <div class="row">
            <h3 class="offset-md-4 col-md-4 mt-4 font-weight-bolder mt-2" id="membres">Formules</h3>
            <form class="form-inline my-2 my-lg-0 offset-1 col-md-2">
                <input onkeyup="searchSub()" class="form-control mr-sm-2 mt-3" id="searchSub" type="searchSub" placeholder="Rechercher" aria-label="search">
            </form>
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
                        <th scope="col">Prix par min</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <tbody id="searchSub">

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

                                echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#'.$info.'" >EDIT</button>';
                                ?>
                               <?php echo '<div class="modal fade" id="'.$info.'" tabindex="-1" role="dialog" aria-labelledby="'.$info.'" aria-hidden="true">'; ?>
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New message'.$info.'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form>
                                          <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                                            <input type="text" class="form-control" id="recipient-name">
                                          </div>
                                          <div class="form-group">
                                            <label for="message-text" class="col-form-label">Message:</label>
                                            <textarea class="form-control" id="message-text"></textarea>
                                          </div>
                                        </form>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Send message</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>
                    <?php



//                                echo '<div class="dropdown">';
//                                echo '<td><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
//                                echo '<img src="Assets/Pictures/211751_gear_icon.svg" width="20px"  id='.$info.'>';
//                                echo '</button>';
//                                echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
//                                echo '<a onclick="changeStatus(1,'.$info.')" class="dropdown-item" href="#">Bannir</a>';
//                                echo '<a onclick="changeStatus(2,'.$info.')" class="dropdown-item" href="#">Promouvoir Admin</a>';
//                                echo '<a onclick="changeStatus(3,'.$info.')" class="dropdown-item" href="#">Promouvoir Partenaire</a>';
//                                echo '<a onclick="changeStatus(4,'.$info.')" class="dropdown-item" href="#">Débannir</a>';
//                                echo '<a onclick="changeStatus(5,'.$info.')" class="dropdown-item" href="#">Retirer Admin</a>';
//                                echo '<a onclick="changeStatus(6,'.$info.')" class="dropdown-item" href="#">Retirer Partenaire</a>';
//                                echo '<a onclick="changeStatus(7,'.$info.')" class="dropdown-item" href="#">Supprimer le compte</a>';
//                                echo '</div>';
//                                echo '</div></td>';



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



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
</body>
</html>

