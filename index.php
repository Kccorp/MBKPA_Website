<?php
require 'header.php';
require "banner.php";
if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true") {

    echo "<div class='alert alert-success'>";
    echo "Bonjour " . $_SESSION["info"]["name"] ." ". $_SESSION["info"]["lastName"] . " !";
    echo "</div>";

}
?>

<body>

<section class="home">
    edjozefze
    <h1>Voici du contenu</h1>
<div class="modal-container">
    edjozefze
    <h1>Voici du contenu</h1>
    <div class="overlay modal-trigger">edjozefze
        <h1>Voici du contenu</h1></div>

    <div class="modal">
        <button class="close-modal modal-trigger">X</button>
        <h1>Voici du contenu</h1>
        <p>lorem ipsum</p>
    </div>
</div>
</section>

<?php
require 'footer.php';
?>

