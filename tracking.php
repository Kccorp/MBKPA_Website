<?php
require 'header.php';
?>

<!-- Statistiques section -->
<div class="container">
    <div class="row">
        <div class="row">
            <h3 class="offset-md-4 col-md-4 font-weight-bolder mt-2 mb-5" id="stats">Tracking</h3>
        </div>


        <!-- NOMBRE TOTAL DE VISITEUR -->
        <div class="row justify-content-around">
            <div class="border col-12 col-md-3  mt-3 p-2 shadow-sm">
                <p>
                    <b>Nombre total de visiteur unique</b>
                <div class="row justify-content-center">
                    <p class="font-weight-bolder display-4 text-center">
                        <?php
                        $connection = connectDB();
                        $queryPrepared = $connection->prepare("SELECT count(IpAddress) FROM ".PRE."tracking;");
                        $queryPrepared->execute();
                        $results = $queryPrepared->fetch();
                        echo $results[0];
                        ?>
                    </p>
                </div>
                </p>
            </div>

            <!-- NOMBRE TOTAL DE CLIENT-->
            <div class="border col-12 col-md-3  mt-3 p-2 shadow-sm">
                <p>
                    <b>Nombre total de client incrit</b>
                <div class="row justify-content-center">
                    <p class="font-weight-bolder display-4 text-center">
                        <?php
                        $connection = connectDB();
                        $queryPrepared = $connection->prepare("SELECT count(idUser) FROM ".PRE."user;");
                        $queryPrepared->execute();
                        $results = $queryPrepared->fetch();
                        echo $results[0];
                        ?>
                    </p>
                </div>
                </p>
            </div>

            <!-- UTILISATEUR ACTIF-->
            <div class="border col-12 col-md-3 mt-3 p-2 shadow-sm">
                <?php

                $queryPrepared = $connection->prepare("SELECT lastConnect FROM ".PRE."tracking;");
                $queryPrepared->execute();
                $results = $queryPrepared->fetchALL(PDO::FETCH_ASSOC);
                $cpt = 0;
                $currentTime = time();
                foreach ($results as $key ) {
                    foreach ($key as $connect => $date) {
                        $late = strtotime($date);
                        if (($currentTime - $late) <= 60*15){ // pour 15 minutes
                            $cpt++;
                        }
                    }
                }
                ?>
                <p>
                    <b>Activité en temps réel</b>
                <div class="row justify-content-center">
                    <p class="font-weight-bolder display-4 text-center">
                        <?php echo $cpt;?>
                    </p>
                </div>
                </p>
            </div>
        </div>
        <div class="row justify-content-around">

            <!-- APPAREIL LES PLUS UTILISE -->
            <div class="border col-md-5 col-sm-6 mt-3 pt-2 shadow-sm">
                <p class="font-weight-bolder ">
                    <b>Appareil les plus utilisés</b>
                </p>
                <?php

                $queryPrepared = $connection->prepare("SELECT device FROM ".PRE."tracking;");
                $queryPrepared->execute();
                $results = $queryPrepared->fetchALL();
                $windows = 0;
                $ios = 0;
                $macOS = 0;
                $android = 0;
                $unix = 0;
                foreach ($results as $key => $device) {
                    if (preg_match('#Windows#i', $device[0])) {
                        $windows += 1;
                    } elseif (preg_match('#Macintosh#i', $device[0])) {
                        $macOS += 1;
                    } elseif (preg_match('#iPhone#i', $device[0])) {
                        $ios += 1;
                    } elseif (preg_match('#Android#i', $device[0])) {
                        $android += 1;
                    } elseif (preg_match('#X11#i', $device[0])) {
                        $unix += 1;
                    }
                }

                ?>
                <ul class="offset-3 col-5 pl-5 h5" >
                    <li>
                        Windows <?php echo $windows;?>

                    </li>
                    <li>
                        macOS <?php echo $macOS;?>
                    </li>
                    <li>
                        iOS <?php echo $ios;?>
                    </li>
                    <li>
                        Android <?php echo $android;?>
                    </li>
                    <li>
                        Unix <?php echo $unix;?>
                    </li>
                </ul>
            </div>


            <!-- NOMBRE TOTAL DE Trottinette-->
            <div class="border col-12 col-md-3  mt-3 p-2 shadow-sm">
                <p>
                    <b>Nombre total de trotinette</b>
                <div class="row justify-content-center">
                    <p class="font-weight-bolder display-4 text-center">
                        <?php
                        $connection = connectDB();
                        $queryPrepared = $connection->prepare("SELECT count(idScooter) FROM ".PRE."scooter;");
                        $queryPrepared->execute();
                        $results = $queryPrepared->fetch();
                        echo $results[0];
                        ?>
                    </p>
                </div>
                </p>
            </div>

            <!-- NOMBRE DE Trottinette Hors service-->
            <div class="border col-12 col-md-3  mt-3 p-2 shadow-sm">
                    <b>Nombre de trotinette hors service</b>
                <div class="row justify-content-center">
                    <p class="font-weight-bolder display-4 text-center">
                        <?php
                        $connection = connectDB();
                        $queryPrepared = $connection->prepare("SELECT count(idScooter) FROM ".PRE."scooter WHERE status = 'hs';");
                        $queryPrepared->execute();
                        $results = $queryPrepared->fetch();
                        echo $results[0];
                        ?>
                    </p>
                </div>
            </div>

        </div>
        <div class="row justify-content-around">

            <!-- NOMBRE DE Trottinette en service-->
            <div class="border col-12 col-md-3  mt-3 p-2 shadow-sm">
                    <b>Nombre de trotinette en service</b>
                <div class="row justify-content-center">
                    <p class="font-weight-bolder display-4 text-center">
                        <?php
                        $connection = connectDB();
                        $queryPrepared = $connection->prepare("SELECT count(idScooter) FROM ".PRE."scooter WHERE status != 'hs';");
                        $queryPrepared->execute();
                        $results = $queryPrepared->fetch();
                        echo $results[0];
                        ?>
                    </p>
                </div>
            </div>

            <!-- NOMBRE total de course effectué et comparé au mois dernier-->
            <div class="border col-12 col-md-3  mt-3 p-2 shadow-sm">
                <b>Nombre total de course effectué</b>
                <div class="row justify-content-center">
                    <p class="font-weight-bolder display-4 text-center">
                        <?php
                        $connection = connectDB();
                        $queryPrepared = $connection->prepare("SELECT count(idRide) FROM ".PRE."ride;");
                        $queryPrepared->execute();
                        $results = $queryPrepared->fetch();
                        echo $results[0];
                        ?>
                    </p>
                </div>
            </div>

            <!-- NOMBRE de course ce mois-ci-->
            <div class="border col-12 col-md-3  mt-3 p-2 shadow-sm">
                <b>Nombre de course effectué ce mois-ci</b>
                <div class="row justify-content-center">

                    <div class="font-weight-bolder display-4 col-6" style="text-align: right;">
                            <?php
                            $connection = connectDB();
                            $queryPrepared = $connection->prepare("SELECT count(idRide) FROM ".PRE."ride WHERE MONTH(startDate) = MONTH(now())");
                            $queryPrepared->execute();
                            $rideThisMonth = $queryPrepared->fetch();
                            echo $rideThisMonth[0];
                            ?>
                    </div>
                    <div class="col-6 " >
                            <?php
                            $connection = connectDB();
                            $queryPrepared = $connection->prepare("SELECT count(idRide) FROM ".PRE."ride WHERE MONTH(startDate) = MONTH(now())-1");
                            $queryPrepared->execute();
                            $rideLastMonth = $queryPrepared->fetch();

                            $diff = $rideThisMonth[0] - $rideLastMonth[0];
                            $diffPercent = ($diff / $rideLastMonth[0]) * 100;

                            if($diff > 0){
                                echo '<small class="fas fa-arrow-up small" style="color: green">+'.$diffPercent.'%</small>';
                            }elseif($diff < 0){
                                echo '<small class="fas fa-arrow-down small" style="color: red">'.$diffPercent.'%</small>';
                            }

                            ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-around">

            <!-- Argent total gagné-->
            <div class="border col-12 col-md-3  mt-3 p-2 shadow-sm">
                <b>Argent total gagné</b>
                <div class="row justify-content-center">
                    <p class="font-weight-bolder display-4 text-center">
                        <?php
                        $connection = connectDB();
                        $queryPrepared = $connection->prepare("SELECT ROUND(SUM(price), 2) FROM ".PRE."ride;");
                        $queryPrepared->execute();
                        $results = $queryPrepared->fetch();
                        echo $results[0]."€";
                        ?>
                    </p>
                </div>
            </div>

            <!-- Argent gagné ce mois-ci et comparé au mois dernier-->
            <div class="border col-12 col-md-3  mt-3 p-2 shadow-sm">
                <b>Argent gagné ce mois-ci</b>
                <div class="row justify-content-center">

                    <div class="font-weight-bolder display-4 col-6" style="text-align: right;">
                        <?php
                        $connection = connectDB();
                        $queryPrepared = $connection->prepare("SELECT ROUND(SUM(price), 2) FROM ".PRE."ride WHERE MONTH(startDate) = MONTH(now())");
                        $queryPrepared->execute();
                        $rideThisMonth = $queryPrepared->fetch();
                        echo $rideThisMonth[0];
                        ?>
                    </div>
                    <div class="col-6 " >
                        <?php
                        $connection = connectDB();
                        $queryPrepared = $connection->prepare("SELECT ROUND(SUM(price), 2) FROM ".PRE."ride WHERE MONTH(startDate) = MONTH(now())-1");
                        $queryPrepared->execute();
                        $rideLastMonth = $queryPrepared->fetch();

                        $diff = round($rideThisMonth[0] - $rideLastMonth[0], 2);

