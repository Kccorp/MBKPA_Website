<?php
require "conf.inc.php";


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

//Fonction d'envoie d'image
function sendMail($email, $content){

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
        $mail->Subject = 'Ton code de validation PLAY.fr';
        $mail->Body    = $content;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}