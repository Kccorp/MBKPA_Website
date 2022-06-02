<?php
$object="chaussette";
$price="15 euros";
$quantity="2";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Buy cool new product</title>
  <link rel="stylesheet" href="check.css">
  <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
  <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<section>
  <div class="product">
    <img src="https://i.imgur.com/EHyR2nP.png" alt="The cover of Stubborn Attachments" />
    <div class="description">
      <h3>Commande: <?php echo $object?></h3>
      <h5>prix: <?php echo $price?></h5>
        <h5>quantité: <?php echo $quantity?></h5>
    </div>
  </div>
  <form action="/MBKPA_Website/create-checkout-session.php" method="POST">
    <button type="submit" id="checkout-button">aller au paiement</button>
  </form>
</section>
</body>
</html>