//                        $diffPercent = round($rideThisMonth-$rideLastMonth, 2);

                        if($diff > 0){
                            echo '<small class="fas fa-arrow-up small" style="color: green">+'.$diff.'</small>';
                        }elseif($diff < 0){
                            echo '<small class="fas fa-arrow-down small" style="color: red">'.$diff.'</small>';
                        }

                        ?>
                    </div>
                </div>
            </div>

            <!-- Argent dépensé en moyenne par les utilisateurs (6 derniers mois)-->
            <div class="border col-12 col-md-3  mt-3 p-2 shadow-sm">
                <b>Dépense moyenne des utilisateurs </b>(6 mois)
                <div class="row justify-content-center">
                    <p class="font-weight-bolder display-4 text-center">
                        <?php
                        $connection = connectDB();
                        $queryPrepared = $connection->prepare("SELECT avg(moyenne) FROM (SELECT avg(price) AS moyenne FROM ".PRE."ride WHERE startDate >= curdate() - interval (dayofmonth(curdate()) - 1) day - interval 6 month group by idUser) AS moyenne");
                        $queryPrepared->execute();
                        $results = $queryPrepared->fetch();
                        echo round($results[0], 2)."€";
                        ?>
                    </p>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="border col-12 col-md-3  mt-3 p-2 shadow-sm">

                <canvas id="myChart" width="400" height="400"></canvas>


            </div>

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
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js'></script>
<script src="js/backoffice.js"></script>
<script src="js/header.js"></script>
<script src="js/chart.js"></script>


</body>
</html>