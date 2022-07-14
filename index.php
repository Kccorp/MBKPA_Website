<?php
require __DIR__ . "/header.php";
require __DIR__ . "/banner.php";
?>
<body>

<section class="home">
<?php
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true") {

    echo "<div class='alert alert-success'>";
    echo "Bonjour " . $_SESSION["info"]["name"] ." ". $_SESSION["info"]["lastName"] . " !";
    echo "</div>";

}
?>
    <h2>Testez notre simulation de location de trotinette</h2>
    <a href="webGl.html">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </a>
</section>

<?php
require 'footer.php';
?>

