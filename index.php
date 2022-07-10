<?php
require __DIR__ . "/header.php";
require __DIR__ . "/banner.php";

if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true") {

    echo "<div class='alert alert-success'>";
    echo "Bonjour " . $_SESSION["info"]["name"] ." ". $_SESSION["info"]["lastName"] . " !";
    echo "</div>";

}
?>

<body>

<section class="home">
   <div class="first" style="background-color: #0033ff; height: 20vh; left: 0">
       Test
   </div>
</section>

<?php
require 'footer.php';
?>

