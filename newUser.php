<?php
include 'header.php';


if (!empty($_SESSION["listOfErrors"])) {
    echo "<div class='alert alert-danger'>";

    foreach ($_SESSION["listOfErrors"] as $error) {
        echo $error . "<br>";
    }

    echo "</div>";
    unset($_SESSION["listOfErrors"]);

} else {
    echo "Pas encore de message";
}
?>
<!-- create basic html form-->
<form method='POST' action="register.php">
    <p>Inscription</p>
    <input type='text' name='nom' placeholder='nom' />
    <input type='text' name='prenom' placeholder='prenom' />
    <input type='text' name='email' placeholder='email' />
    <br>
    <br>
    <input type='password' name='pwd' placeholder='password'/>
    <input type='password' name='checkPwd' placeholder='check pwd'/>
    <input type='submit' value='submit' />
</form>
