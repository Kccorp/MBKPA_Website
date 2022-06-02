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
    $connection = connectDB();
    $id=$_SESSION["info"]["idUser"];
    $queryPrepared =  $connection->prepare("UPDATE ".PRE."user SET fidelityPoints = fidelityPoints+".($amount/10)." where idUser=:id_user");
    $queryPrepared->execute(["id_user"=>$id]);
}