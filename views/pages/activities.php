<div id="page_activities">
    <!-- HERO SECTION -->

    <header class="header_section">

        <div class="header_section_content">
            <div class="navigation">
                <?php include_once "views/partials/_navigation.php"; ?>
            </div>
    
            <div class="banniere">
                <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1600&h=800&fit=crop" alt="Banniere image" class="banniere_img">
                <div class="banniere_content">
                    <div class="hero_content">
                        <div class="hero_badge"> Plus de 500 activités disponibles</div>
                        <h1 class="hero_title">Vivez des <span style="color: #EAB308;">expériences</span> inoubliables</h1>
                        <p class="hero_subtitle">Découvrez des activités uniques, des excursions passionnantes et des aventures mémorables dans le monde entier</p>
                        <div class="hero_buttons">
                            <button class="btn_primary">Explorer les activités</button>
                            <button class="btn_secondary">Voir nos coups de cœur</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- CATEGORIES -->
    <section class="categories_section">
        <div class="categories_grid">
            <?php foreach($activities as $activity): ?>
            <div class="category_card">
                <div class="category_icon">
                    <img src="https://img.freepik.com/free-photo/friends-having-fun-with-balloons-outdoor-field_23-2149334478.jpg?semt=ais_hybrid&w=740&q=80" alt="image activites">
                </div>
                <div class="category_name"><?= $activity['name'] ?></div>
            </div>
            <?php endforeach ?>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="main_content">
        <div class="section_header">
            <p class="section_title">Explorez nos activités</p>
            <h2 class="section_heading">Expériences <span>populaires</span></h2>
        </div>

        <div class="activities_grid">
            <?php foreach($activities as $activity): ?>
            <!-- ACTIVITY 1 -->
            <div class="activity_card">
                <div class="activity_image_container">
                    <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&h=400&fit=crop" alt="Safari en Afrique" class="activity_image">
                    <div class="activity_overlay"></div>
                    <div class="activity_badge">
                        <i class="fas fa-fire"></i>
                        Populaire
                    </div>
                    <div class="activity_rating">
                        <i class="fas fa-star star_icon"></i>
                        4.9
                    </div>
                    <button class="wishlist_btn">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                <div class="activity_info">
                    <div class="activity_location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?= $activity['city'] ?></span>
                    </div>
                    <h3 class="activity_name"><?= $activity['name'] ?></h3>
                    <p class="activity_description">
                        <?= $activity['description'] ?>
                    </p>
                    <div class="activity_features">
                        <span class="feature_item">
                            <i class="fas fa-clock feature_icon"></i><?php 
                            $price = $activity['duration'];
                            echo ($price < 60) ? $price . " minutes" : round($price / 60) . " heures";
                            ?>
                        </span>
                        <span class="feature_item">
                            <i class="fas fa-users feature_icon"></i>
                            Max 8 personnes
                        </span>
                        <span class="feature_item">
                            <i class="fas fa-language feature_icon"></i>
                            Français
                        </span>
                    </div>
                    <div class="activity_footer">
                        <div class="activity_price">
                            <span class="price_from">À partir de</span>
                            <div>
                                <span class="price_amount"><?= intval(round($activity['price'])) ?>€</span>
                                <span class="price_person">/ pers.</span>
                            </div>
                        </div>
                        <button class="book_btn">Réserver</button>
                    </div>
                </div>
            </div>
            <?php endforeach ?>

        </div>

        <!-- FEATURED SECTION -->
        <section class="featured_section">
            <h2 class="featured_title">Pourquoi réserver vos activités avec nous ?</h2>
            <p class="featured_subtitle">Une expérience client incomparable et des souvenirs inoubliables</p>

            <div class="featured_grid">
                <div class="featured_card">
                    <div class="featured_icon"><i class="fa-solid fa-bolt"></i></div>
                    <h3 class="featured_card_title">Réservation instantanée</h3>
                    <p class="featured_card_text">Confirmation immédiate par email avec tous les détails de votre activité</p>
                </div>

                <div class="featured_card">
                    <div class="featured_icon"><i class="fa-solid fa-tag"></i></div>
                    <h3 class="featured_card_title">Meilleur prix garanti</h3>
                    <p class="featured_card_text">Nous vous remboursons la différence si vous trouvez moins cher ailleurs</p>
                </div>

                <div class="featured_card">
                    <div class="featured_icon"><i class="fa-solid fa-calendar-check"></i></div>
                    <h3 class="featured_card_title">Annulation flexible</h3>
                    <p class="featured_card_text">Annulation gratuite jusqu'à 24h avant le début de l'activité</p>
                </div>

                <div class="featured_card">
                    <div class="featured_icon"><i class="fa-solid fa-user-tie"></i></div>
                    <h3 class="featured_card_title">Guides experts</h3>
                    <p class="featured_card_text">Tous nos guides sont certifiés et passionnés par leur métier</p>
                </div>
            </div>
        </section>
    </div>
</div>
