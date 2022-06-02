<?php

include 'header.php';
require 'vendor/autoload.php';
$stripe = new \Stripe\StripeClient(
    'sk_test_51KwpzKJW6etdvbpFazWo3CLbeSnn5VKOjpVFMTAeSHxfYlshGFvli0dFvdbdD5L1H0n6y8uzmlOXBlkvdfeUxRZW00z8fWVUDk'
);
$idCheck = $_SESSION["checkout_session"];


$line_items = $stripe->checkout->sessions->allLineItems($idCheck, ['limit' => 5]);
$amount = $line_items['data'][0]['amount_total'];
echo $amount=number_format(($amount / 100), 2, ',', ' ');
echo "<br>";
echo $line_items['data'][0]['description'];
echo $line_items['data'][0]['quantity'];
echo date('Y-m-d H:i:s');
echo $_SESSION["info"]["email"];
echo $_SESSION["info"]["name"];

addFidelPoint($amount);

unset($_SESSION['checkout_session']);

include 'footer.php';

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


