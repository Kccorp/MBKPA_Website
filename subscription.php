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

<?php
$connect = connectDb();
$queryPrepare = $connect->prepare("SELECT name, price, description, pricePerMin FROM ".PRE."package where name='$_GET[name]'");
$queryPrepare->execute();
$result = $queryPrepare->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row ){

?>
<div class ="container mt-5">
    <div class="row">
        <div class="col-8 me-3 card p-3" >
            <h3>Lotte <?php echo $row['name']?></h3>
            <p><?php echo $row['description']?></p>
        </div>
        <div class="col-3 card p-3 text-center">
            <h3><?php echo $row['price']?>€</h3>
            <?php if (!is_null($row['pricePerMin']))
              echo  "<p>(+   ".$row['pricePerMin']."€/min)</p>";
            ?>
            <button class="btn btn-primary shadow-sm"> Choisir cette formule </button>
        </div>
    </div>
</div>
<?php
    }
?>
