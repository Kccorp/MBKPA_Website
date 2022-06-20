<?php
include 'header.php';
?>

<h1 class="text-uppercase"> la boutique</h1>

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
                    <a href="item.php?idMerchandise=<?php echo $infoMerch["idMerchandise"] ?>" class="btn btn-primary ">Voir l'article</a>
                </div>
            </div>
    <?php } ?>


</div>


<?php
include 'footer.php';
?>