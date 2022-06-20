<?php
require "conf.inc.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


//fonction connexion BDD
function connectDB()
{

    try{

        $connection = new PDO(DBDRIVER.":host=".DBHOST.";port =".DBPORT.";dbname=".DBNAME , DBUSER, DBPWD, );
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    }catch(Exception $e){
        die("Erreur SQL : ". $e->getMessage());
    }


    return $connection;

}

function checkForCaptcha(){
    $response = htmlspecialchars($_POST['g-recaptcha-response']);
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $request = "https://www.google.com/recaptcha/api/siteverify?secret=".SECRETE_API_CAPTCHA."&response=$response&remoteip=$remoteip";

    $get = file_get_contents($request);
    $decode = json_decode($get, true);

    if ($decode['success'])
        return true;
    else
        return false;
}

function sendRegisterMail($email){
    $subject = "Confirmation de votre inscription";

    $content = '<html>
		 <head>
			<title>Welcome !</title>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
		 </head>
		 <body>
			<p>
				Bonjour '.$_SESSION["info"]["name"].'
			</p>
			<p>
				Nous vous remercions de votre inscription sur notre site.
			</p>
			<p>
			    Email : '.$_SESSION["info"]["email"].'
			    <br>
                Mot de passe : xxxxxx
                <br>
                <a src="http://localhost:63342/Lotte_PA/index.php">
                    <button class="btn btn-primary">Se connecter</button>
                </a>
            </p>
            
		 </body>
		</html>';

    return sendMail($email, $content, $subject);
}

function sendMail($email, $content, $subject){

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = EMAILHOST;                 				    //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = EMAILUSER;                   						  //SMTP username
        $mail->Password   = EMAILPWD;                              //SMTP password
        $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = EMAILPORT;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('no-reply@lotte.fr', 'no-reply');
        $mail->addAddress($email);     //Add a recipient



        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('Images\logo.svg', 'logo.svg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }

}

function addFidelPoint ($amount){
    echo "herecome the amountttt".$amount;
    $fidelPoint = 0;
    $fidelPoint = $amount*0.3;
    echo "herecome the fidel".$fidelPoint;
    $fidelPoint+=floor($amount/100);
    echo "herecome the fidel".$fidelPoint;

    $fidelPoint=floatval($fidelPoint);
    echo "AND NOW".$fidelPoint%1;
    if($fidelPoint%1<0.5)
        $fidelPoint = floor($fidelPoint);
    else
        $fidelPoint = ceil($fidelPoint);
    $connection = connectDB();
    $id=$_SESSION["info"]["idUser"];
    $queryPrepared =  $connection->prepare("UPDATE ".PRE."user SET fidelityPoints = fidelityPoints+ :amount where idUser=:id_user");
    $queryPrepared->execute(["id_user"=>$id, "amount"=>$fidelPoint]);
}

class BackController{
    public static function upload($message){
        if (!empty($_FILES['fichier']['name'])) {
            $tabExt = array('jpg', 'png', 'jpeg');
            // Recuperation de l'extension du fichier
            $extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);

            // On verifie l'extension du fichier
            if (in_array(strtolower($extension), $tabExt)) {

                // On recupere les dimensions du fichier
                $infosImg = getimagesize($_FILES['fichier']['tmp_name']);
                // On verifie le type de l'image
                if ($infosImg[2] >= 1 && $infosImg[2] <= 14) {
                    // On verifie les dimensions et taille de l'image
                    if ((filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE)) {
                        // Parcours du tableau d'erreurs
                        if (isset($_FILES['fichier']['error']) && UPLOAD_ERR_OK === $_FILES['fichier']['error']) {
                            // On renomme le fichier
                            $nomImage = md5(uniqid()) . '.' . $extension;
                            // Si c'est OK, on teste l'upload
                            if (move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET . $nomImage)) {

                                return [TARGET . $nomImage, 0];


                            } else {
                                // Sinon on affiche une erreur systeme
                                return $message = 'Problème lors de l\'upload de l\'image !';
                            }
                        } else {
                            $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                        }
                    } else {
                        // Sinon erreur sur les dimensions et taille de l'image
                        $message = 'Le fichier est trop gros ! max : 10Mo';
                    }
                } else {
                    // Sinon erreur sur le type de l'image
                    $message = 'Format autorisé : jpg, png, jpeg';
                }
            } else {
                // Sinon on affiche une erreur pour l'extension
                $message = 'L\'extension du fichier est incorrecte !';
            }
        } else {
            return [" ", 0];
        }
        return [0, $message];
    }

}