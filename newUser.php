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






<div class="wrapper">
    <div class="headline">
        <h1>Bienvenue. <br> </h1>
    </div>
    <form method='POST' action="register.php" id="register-form">

        <div class="signup">

            <div class="form-group">
                <input type='text' class="form-control" name='nom' placeholder='Nom' />
            </div>
            <div class="form-group">
                <input type='text' class="form-control" name='prenom' placeholder='Prénom' />
            </div>
            <div class="form-group">
                <input type='text' class="form-control" name='email' placeholder='Email' />
            </div>
            <div class="form-group">
                <input type='password' class="form-control" name='pwd' placeholder='Saissisez votre mot de passe'/>
            </div>
            <div class="form-group">
                <input type='password' class="form-control" name='checkPwd' placeholder='Confirmez le mot de passe'/>
            </div>

            <button type="submit"
                    class="g-recaptcha btn btn-primary"
                    data-sitekey=<?php echo SITE_API_CAPTCHA; ?>
                    data-callback='onSubmit'
                    data-action='submit'>Valider</button>

            <div class="account-exist">
                Tu es déjà dans la team ? <a href="login.php" id="login"><br>Bah connectes toi !</a>
            </div>
        </div>
    </form>
</div>




<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("register-form").submit();
    }
</script>
<?php
include 'footer.php';
?>




