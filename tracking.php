<?php
require __DIR__ . "/header.php";
require __DIR__ . "/banner.php";
?>

<!-- Statistiques section -->
<section class="home">

<div class="container">
    <div class="row">
        <div class="row">
            <h3 class="offset-md-4 col-md-4 font-weight-bolder mt-2 mb-5" id="stats">Tracking</h3>
        </div>

        <div class="row justify-content-around">

            <!-- Argent total gagné-->
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class=" col-12 shadow-sm ps-4 pt-4 mb-3" style="background-color: white; border-radius: 10px">
                            <div class="ms-4 mb-3"><b>Revenus</b></div>
                            <canvas id="incomeChart"  height="80%"></canvas>
                        </div>
                    </div>
                    <div class="col-4">
                        <row>
                            <div class="col-12 shadow-sm ps-4 pt-4 mb-2" style="background-color: white; border-radius: 10px">
                                <div class="ms-4 mb-3"><b>Revenus total</b></div>
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
                            <div class="col-12 shadow-sm ps-4 pt-4 " style="background-color: white; border-radius: 10px">
                                <div class="ms-4 mb-3"><b>Dépense moyenne par client</b></div>
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
                        </row>
                    </div>
                </div>

            <div class="row justify-content-center">

                <div class="col-6">
                    <div class="col-12 shadow-sm ps-4 pt-4 mb-2" style="background-color: white; border-radius: 10px">
                        <div class="ms-4 mb-3"><b>Nouveaux incrits</b></div>
                        <div class="row">
                            <div class="col-12">
                                <canvas id="totalVisitor"  height="80%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 pt-5">
                    <div class="col-12 shadow-sm ps-4 pt-4 mb-2" style="background-color: white; border-radius: 10px">
                        <div class="ms-4 mb-3"><b>Trotinette total</b></div>
                        <div class="row">
                            <div class="col-1 offset-1">
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
                            <div class="col-8 offset-2">
                                <canvas id="RatioScooter"  height="80%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-3">
                <div class="col-4">
                    <div class="col-12 shadow-sm ps-4 pt-4 mb-2" style="background-color: white; border-radius: 10px">
                        <div class="ms-4 mb-3"><b>Nombre total de client inscrit</b></div>
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
                    </div>
                </div>
                <div class="col-4">
                    <div class="col-12 shadow-sm ps-4 pt-4 mb-2" style="background-color: white; border-radius: 10px">
                        <div class="ms-4 mb-3"><b>Activité en temps réel</b></div>
                        <div class="row justify-content-center">
                            <p class="font-weight-bolder display-4 text-center">
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
                                echo $cpt;
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="col-12 shadow-sm ps-4 pt-4 mb-2" style="background-color: white; border-radius: 10px">
                        <div class="ms-4 mb-3"><b>Visiteur par device</b></div>
                        <div class="row">
                            <canvas id="deviceChart"  ></canvas>
                        </div>
                    </div>
                </div>

            </div>

        </div>



        </div>
    </div>
</div>


</section>



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