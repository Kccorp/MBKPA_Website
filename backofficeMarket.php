<?php
require 'header.php';
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true") {

    echo "<div class='alert alert-success'>";
    echo "Bonjour " . $_SESSION["info"]["name"] ." ". $_SESSION["info"]["lastName"] . " !";
    echo "</div>";

}
?>
<html>
<body>

    <h1>Welcome to the Marketing Backoffice page </h1>
    <p>
        Here you can manage your partner and reduction !
    </p>

<!-- Partner section -->
<div class="row">
    <div class="boxBack shadow border col-md mt-5 mb-5">
        <div class="row">
            <h3 class="offset-md-4 col-md-4 mt-4 font-weight-bolder mt-2" id="membres">Partners</h3>
            <form class="form-inline my-2 my-lg-0 offset-1 col-md-2">
                <input onkeyup="searchMembres(1)" class="form-control mr-sm-2 mt-3" id="searchMembers" type="searchMembers" placeholder="Rechercher" aria-label="search">
            </form>
        </div>
        <div class="row">
            <div class="offset-md-1 col-md-10">

                <table class="table table-hover my-4">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom du Partenaire</th>
                        <th scope="col">Email</th>
                        <th scope="col">Adresse du Partenaire</th>
                        <th scope="col">Points de fidélités</th>
                    </tr>
                    </thead>
                    <tbody id="selectMembers">

                    <?php
                    $connection = connectDB();
                    $queryPrepared = $connection->prepare("SELECT idUser, partnerName, email, partnerAddress, fidelityPoints FROM ".PRE."user WHERE isPartner=1");
                    $queryPrepared->execute();
                    $results = $queryPrepared->fetchALL(PDO::FETCH_ASSOC);

                    foreach ($results as $partners => $infopartners ) {
                        foreach ($infopartners as $cle => $info) {
                            if ($cle == "idUser") {
                                echo "<th scope=row>".$info."</th>";
                            } elseif ($cle == "email" || $cle == "partnerName" || $cle == "partnerAddress") {
                                echo "<td>".$info."</td>";

                            }elseif ($cle == "fidelityPoints") {
                                echo "<td class='text-center'>".$info."</td>";
                            }
                        }


                        foreach ($infopartners as $cle => $info) {
                            if ($cle == 'idUser') {
                                echo '<div class="dropdown">';

                                echo '<td><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                echo '<img src="Assets/Pictures/211751_gear_icon.svg" width="20px"  id='.$info.'>';
                                echo '</button>';
                                echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
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


