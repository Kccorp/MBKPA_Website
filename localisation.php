<?php
require __DIR__ . "/header.php";
require __DIR__ . "/banner.php";


if (!empty($_SESSION["listOfErrors"])) {
    echo "<div class='alert alert-danger'>";

    foreach ($_SESSION["listOfErrors"] as $error) {
        echo $error . "<br>";
    }

    echo "</div>";
    unset($_SESSION["listOfErrors"]);

}
?>
    <section class="home">
        <h1>La route est simple</h1>
        <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1FgGd4K3RbTaH2kRkGRC2zpSPf2m77-Ao&ehbc=2E312F" width="1280 " height="720"></iframe>
    </section>



<?php
include 'footer.php';
?>