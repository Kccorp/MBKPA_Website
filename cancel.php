<?php
include 'header.php';
require 'vendor/autoload.php';
$stripe = new \Stripe\StripeClient(
    'sk_test_51KwpzKJW6etdvbpFazWo3CLbeSnn5VKOjpVFMTAeSHxfYlshGFvli0dFvdbdD5L1H0n6y8uzmlOXBlkvdfeUxRZW00z8fWVUDk'
);



unset($_SESSION['checkout_session']);
?>

<html>
<p>Your order has been cancelled.</p>
<p>You can <a href="shop.php">return to the shop</a> or <a href="index.php">go to the home page</a>.</p>
</html>


<?php
include 'footer.php';
?>