<?php
include 'header.php';
$object=$_POST["id"];
$quantity=$_POST["quantity"];
$idCustomer=$_SESSION["info"]["idStripe"];

require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51KwpzKJW6etdvbpFazWo3CLbeSnn5VKOjpVFMTAeSHxfYlshGFvli0dFvdbdD5L1H0n6y8uzmlOXBlkvdfeUxRZW00z8fWVUDk');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/PA2022/MBKPA_Website';

$checkout_session = \Stripe\Checkout\Session::create([
    'customer' => 'cus_LlORm4gq1T7uUU',
    'line_items' => [[
        # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        'price' => $object,
        'quantity' => $quantity,
    ]],

    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success.php',
    'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
]);

$_SESSION["checkout_session"]=$checkout_session->id;




header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);