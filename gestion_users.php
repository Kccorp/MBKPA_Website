<?php
require __DIR__ . "/header.php";
require __DIR__ . "/banner.php";
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true") {

}
?>
    <section class="home" style="">

        <div class="dash-content">
            <div class="overview">

                <div class="activity">
                    <div class="title">
                        <i class='bx bxs-group' ></i>
                        <span class="text">Gestion des utilisateurs</span>
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
            </div>
        </div>
    </section>
    <script src="js/backoffice.js"></script>


<?php
include 'footer.php';
?>