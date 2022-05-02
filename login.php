<?php
include "header.php";

if (count($_POST)==3
    && !empty($_POST["email"])
    && !empty($_POST["password"])
    && !empty($_POST["g-recaptcha-response"])) {

    if (checkForCaptcha() == true){
        $login = $_POST["email"];
        $pwd = $_POST["password"];

        $connection = connectDB();
        $queryPrepared = $connection->prepare("SELECT * FROM ".PRE."User WHERE email=:login");
        $queryPrepared->execute(["login"=>$login]);
        $results = $queryPrepared->fetch(PDO::FETCH_ASSOC);


        if(empty($results)){
            echo '<div class="alert alert-danger">Identifiants incorrects</div>';
        }elseif ($results["isBanned"] == 1) {
            echo '<div class="alert alert-danger">Vous êtes BAN (sorry or not sorry)</div>';
        }else if( password_verify($pwd, $results["password"])){

            $_SESSION["auth"]=true;
            $_SESSION["info"]=$results;
            echo '<div class="alert alert-success">Connexion réussie</div>';

            header("Location:index.php");

        }else{
            echo '<div class="alert alert-danger">Identifiants incorrects</div>';
        }
    }
}
?>



    <div class="wrapper">
        <div class="headline">
            <h1>Bienvenue. <br>Montez dans le vaisseau direction le futur </h1>
        </div>

        <form  action="login.php" class="form" method="post" id="register-form">

            <div class="signin">
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email"/></p>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Mot de passe"/></p>
                </div>

                <button type="submit"
                        class="g-recaptcha btn btn-primary"
                        data-sitekey=<?php echo SITE_API_CAPTCHA; ?>
                        data-callback='onSubmit'
                        data-action='submit'>Valider</button>
                <div class="forget-password">
                    <a href="#">Un trou de mémoire ? </a>
                </div>
                <div class="account-exist">

                    Vous n'avez pas encore rejoint la team ? <a href="newUser.php" id="signup">Bah rejoins là</a>
                </div>
            </div>
        </form>
    </div>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    function onSubmit(token) {
        document.getElementById("register-form").submit();
    }
</script>

<?php
include "footer.php";
?>