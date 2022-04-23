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
                    <input type='text' class="form-control" name='nom' placeholder='Nom' />
                    <input type='text' class="form-control" name='prenom' placeholder='Prénom' />
                    <input type='text' class="form-control" name='email' placeholder='Email' />
                    <br>
                    <br>
                    <input type='password' class="form-control" name='pwd' placeholder='Saissisez votre mot de passe'/>
                    <input type='password' class="form-control" name='checkPwd' placeholder='Confirmez le mot de passe'/>
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
<?php
include 'footer.php';
?>




