<?php
include 'header.php';

if (!empty($_GET["idMerchandise"]) && is_numeric($_GET["idMerchandise"])) {
    $connection = connectDB();
    $queryPrepare = $connection->prepare("SELECT * FROM ".PRE."merchandise WHERE idMerchandise = :idMerchandise");
    $queryPrepare->execute(["idMerchandise" => $_GET["idMerchandise"]]);
    $item = $queryPrepare->fetch(PDO::FETCH_ASSOC);

} else {
    header("Location: shop.php");
}
?>

<p><span class="h1 text-uppercase">la boutique</span> | La simplicité pour une vie facilité</p>

<div class="container my-5 pt-5">
    <div class="row mt-5">

        <div class="col-5 ">
            <img src="Assets/Shop/<?php echo $item["urlImage"] ?>" class="card-img-top" alt="...">
        </div>

        <div class="offset-1 col-6">
            <h2 class="text-uppercase"><?php echo $item["name"] ?></h2>
            <p><?php echo $item["fullname"] ?></p>
            <p><?php echo $item["price"] ?> €</p>
            <p class="my-5"><?php echo $item["description"] ?></p>

            <a href="shop.php" class="btn btn-primary">Acheter</a>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>