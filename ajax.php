<?php
require "fonctions.php";
session_start();

$connection = connectDB();

if (isset($_GET['GetArticle'])) {



    $queryPrepared = $connection->prepare("SELECT name, price, description FROM ".PRE."merchandise");
    $queryPrepared->execute([]);
    $results = $queryPrepared->fetchALL(PDO::FETCH_ASSOC);
    echo "<tr>";
    foreach ($results as $article => $infoArticle ) {
        foreach ($infoArticle as $cle => $info) {
            if ($cle == "name") {
                echo "<th>".$info."</th>";
            } elseif ($cle == "price") {
                echo "<td>".$info."</td>";
            } elseif ($cle == "description") {
                if(empty($info)){
                    echo "<td> N/A </td>";
                } else{
                    echo "<td>".$info."</td>";
                }
            }

        }
        foreach ($infoArticle as $cle => $info) {

                echo '<div class="dropdown">';

                echo '<td><button  type="button" id="dropdownMenuButton">';
                echo 'pay me';
                echo '</button>';


                echo '</div></td>';

            }
        }
        echo "</tr>";
    }
