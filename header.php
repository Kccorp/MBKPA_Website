<?php
session_start();
require 'fonctions.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="Assets/Pictures/logo.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/login_register.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yfile6GSYGSHk7tPXikynS7ogEvDej/m4="  </script> -->

    <title>Lotte</title>
</head>

<body>
<nav class="sidebar close">
    <header>
        <div class="image-text">
                <span class="image">
                    <img src="assets/pictures/logo.png" alt="">
                </span>
            <div class="text logo-text">
                <span class="name">Lotte</span>
                <span class="profession">La trottinette facile</span>
            </div>
        </div>
        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">

            <li class="search-box">
                <i class='bx bx-search icon'></i>
                <input type="text" placeholder="Recherche...">
            </li>

            <ul class="menu-links">
                <li class="nav-link">
                    <a href="index.php">
                        <i class='fa fa-home icon' ></i>
                        <span class="text nav-text">Accueil</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='fa fa-street-view icon' ></i>
                        <span class="text nav-text">Trouves nous</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='fa fa-list-ul icon'></i>
                        <span class="text nav-text">Les formules</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='fa fa-cart-plus icon' ></i>
                        <span class="text nav-text">Shop</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='fa fa-question-circle icon' ></i>
                        <span class="text nav-text">F.A.Q</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='fa fa-thumbs-up icon' ></i>
                        <span class="text nav-text">Bonne conduite</span>
                    </a>
                </li>

            </ul>
        </div>
        <div class="bottom-content">
        <?php
            if (isset($_SESSION["auth"]) && $_SESSION["auth"])
                {

                        echo '<li class="">';
                            echo '<a href="logout.php">';
                                echo '<i class="bx bx-log-out icon" ></i>';
                                echo '<span class="text nav-text">Logout</span>';
                            echo '</a>';
                        echo '</li>';
                }else{
                    echo '<li class="">';
                        echo '<a href="login.php">';
                        echo '<i class="bx bx-log-in icon" ></i>';
                        echo '<span class="text nav-text">Connexion</span>';
                        echo '</a>';
                    echo '</li>';

                    echo '<li class="">';
                        echo '<a href="newUser.php">';
                        echo '<i class="bx bxs-user-circle icon" ></i>';
                        echo "<span class='text nav-text''>S'inscrire</span>";
                        echo '</a>';
                    echo '</li>';
                }
        ?>




            <li class="mode">
                <div class="sun-moon">
                    <i class='bx bx-moon icon moon'></i>
                    <i class='bx bx-sun icon sun'></i>
                </div>
                <span class="mode-text text">Dark mode</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>

        </div>
    </div>

</nav>

<section class="home">
    <div class="container">
        <div class="row ">
            <div class="col-md-12 mt-5">
<!--
<section class="home">
    <div class="text">Dashboard Sidebar</div>
</section>
-->

