<?php
include 'header.php';
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true") {

    echo "<div class='alert alert-success'>";
    echo "Bonjour " . $_SESSION["info"]["name"] ." ". $_SESSION["info"]["lastName"] . " !";
    echo "</div>";

}

?>
<!-- centrer les elements -->
<div class="container">
    <div class="row ">
        <div class="col-md-12 mt-5">
            <div class="jumbotron">
                <h1>Welcome to the home page</h1>
                <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                <a class="btn btn-primary btn-lg" href="newUser.php" role="button">S'inscrire &raquo;</a>
                <a class="btn btn-primary btn-lg" href="login.php" role="button">Se connecter &raquo;</a>
            </div>
        </div>
    </div>
</div>




