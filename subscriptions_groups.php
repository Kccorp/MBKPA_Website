<?php
require 'header.php';
?>

<div style="background-image: url('Assets/Pictures/formules.jpg'); background-size: cover;     background-position: center center;height: auto;min-height: 20em;">
    <div class="container text-center py-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center text-shadow text-white  mt-5" style="text-shadow: 0 0 10px #868686, 0 0 10px #b9b9b9, 0 0 8px #000;">NOS FORMULES</h1>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 text-white text-center fw-bolder" style="text-shadow: 0 0 10px #868686, 0 0 10px #b9b9b9, 0 0 8px #000;">
                À chacun sa formule !<br>
                Pour vous déplacer selon vos besoins et vos envies en toute liberté découvrez toutes nos formules: usager fidèle ou occasionnel, trouvez celles qui vous convient !
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <?php
        $connect = connectDb();
        $queryPrepare = $connect->prepare("SELECT name, price, description FROM ".PRE."package where status != 'hs'");
        $queryPrepare->execute();
        $result = $queryPrepare->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            ?>

            <div class="col-md-4 mt-3" style="cursor: pointer;" onclick="window.location='subscription.php?name=<?php echo $row['name'];?>';">
                <div class="card clickable text-center py-2">
                    <h3 class="card-title"><?php echo "Lotte <br>". strtoupper($row['name']); ?></h3>
                    <p class="card-text" style="text-overflow: ellipsis; "><?php echo $row['description']; ?></p>
                    <p class="card-text">Prix: <?php echo $row['price']; ?>€</p>
                </div>
            </div>
    <?php } ?>

    </div>
</div>


<?php
require 'footer.php';
?>

