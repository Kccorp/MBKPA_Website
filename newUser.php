<?php
include 'header.php';


if (!empty($_SESSION["listOfErrors"])) {
    echo "<div class='alert alert-danger'>";

    foreach ($_SESSION["listOfErrors"] as $error) {
        echo $error . "<br>";
    }

    echo "</div>";
    unset($_SESSION["listOfErrors"]);

} 
?>
<!-- create basic html form-->
<form method='POST' action="register.php" id="register-form">
    <p>Inscription</p>
<!--    <input type="hidden" id="recaptchaResponse" name="recaptcha-response">-->
    <input type='text' name='nom' placeholder='nom' />
    <input type='text' name='prenom' placeholder='prenom' />
    <input type='text' name='email' placeholder='email' />
    <br>
    <br>
    <input type='password' name='pwd' placeholder='password'/>
    <input type='password' name='checkPwd' placeholder='check pwd'/>
<!--    <input type='submit' value='submit' />-->
    <button type="submit"
            class="g-recaptcha"
            data-sitekey=<?php echo SITE_API_CAPTCHA; ?>
            data-callback='onSubmit'
            data-action='submit'>Valider</button>
</form>

<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("register-form").submit();
    }
</script>




