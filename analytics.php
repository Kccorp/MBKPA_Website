<?php
require __DIR__ . "/header.php";
require __DIR__ . "/banner.php";
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true") {

}
?>

    <section class="home dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class='uil bx bx-tachometer'></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class='bx bxs-wink-smile' ></i>
                        <span class="text">Trot en circulation</span>
                        <span class="number">50,120</span>
                    </div>
                    <div class="box box2">
                        <i class='bx bxs-upside-down' ></i>
                        <span class="text">Trot en réparation</span>
                        <span class="number">20,120</span>
                    </div>
                    <div class="box box3">
                        <i class='bx bxs-flag-checkered' ></i>
                        <span class="text">Nombres de courses</span>
                        <span class="number">10,120</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!--<script src="script.js"></script>-->


<?php
include 'footer.php';
?>