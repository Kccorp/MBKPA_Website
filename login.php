<?php
include "header.php";

if (count($_POST)==2 && !empty($_POST["email"]) && !empty($_POST["password"])) {
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
        //header("Location: captcha.php?login=1&pwd=1");
    }else{
        echo '<div class="alert alert-danger">Identifiants incorrects</div>';
    }
}

// create a login form
echo '<form action="login.php" method="post">';
echo '<p>Email: <input type="text" name="email" /></p>';
echo '<p>Password: <input type="password" name="password" /></p>';
echo '<button type="submit" class="btn btn-primary">Valider</button>';
echo '</form>';
?>