<?php
include 'header.php';
require 'vendor/autoload.php';
echo $_POST["points"];
$codeAmount=$_POST["points"]*0.2;
echo $codeAmount;
$stripe = new \Stripe\StripeClient(
    'sk_test_51KwpzKJW6etdvbpFazWo3CLbeSnn5VKOjpVFMTAeSHxfYlshGFvli0dFvdbdD5L1H0n6y8uzmlOXBlkvdfeUxRZW00z8fWVUDk'
);
$stripe->coupons->all(['limit' => 3]);

//print response of stripe
echo "<pre>";
print_r($stripe->coupons->all(['limit' => 3]));

//print all the amount
$coupons = $stripe->coupons->all(['limit' => 3]);
foreach ($coupons['data'] as $coupon) {
    echo $coupon['amount_off'] . "\n";
}



