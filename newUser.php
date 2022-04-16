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
    <input type="hidden" id="recaptchaResponse" name="recaptcha-response">
    <input type='text' name='nom' placeholder='nom' />
    <input type='text' name='prenom' placeholder='prenom' />
    <input type='text' name='email' placeholder='email' />
    <br>
    <br>
    <input type='password' name='pwd' placeholder='password'/>
    <input type='password' name='checkPwd' placeholder='check pwd'/>
    <input type='submit' value='submit' />

    <script src="https://www.google.com/recaptcha/api.js?render=6Lf_dnsfAAAAAD49EG56pdgOjr35V43EWtB-6E3E"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lf_dnsfAAAAAD49EG56pdgOjr35V43EWtB-6E3E', {action: 'homepage'}).then(function(token) {
                document.getElementById('recaptchaResponse').value = token
            });
        });
    </script>
</form>



