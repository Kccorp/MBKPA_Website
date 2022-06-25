<?php
include __DIR__ . "/banner.php";
include __DIR__ . "/header.php";

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