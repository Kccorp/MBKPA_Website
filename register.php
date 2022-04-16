<?php
session_start();

require "fonctions.php";


// On vérifie que la méthode POST est utilisée
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On vérifie si le champ "recaptcha-response" contient une valeur
    if(empty($_POST['recaptcha-response'])){
        header('Location: index.php');
    }else{
        // On prépare l'URL
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=6Lf_dnsfAAAAAPWcDhSQV1gZa70lRbBHCZozRK4N={$_POST['recaptcha-response']}";

        // On vérifie si curl est installé
        if(function_exists('curl_version')){
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
        }else{
            // On utilisera file_get_contents
            $response = file_get_contents($url);
        }

        // On vérifie qu'on a une réponse
        if(empty($response) || is_null($response)){
            header('Location: index.php');
        }else{
            $data = json_decode($response);
            if($data->success){
                if ( count($_POST) == 5
                    && !empty($_POST["nom"])
                    && !empty($_POST["email"])
                    && !empty($_POST["pwd"])
                    && !empty($_POST["prenom"])
                    && !empty($_POST["checkPwd"])
                ) {

                    $nom = trim($_POST["nom"]);
                    $prenom = trim($_POST["prenom"]);
                    $email = mb_strtolower(trim($_POST["email"]));
                    $pwd = $_POST["pwd"];
                    $checkPwd = $_POST["checkPwd"];


                    $listOfErrors = [];


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

                        $queryPrepared =  $connection->prepare("INSERT INTO ".PRE."user (name, lastName, password, email) VALUES ( :name, :lastName , :pwd, :email);");
                        $pwd = password_hash($pwd, PASSWORD_DEFAULT);

                        $queryPrepared->execute(["name"=>$nom, "lastName"=>$prenom, "pwd"=>$pwd, "email"=>$email]);

                        $queryPrepared = $connection->prepare("SELECT * FROM ".PRE."User WHERE email=:email");
                        $queryPrepared->execute(["email"=>$email]);
                        $results = $queryPrepared->fetch();

                        $_SESSION["info"]=$results;
                        $_SESSION["auth"]=true;


                        header("Location: index.php");
                    } else {
                        //Afficher les erreurs sur la page form.php
                        $_SESSION["listOfErrors"] = $listOfErrors;
                        header("Location: newUser.php");
                    }
                } else {
                    header("Location: index.php");
                }
            }
        }
    }
}