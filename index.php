<?php
require 'header.php';
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true") {

    echo "<div class='alert alert-success'>";
    echo "Bonjour " . $_SESSION["info"]["name"] ." ". $_SESSION["info"]["lastName"] . " !";
    echo "</div>";

}
?>

<h1>Scroll animation</h1>

<section class="animation">
    <img class="human" src="assets/pictures/human.png" alt="Trotinette qui roule"/>
</section>



<?php
include 'footer.php';
?>

