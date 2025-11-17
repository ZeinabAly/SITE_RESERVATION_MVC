<div id="home_page">
    <header class="header_section">
        <div class="header_section_content">
            <div class="navigation">
                <?php include_once "views/partials/_navigation.php"; ?>
            </div>
    
            <div class="banniere">
                <img src="./assets/images/image2.png" alt="image de banniere" class="banniere_img">
                <div class="banniere_content">
                    <h1 class="banniere_title">Explorez le monde avec <span class="text-[var(--primary)]">nous</span></h1>
                    <p class="banniere_text">Recherchez dès maintant votre nouvelle destination</p>
                    <!-- <a href="index.php?page=about" class="banniere_btn">En savoir plus</a> -->
                </div>
            </div>
        </div>

        <!-- ZONE DE RECHERCHE -->
        <div class="search_section">
            <div class="search_section_content">
                <form action="" class="search_form" id="home_search_form">
                    <!-- ELEMENT DYNAMIQUE EN FONCTION DU TYPE CHOISI -->
                    <div class="form_content">
                        <div class="input_group">
                            <input type="text" id="destination" name="destination" class="input_field" placeholder="Où voulez-vous aller ?">
                        </div>
                        <div class="input_group">
                            <input type="date" id="checkin" name="checkin" class="input_field">
                        </div>
                        <div class="input_group">
                            <input type="date" id="checkout" name="checkout" class="input_field" placeholder="Date de départ">
                        </div>
                        <div class="input_group">
                            <input type="number" id="guests" name="guests" class="input_field" min="1" placeholder="Nombre de voyageurs">
                        </div>
                    </div>
                    <button type="submit" class="search_btn primary_btn">Rechercher</button>
                </form>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <div class="main_content">
        <!-- SECTION1 -->
        <section class="section1">
            <div class="partie_text">
                <p class="sous_titre">Laissez vous guider</p>
                <h2 class="section_titre">Découvrez le <span>monde</span> avec notre guide </h2>
                <p class="texte">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit amet consectetur adipisicing elit amet consectetur adipisicing elit. Inventore voluptatem nisi ut tempora! Ullam velit inventore incidunt earum alias in quod modi! Fugit minus nostrum distinctio quibusdam, porro explicabo reprehenderit eaque facere, amet illum aut laboriosam fugiat mollitia iure odio? Autem accusamus rem asperiores molestias expedita sed molestiae doloremque aliquid.    
                </p>
            </div>
            <div class="partie_img">
                <img src="./assets/images/image3.png" alt="image de guide touristique" class="section1_img">
                <div class="bg-img"></div>
            </div>
        </section>
        <!-- SECTION2 -->
        <section class="section2">
            <div class="section2_content">
                <div class="">
                    <p class="sous_titre">Vacances inoubliables</p>
                    <h2 class="section_titre">Tours <span>populaire</span></h2>
                </div>
                    
                <div class="">
                    <div class="partie1">
                        <div class="img">
                            <img src="./assets/images/image1.png" alt="ville populaire1" class="partie1_img1">
                            <p class="nomSite">Maldives</p>
                        </div>
                        <div class="img">
                            <img src="./assets/images/image7.png" alt="ville populaire2" class="partie1_img2">
                            <p class="nomSite">Maldives</p>
                        </div>
                    </div>
                    <div class="partie2">
                        <div class="img">
                            <img src="./assets/images/image4.png" alt="ville populaire3">
                            <p class="nomSite">Maldives</p>
                        </div>
                        <div class="img">
                            <img src="./assets/images/image5.png" alt="ville populaire4">
                            <p class="nomSite">Maldives</p>
                        </div>
                        <div class="img">
                            <img src="./assets/images/image6.png" alt="ville populaire5">
                            <p class="nomSite">Maldives</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION3 -->
        <section class="section3">
            <div class="section3_content">
                <div class="">
                    <p class="sous_titre">Choisissez logement</p>
                    <h2 class="section_titre">Parcourir par type de <span>propriété</span></h2>
                </div>

                <div class="types_proprietes">
                    <?php 
                        $tabImgs = ["hotel1", "hotel2", "hotel3", "chambre1", "chambre2"] ;
                        $tabLegendes = ["Hôtels", "Appartements", "Resorts", "Villas", "Chambres d'hôtes"] ;
                    ?>
                    <?php for($i=0; $i < count($tabImgs); $i++): ?>
                        <div class="img">
                            <div class="image_container">
                                <img src="./assets/images/<?= $tabImgs[$i] ?>.png" alt="<?= $tabLegendes[$i] ?>" class="section3_img">
                            </div>
                            <p class="legende"><?= $tabLegendes[$i] ?></p>
                        </div>
                    <?php endfor; ?>
                    
                </div>
            </div>
        </section>

        <!-- ILES DE CORSE -->
        <section class="section4">
            <div class="banniere">
                <img src="./assets/images/image4.png" alt="image de banniere" class="banniere_img">
                <div class="banniere_content">
                    <h1 class="banniere_title">CORSICA</h1>
                </div>
            </div>
        </section>

        <!-- SECTION 5 : NOS OFFRES -->
        <section class="section5">
            <div class="">
                <p class="sous_titre">Une infinité de destination vous attend</p>
                <h2 class="section_titre">Nos <span>offres</span></h2>
            </div>

            <div class="services_content">
                <?php 
                    $tabServicesImgs = ["fa-solid fa-plane-departure",  "fa-solid fa-hotel" ,"fa-solid fa-car", "fa-solid fa-map-marked-alt"] ;
                    $tabServicesTitles = ["Réservation de vols", "Hébergement confortable", "Location de voitures" ,"Excursions et activités"] ;
                    $tabServicesTexts = [
                        "Réservez vos vols vers des destinations du monde entier avec nos tarifs compétitifs et notre service client exceptionnel.",
                        "Trouvez l'hébergement parfait pour votre séjour, que ce soit un hôtel de luxe, un appartement confortable ou une villa privée.",
                        "Louez une voiture adaptée à vos besoins et explorez votre destination à votre rythme avec notre service de location de voitures fiable.",
                        "Découvrez des excursions passionnantes et des activités uniques pour enrichir votre expérience de voyage."
                    ] ;
                ?>
                <?php for($i=0; $i < count($tabServicesImgs); $i++): ?>
                    <div class="service_card">
                        <i class="<?= $tabServicesImgs[$i] ?> service_icon"></i>
                        <h3 class="service_title"><?= $tabServicesTitles[$i] ?></h3>
                        <p class="service_text"><?= $tabServicesTexts[$i] ?></p>
                    </div>
                <?php endfor; ?>
            </div>
        </section>
        <!-- FIN SECTION 5 -->

        <!-- SECTION 5 : ACTIVITES -->
        <section class="section6">
            <div class="">
                <p class="sous_titre">Profitez au maximum de vos vacances</p>
                <h2 class="section_titre">Activités et <span>Excursions</span></h2>
            </div>

            <div class="activities_content">
                <img src="./assets/images/safari1.png" alt="image activité" class="activity_img">
                <img src="./assets/images/safari2.png" alt="image activité" class="activity_img">
                <img src="./assets/images/safari1.png" alt="image activité" class="activity_img">
                <img src="./assets/images/image8.png" alt="image activité" class="activity_img">
                <img src="./assets/images/safari2.png" alt="image activité" class="activity_img">
                <img src="./assets/images/safari1.png" alt="image activité" class="activity_img">
                <img src="./assets/images/safari2.png" alt="image activité" class="activity_img">
            </div>
        </section>
        <!-- FIN SECTION 5 -->
    </div>

    



</div>
