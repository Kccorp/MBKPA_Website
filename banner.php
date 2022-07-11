<?php
    if (isset($_SESSION["auth"]) && $_SESSION["auth"] == "true")
    {
    $isAdmin = $_SESSION["info"]["isAdmin"];
    if ($isAdmin == 1){
    echo '<nav class="sidebar close">';
        echo '<header>';
            echo '<div class="image-text">';
                echo '<span class="image">';
                        echo '<img src="assets/pictures/logo.png" alt="">';
                        echo '</span>';
                echo '<div class="text logo-text">';
                    echo '<span class="name">Lotte</span>';echo '<span class="profession">Dashboard</span>';
                    echo '</div>';
                echo '</div>';
            echo '<i class="bx bx-chevron-right toggle"></i>';
            echo '</header>';
        echo '';
        echo '<div class="menu-bar">';
            echo '<div class="menu">';
                echo '';
                echo '<li class="search-box">';
                    echo '<i class="bx bx-search icon"></i>';
                    echo '<input type="text" placeholder="Recherche...">';
                    echo '</li>';
                echo '';
                echo '<ul class="menu-links">';
                    echo '<li class="nav-link">';
                        echo '<a href="gestion_users.php">';
                            echo '<i class="bx bxs-group icon" ></i>';
                            echo '<span class="text nav-text">Utilisateurs</span>';
                            echo '</a>';
                        echo '</li>';
                    echo '';
                    echo '<li class="nav-link">';
                        echo '<a href="gestion_items.php">';
                            echo '<i class="fa fa-cogs icon" ></i>';
                            echo '<span class="text nav-text">Shop</span>';
                            echo '</a>';
                        echo '</li>';
                    echo '';
                    echo '<li class="nav-link">';
                        echo '<a href="gestion_formules.php">';
                            echo '<i class="fa fa-list-ul icon"></i>';
                            echo '<span class="text nav-text">Formules</span>';
                            echo '</a>';
                        echo '</li>';
                    echo '';
                    echo '<li class="nav-link">';
                        echo '<a href="tracking.php">';
                            echo '<i class="bx bxs-bar-chart-alt-2 icon"></i>';
                            echo '<span class="text nav-text">Analytics</span>';
                            echo '</a>';
                        echo '</li>';
                    echo '';
                    echo '</ul>';
                echo '</div>';
            echo '<div class="bottom-content">';
                echo '<li class="">';
                    echo '<a href="profil.php">';
                        echo '<i class="bx bx-user-circle icon"></i>';
                        echo '<span class="text nav-text">'. $_SESSION["info"]["name"] ." " . $_SESSION["info"]["lastName"] . '</span>';
                        echo '</a>';
                    echo '</li>';

                echo '<li class="">';
                    echo '<a href="index.php">';
                        echo '<i class="modal-btn modal-trigger bx bxs-wrench icon"></i>';
                        echo '<span class="text nav-text">Paramètres</span>';
                        echo '</a>';
                    echo '</li>';

                echo '<li class="">';
                    echo '<a href="logout.php">';
                        echo '<i class="bx bx-log-out icon" ></i>';
                        echo '<span class="text nav-text">Logout</span>';
                        echo '</a>';
                    echo '</li>';

                }
                else{
                echo '<nav class="sidebar close">';
                    echo '<header>';
                        echo '<div class="image-text">';
                            echo '<span class="image">';
                        echo '<img src="assets/pictures/logo.png" alt="">';
                        echo '</span>';
                            echo '<div class="text logo-text">';
                                echo '<span class="name">Lotte</span>';
                                echo '<span class="profession">La trotinnette</span>';
                                echo '</div>';
                            echo '</div>';
                        echo '<i class="bx bx-chevron-right toggle"></i>';
                        echo '</header>';
                    echo '';
                    echo '<div class="menu-bar">';
                        echo '<div class="menu">';
                            echo '';
                            echo '<li class="search-box">';
                                echo '<i class="bx bx-search icon"></i>';
                                echo '<input type="text" placeholder="Recherche...">';
                                echo '</li>';
                            echo '';
                            echo '<ul class="menu-links">';
                                echo '<li class="nav-link">';
                                    echo '<a href="../index.php">';
                                        echo '<i class="fa fa-home icon" ></i>';
                                        echo '<span class="text nav-text">Accueil</span>';
                                        echo '</a>';
                                    echo '</li>';
                                echo '';
                                echo '<li class="nav-link">';
                                    echo '<a href="localisation.php">';
                                        echo '<i class="fa fa-street-view icon" ></i>';
                                        echo '<span class="text nav-text">Trouves nous</span>';
                                        echo '</a>';
                                    echo '</li>';
                                echo '';
                                echo '<li class="nav-link">';
                                    echo '<a href="formules.php">';
                                        echo '<i class="bx bx-list-plus icon" ></i>';
                                        echo '<span class="text nav-text">Les formules</span>';
                                        echo '</a>';
                                    echo '</li>';
                                echo '';
                                echo '<li class="nav-link">';
                                    echo '<a href="shop.php">';
                                        echo '<i class="fa fa-cart-plus icon"></i>';
                                        echo '<span class="text nav-text">Shop</span>';
                                        echo '</a>';
                                    echo '</li>';
                                echo '';
                                echo '<li class="nav-link">';
                                    echo '<a href="faq.php">';
                                        echo '<i class="fa fa-question-circle icon"></i>';
                                        echo '<span class="text nav-text">F.A.Q</span>';
                                        echo '</a>';
                                    echo '</li>';
                                echo '';
                                echo '<li class="nav-link">';
                                    echo '<a href="rules.php">';
                                        echo '<i class="fa fa-thumbs-up icon"></i>';
                                        echo '<span class="text nav-text">Bonne conduite</span>';
                                        echo '</a>';
                                    echo '</li>';
                                echo '';
                                echo '</ul>';
                            echo '</div>';
                        echo '<div class="bottom-content">';

                            echo '<li class="">';
                                echo '<a href="profil.php">';
                                    echo '<i class="bx bx-user-circle icon"></i>';
                                    echo '<span class="text nav-text">'. $_SESSION["info"]["name"] ." " . $_SESSION["info"]["lastName"] . '</span>';
                                    echo '</a>';
                                echo '</li>';

                            echo '<li class="">';
                                echo '<a href="index.php">';
                                    echo '<i class="modal-btn modal-trigger bx bxs-wrench icon"></i>';
                                    echo '<span class="text nav-text">Paramètres</span>';
                                    echo '</a>';
                                echo '</li>';

                            echo '<li class="">';
                                echo '<a href="logout.php">';
                                    echo '<i class="bx bx-log-out icon" ></i>';
                                    echo '<span class="text nav-text">Logout</span>';
                                    echo '</a>';
                                echo '</li>';
                            }
                            }
                            else{
                            echo '<nav class="sidebar close">';
                                echo '<header>';
                                    echo '<div class="image-text">';
                                        echo '<span class="image">';
                    echo '<img src="assets/pictures/logo.png" alt="">';
                    echo '</span>';
                                        echo '<div class="text logo-text">';
                                            echo '<span class="name">Lotte</span>';
                                            echo '<span class="profession">La trottinette facile</span>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '<i class="bx bx-chevron-right toggle"></i>';
                                    echo '</header>';
                                echo '';
                                echo '<div class="menu-bar">';
                                    echo '<div class="menu">';
                                        echo '';
                                        echo '<li class="search-box">';
                                            echo '<i class="bx bx-search icon"></i>';
                                            echo '<input type="text" placeholder="Recherche...">';
                                            echo '</li>';
                                        echo '';
                                        echo '<ul class="menu-links">';
                                            echo '<li class="nav-link">';
                                                echo '<a href="index.php">';
                                                    echo '<i class="fa fa-home icon"></i>';
                                                    echo '<span class="text nav-text">Accueil</span>';
                                                    echo '</a>';
                                                echo '</li>';
                                            echo '';
                                            echo '<li class="nav-link">';
                                                echo '<a href="localisation.php">';
                                                    echo '<i class="fa fa-street-view icon"></i>';
                                                    echo '<span class="text nav-text">Trouves nous</span>';
                                                    echo '</a>';
                                                echo '</li>';
                                            echo '';
                                            echo '<li class="nav-link">';
                                                echo '<a href="formules.php">';
                                                    echo '<i class="fa fa-list-ul icon"></i>';
                                                    echo '<span class="text nav-text">Les formules</span>';
                                                    echo '</a>';
                                                echo '</li>';
                                            echo '';
                                            echo '<li class="nav-link">';
                                                echo '<a href="shop.php">';
                                                    echo '<i class="fa fa-cart-plus icon"></i>';
                                                    echo '<span class="text nav-text">Shop</span>';
                                                    echo '</a>';
                                                echo '</li>';
                                            echo '';
                                            echo '<li class="nav-link">';
                                                echo '<a href="faq.php">';
                                                    echo '<i class="fa fa-question-circle icon"></i>';
                                                    echo '<span class="text nav-text">F.A.Q</span>';
                                                    echo '</a>';
                                                echo '</li>';
                                            echo '';
                                            echo '<li class="nav-link">';
                                                echo '<a href="rules.php">';
                                                    echo '<i class="fa fa-thumbs-up icon"></i>';
                                                    echo '<span class="text nav-text">Bonne conduite</span>';
                                                    echo '</a>';
                                                echo '</li>';
                                            echo '';
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '<div class="bottom-content">';




                                        echo '<li class="">';
                                            echo '<a href="index.php">';
                                                echo '<i class="bx bxs-wrench icon modal-btn modal-trigger"></i>';
                                                echo '<span class="text nav-text">Paramètres</span>';
                                                echo '</a>';
                                            echo '</li>';

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

                        </nav>