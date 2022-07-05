<?php
require __DIR__ . "/header.php";
require __DIR__ . "/banner.php";

<div class="container ">
    <div class="row">

        <?php

        $connection = connectDB();
        $queryPrepare = $connection->prepare("SELECT * FROM ".PRE."merchandise");
        $queryPrepare->execute();
        $merchandises = $queryPrepare->fetchAll(PDO::FETCH_ASSOC);


        foreach ($merchandises as $row => $infoMerch){

            ?>
            <div class="card mt-5 me-4" style="width: 18rem;">
                <?php if(!empty($infoMerch["urlImage"]) && file_exists($infoMerch["urlImage"])){
                    echo '<img src="'.$infoMerch["urlImage"].'" class="card-img-top" alt="...">';
                } else {
                    echo '<img src="Assets/Shop/noImage.png" class="card-img-top" alt="...">';
                }
                ?>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mt-auto"><?php echo $infoMerch["name"] ?></h5>
                    <p class="card-text "><?php echo $infoMerch["fullname"] ?></p>
                    <p class="card-text "><?php echo $infoMerch["price"] ?> €</p>

                    <form action='create-checkout-session.php' method='post'>
                        <?php echo "<input type='hidden' name='id' value='".$infoMerch["idStripe"]."'>";?>

                        <button type='submit'>Acheter</button></form>



                    <a href="item.php?idMerchandise=<?php echo $infoMerch["idMerchandise"] ?>" class="btn btn-primary ">Voir l'article</a>
                </div>
            </div>
    <?php } ?>


</div>


<?php
include 'footer.php';
?>