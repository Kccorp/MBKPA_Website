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

}
