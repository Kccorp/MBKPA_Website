<?php
include 'header.php';
?>

<div class="container">
    <div class="row">
        <h1>Profile</h1>
    </div>
    <div class="row justify-content-center text-center ">
    <div class="col-3 bg-success">

            <img class="mt-5" style="
                width: 7vw;
                border-radius: 20rem;
                border-style: solid;
                border-color: black;
                border-width: 3px;"
                src="Assets/Pictures/male-user.png"/>

            <h3 class="mt-3">Bonjour <b><?php echo $_SESSION['info']['lastName'] ?></b></h3>

            <small class="mt-3"><?php echo $_SESSION['info']['email'];?>, ce n'est pas vous?<a href="logout.php">changez de compte</a></small>
        </div>

    </div>

    <div class="col-12 bg-danger" >
        Test
    </div>

</div>







<?php
include 'footer.php';
?>
