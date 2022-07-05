<?php

include 'header.php';
if (!isset($_SESSION["checkout_session"])){
    header("Location: cancel.php");
    die();
}
require 'vendor/autoload.php';
$stripe = new \Stripe\StripeClient(
    'sk_test_51KwpzKJW6etdvbpFazWo3CLbeSnn5VKOjpVFMTAeSHxfYlshGFvli0dFvdbdD5L1H0n6y8uzmlOXBlkvdfeUxRZW00z8fWVUDk'
);
$idCheck = $_SESSION["checkout_session"];


$line_items = $stripe->checkout->sessions->allLineItems($idCheck, ['limit' => 5]);
$amount = $line_items['data'][0]['amount_total'];
$amount=number_format(($amount / 100), 2, ',', ' ');
$description= $line_items['data'][0]['description'];
$date= date('Y-m-d H:i:s');
$email= $_SESSION["info"]["email"];
$name = $_SESSION["info"]["name"];

if (isset($_SESSION["isPackage"])){
    echo $idUser = $_SESSION["info"]["idUser"];
     $idPackage = $_SESSION["idPackage"];
     $duration = $_SESSION["duration"];
     $datestart = date('Y-m-d');
     $dateend = date('Y-m-d', strtotime('+'.$duration.' days'));
    if (isset($_SESSION["numberOfRide"])) {
        $NumberOfRide = $_SESSION["numberOfRide"];
        $connection = connectDB();
        $queryPrepared = $connection->prepare("INSERT INTO ".PRE."packageValidity (idUser, idPackage, RidesLeft, subscriptionStart, subscriptionEnd) VALUES (?, ?, ?, ?, ?)");
        $queryPrepared->execute([$idUser, $idPackage,  $NumberOfRide, $datestart, $dateend]);
    }else {

        $connection = connectDB();
        $queryPrepared = $connection->prepare("INSERT INTO " . PRE . "packageValidity (idUser, idPackage, subscriptionStart, subscriptionEnd) VALUES (?, ?, ?, ?)");
        $queryPrepared->execute([$idUser, $idPackage, $datestart, $dateend]);
    }
    }

addFidelPoint($amount);

unset($_SESSION['checkout_session']);
unset($_SESSION['isPackage']);
unset($_SESSION['idPackage']);
unset($_SESSION['numberOfRide']);
unset($_SESSION['duration']);



CreateHtmlInvoice($name,$date,$amount,$description,$email,$idCheck);



?>
<head>
    <title>Thanks for your order!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section>
    <p>
        We appreciate your business! If you have any questions, please email
        <a href="mailto:orders@example.com">orders@example.com</a>.
    </p>
</section>
</body>

<?php include 'footer.php'; ?>

