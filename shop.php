<?php
include 'header.php';
?>

<h1 class="text-uppercase"> la boutique</h1>

<div class="container ">

        <?php

        $connection = connectDB();
        $queryPrepare = $connection->prepare("SELECT * FROM ".PRE."merchandise");
        $queryPrepare->execute();
        $merchandises = $queryPrepare->fetchAll(PDO::FETCH_ASSOC);


        foreach ($merchandises as $row => $infoMerch){

                if ($row % 4 == 0){
                    echo ' <div class="row">';
                }
            ?>
            <div class="card mt-5 me-4" style="width: 18rem;">
                <img src="Assets/Shop/<?php echo $infoMerch["urlImage"] ?>" class="card-img-top" alt="...">
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