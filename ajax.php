<?php
session_start();
require 'fonctions.php';

if (isset($_GET['idUser']) && isset($_GET['idParams'])) {
    $idUser = intval($_GET['idUser']) or die('Error : idUser is not an integer');
    $idParams = intval($_GET['idParams']) or die('Error : idParams is not an integer');


    $connection = connectDB();

    if ($idParams==1) {

        $queryPrepared = $connection->prepare("UPDATE ".PRE."user SET isBanned=1 where idUser=:id_user");
        $queryPrepared->execute(["id_user"=>$idUser]);

    } elseif ($idParams==2) {

        $queryPrepared = $connection->prepare("UPDATE ".PRE."user SET isAdmin=1 where idUser=:id_user");
        $queryPrepared->execute(["id_user"=>$idUser]);

    }elseif ($idParams==3) {


        $queryPrepared = $connection->prepare("UPDATE ".PRE."user SET isPartner=1 WHERE idUser=:id_user");
        $queryPrepared->execute(["id_user"=>$idUser]);

    }elseif ($idParams==4) {

        $queryPrepared = $connection->prepare("UPDATE ".PRE."user SET isBanned=0 where idUser=:id_user");
        $queryPrepared->execute(["id_user"=>$idUser]);

    }elseif ($idParams==5) {

        $queryPrepared = $connection->prepare("UPDATE ".PRE."user SET isAdmin=0 where idUser=:id_user");
        $queryPrepared->execute(["id_user"=>$idUser]);

    }elseif ($idParams==6) {

        $queryPrepared = $connection->prepare("UPDATE ".PRE."user SET isPartner=0 where idUser=:id_user");
        $queryPrepared->execute(["id_user"=>$idUser]);


    }elseif ($idParams==7){

        $queryPrepared = $connection->prepare("DELETE FROM ".PRE."user WHERE idUser = :id_user");
        $queryPrepared->execute(["id_user"=>$idUser]);
    }

} elseif (isset($_GET['searchMembers'])) {

    $members = $_GET['searchMembers']."%";

    $connection = connectDB();
    $queryPrepared = $connection->prepare("SELECT idUser, name, lastName, email, isBanned, isPartner, isAdmin, fidelityPoints FROM ".PRE."user WHERE name LIKE :name or lastName LIKE :lastName or email LIKE :email or idUser LIKE :idUser");
    $queryPrepared->execute(["name"=>$members, "lastName"=>$members, "email"=>$members, "idUser"=>$members]);
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

                echo '<td><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                echo '<img src="Assets/Pictures/211751_gear_icon.svg" width="20px"  id='.$info.'>';
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

}
