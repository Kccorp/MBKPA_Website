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

<?php
include 'footer.php';
?>
