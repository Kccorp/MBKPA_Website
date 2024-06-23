<?php
include 'header.php';
include 'banner.php';

?>
<section class="home">

<?php
require 'vendor/autoload.php';
$_POST["points"];
$codeAmount=$_POST["points"]*0.2;
$codeAmount=$codeAmount*100;
echo $codeAmount;
$stripe = new \Stripe\StripeClient(
    'sk_test_51KwpzKJW6etdvbpFazWo3CLbeSnn5VKOjpVFMTAeSHxfYlshGFvli0dFvdbdD5L1H0n6y8uzmlOXBlkvdfeUxRZW00z8fWVUDk'
);
$stripe->coupons->all(['limit' => 3]);

$coupons = $stripe->coupons->all(['limit' => 100]);

foreach ($coupons['data'] as $coupon) {

    if ($coupon['amount_off'] == $codeAmount) {
        createConvertPromoCode($_SESSION["info"]["idStripe"], $coupon['id'], $_SESSION["info"]["email"]);
    }

}

$createcoup=$stripe->coupons->create([
    'amount_off' => $codeAmount,
    'currency' => 'eur',
    'name' => ' conversion Coupon de ' . number_format($codeAmount/100,2) . '€',
]);
createConvertPromoCode($_SESSION["info"]["idStripe"], $createcoup['id'], $_SESSION["info"]["email"]);


?>

</section>


<?php
include "footer.php";
?>