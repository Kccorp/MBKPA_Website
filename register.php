<?php
session_start();
require "vendor/autoload.php";
$stripe = new \Stripe\StripeClient(
    'sk_test_51KwpzKJW6etdvbpFazWo3CLbeSnn5VKOjpVFMTAeSHxfYlshGFvli0dFvdbdD5L1H0n6y8uzmlOXBlkvdfeUxRZW00z8fWVUDk'
);
require "fonctions.php";


if ( count($_POST) == 6
    && !empty($_POST["nom"])
    && !empty($_POST["email"])
    && !empty($_POST["pwd"])
    && !empty($_POST["prenom"])
    && !empty($_POST["checkPwd"])
    && !empty($_POST["g-recaptcha-response"])
) {

    $listOfErrors = [];

    if (checkForCaptcha() == true){

        $nom = trim($_POST["nom"]);
        $prenom = trim($_POST["prenom"]);
        $email = mb_strtolower(trim($_POST["email"]));
        $pwd = $_POST["pwd"];
        $checkPwd = $_POST["checkPwd"];


        if( strlen($nom)<3 || strlen($nom)>150 ) {
            $listOfErrors[] = "Votre nom doit faire minimum 3 caractéres et maximum 150 caractéres";
        }

        if( strlen($prenom)<3 || strlen($prenom)>150 ) {
            $listOfErrors[] = "Votre prenom doit faire minimum 3 caractéres et maximum 150 caractéres";
        }

        if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $listOfErrors[] =  "Adresse mail invalide";

        }else{

            //Vérifier l'unicté de l'adresse email
            $connection = connectDB();

            $queryPrepared = $connection->prepare("SELECT email FROM ".PRE."user WHERE email=:email");

            $queryPrepared->execute(["email"=>$email]);

            if( $queryPrepared->rowCount() != 0 ){
                $listOfErrors[] =  "Votre email existe déjà";
            }
        }


        if( strlen($pwd)<=5
            || !preg_match("#[a-z]#", $pwd)
            || !preg_match("#[A-Z]#", $pwd)
            || !preg_match("#[0-9]#", $pwd)
        ) {
            $listOfErrors[] =  "Votre mot de passe doit faire min 5 caractères dont 1 minuscule, 1 majuscule et 1 chiffre";
        }


        if( $pwd != $checkPwd){
            $listOfErrors[] =  "Mot de passe de confirmation incorrect";
        }

        //insertion en BDD
        if( empty($listOfErrors) ){

            //creation client stripe
            $customer= $stripe->customers->create([
                'email' => $_POST['email'],
                'name'  => $_POST['nom'] . " " . $_POST['prenom']
            ]);

            $idStripe = $customer->id;


            $queryPrepared =  $connection->prepare("INSERT INTO ".PRE."user (name, lastName, password, email) VALUES ( :name, :lastName , :pwd, :email);");
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);

            $queryPrepared->execute(["name"=>$nom, "lastName"=>$prenom, "pwd"=>$pwd, "email"=>$email]);

            $queryPrepared = $connection->prepare("SELECT * FROM ".PRE."User WHERE email=:email");
            $queryPrepared->execute(["email"=>$email]);
            $results = $queryPrepared->fetch();

            $_SESSION["info"]=$results;
            $_SESSION["auth"]=true;


            $subject = "Confirmation de votre inscription";

            $content = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html>
             <head>
                <title>Welcome !</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
             </head>
             <body>
                <p>
                    Bonjour '.$_SESSION["info"]["lastName"].'
                </p>
                <p>
                    Nous vous remercions de votre inscription sur notre site.
                </p>
                <p>
                    Email : '.$_SESSION["info"]["email"].'
                    <br>
                    Mot de passe : xxxxxx
                    <br>
                    <a href="/index.php">
                        Se connecter
                    </a>
                </p>
                
             </body>
            </html>';

            if ( sendMail($email, $content, $subject) == true ){
                header("Location: index.php");
            }else{
                echo "<script>alert('Erreur lors de l envoi du mail')</script>";
                $_SESSION["listOfErrors"] = $listOfErrors;
            }


        } else {
            //Afficher les erreurs sur la page form.php
            $_SESSION["listOfErrors"] = $listOfErrors;
            header("Location: newUser.php");
        }

    } else {

        //Afficher les erreurs sur la page form.php
        $listOfErrors[] =  "Bip Bip Bop, vous êtes un robot";
        $_SESSION["listOfErrors"] = $listOfErrors;
        header("Location: newUser.php");

    }

} else {
    header("Location: index.php");
}
