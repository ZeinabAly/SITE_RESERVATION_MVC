
<?php 
    $url = trim($_SERVER['REQUEST_URI'], '/');
    $activePage = $url !== '' ? $url : 'home';
?>

<nav id="navigation">

    <div class="tophead">
        <!-- RESEAU SOCIAUX ET CONTACT -->
        <div class="contacts">
            <div class="icones_sociaux">
                <i class="fa-brands fa-facebook-f icon"></i>
                <i class="fa-brands fa-x-twitter icon"></i>
                <i class="fa-brands fa-instagram icon"></i>
                <i class="fa-brands fa-linkedin-in icon"></i>
            </div>
    
            <div class="contact_links">
                <a href="tel:+"  class="ct_link">
                    <i class="fa-solid fa-phone ct_icon"></i>
                    <span> +33 0548382392</span>
                </a>
                <a href="mailto:" class="ct_link">
                    <i class="fa-regular fa-envelope ct_icon"></i>
                    <span>voyage@gmail.com</span>
                </a>
            </div>
        </div>

        <!-- LANGUE ET LOGIN -->
        <div class="langues-login">
            <div class="lang">
                <form action="">
                    <select name="" id="">
                        <option value="" selected>FR</option>
                        <option value="">ENG</option>
                    </select>
                </form>
            </div>
            <div class="login">
                <a href="/register" class="login_btn login">
                    <i class="fa-solid fa-right-to-bracket log_icon"></i> 
                    <span>S'inscrire</span>   
                </a>
                <a href="/login" class="login_btn signup">
                    <i class="fa-solid fa-user log_icon"></i> 
                    <span>Se connecter</span>
                </a>
            </div>
        </div>
    </div>

    <!-- LIENS DE NAVIGATION POUR PETITS ET GRANDS ECRANS -->
    <div class="logo_navs">
        <div class="logo">
            <img src="../../assets/images/logo.png" alt="logo du site" class="logo_img">
        </div>
        <div class="links-button">
            <!-- GRANDS ECRANS -->
            <ul class="grand_ecrans navlinks">
                <li class="<?= $activePage === 'home' ? 'activeLink' : 'link' ?>">
                    <a href="/home">
                        <i class="fa-solid fa-house"></i>
                        <span>Accueil</span>
                    </a>
                </li>
                <li class="<?= $activePage === 'sejour' ? 'activeLink' : 'link' ?>">
                    <a href="/home">
                        <i class="fa-solid fa-bed"></i>
                        <span>Sejour</span>
                    </a>
                </li>
                <li class="link">
                    <a href="index.php?page=about">
                        <i class="fa-solid fa-plane"></i>
                        <span>Vols</span>
                    </a>
                </li>
                <li class="link">
                    <a href="index.php?page=about">Hotels</a>
                </li>
                <li class="link">
                    <a href="index.php?page=about">
                        <i class="fa-solid fa-car"></i>
                        <span>Location de voiture</span>
                    </a>
                </li>
                <li class="link">
                    <a href="index.php?page=about">
                        <i class="fa-solid fa-tags"></i>
                        <span>Activités</span>
                    </a>
                </li>
                    
                <li class="link">
                    <a href="index.php?page=about">
                        <i class="fa-solid fa-address-book"></i>
                        <span>Contact</span>
                    </a>
                </li>
            </ul>                                                           
            <button class="primary_btn">Book now</button>
            <!-- GRANDS ECRANS -->

            <!-- POUR LES PETITS ECRANS -->
            <div class="menu_petits_ecrans">
                <div id="menu_toggle">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="navpecrans hidden">
                    <ul class="navlinks">
                        <li class="<?= $activePage === 'home' ? 'activeLink' : 'link' ?>">
                            <a href="/home">
                                <span>Accueil</span>
                            </a>
                        </li>
                        <li class="link"><a href="index.php?page=about">
                            <span>Sejour</span>
                        </a></li>
                        <li class="link">
                            <a href="index.php?page=about">
                                <span>Vols</span>
                            </a>
                        </li>
                        <li class="link">
                            <a href="index.php?page=about">Hotels</a>
                        </li>
                        <li class="link">
                            <a href="index.php?page=about">
                                <span>Location de voiture</span>
                            </a>
                        </li>
                        <li class="link">
                            <a href="index.php?page=about">
                                <span>Activités</span>
                            </a>
                        </li>
                            
                        <li class="link">
                            <a href="index.php?page=about">
                                <span>Contact</span>
                            </a>
                        </li>
                    </ul>  

                    <div class="contact_links">
                        <a href="tel:+"  class="ct_link">
                            <i class="fa-solid fa-phone ct_icon"></i>
                            <span> +33 0548382392</span>
                        </a>
                        <a href="mailto:" class="ct_link">
                            <i class="fa-regular fa-envelope ct_icon"></i>
                            <span>voyage@gmail.com</span>
                        </a>
                    </div>

                    <div class="login mt-4 gap-3 flex justify-center items-center">
                        <a href="/register" class="primary_btn login">
                            <i class="fa-solid fa-right-to-bracket log_icon"></i> 
                            <span>S'inscrire</span>   
                        </a>
                        <a href="/login" class="primary_btn signup">
                            <i class="fa-solid fa-user log_icon"></i> 
                            <span>Se connecter</span>
                        </a>
                    </div>

                    <!-- FIN NAVIGATION PETITS ECRANS -->
                </div>
            </div>
        </div>
    </div>
    
    

</nav>