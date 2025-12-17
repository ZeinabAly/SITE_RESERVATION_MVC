<div id="flights_page">
    <!-- HEADER SECTION -->
    <header class="header_section">
        <div class="navigation">
            <?php include_once "views/partials/_navigation.php"; ?>
        </div>
        <div class="header_section_content">
            <div class="banniere">
                <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1600&h=600&fit=crop" alt="image de banniere" class="banniere_img">
                <div class="banniere_content">
                    <h1 class="banniere_title">Réservez vos <span style="color: #EAB308;">vols</span></h1>
                    <p class="banniere_text">Explorez le monde avec nos meilleurs tarifs et compagnies aériennes partenaires</p>
                </div>
            </div>
        </div>
    </header>

    <!-- SEARCH SECTION -->
    <div class="search_section">
        <div class="search_section_content">
            <!-- TRIP TYPE TABS -->
            <div class="trip_type_tabs">
                <div class="trip_tab">
                    <input type="radio" id="aller-retour" name="trip_type" checked>
                    <label for="aller-retour">
                        <i class="fas fa-exchange-alt"></i>
                        Aller-retour
                    </label>
                </div>
                <div class="trip_tab">
                    <input type="radio" id="aller-simple" name="trip_type">
                    <label for="aller-simple">
                        <i class="fas fa-arrow-right"></i>
                        Aller simple
                    </label>
                </div>
                <div class="trip_tab">
                    <input type="radio" id="multi-villes" name="trip_type">
                    <label for="multi-villes">
                        <i class="fas fa-map-marked-alt"></i>
                        Multi-destinations
                    </label>
                </div>
            </div>

            <!-- SEARCH FORM -->
            <form class="search_form" id="flight_search_form">
                <div class="form_content">
                    <div class="input_group">
                        <label for="ville_depart">Ville de départ</label>
                        <input type="text" id="ville_depart" name="ville_depart" placeholder="Paris (CDG)">
                        <i class="fas fa-plane-departure input_icon"></i>
                    </div>

                    <div class="input_group">
                        <label for="ville_arrivee">Ville d'arrivée</label>
                        <input type="text" id="ville_arrivee" name="ville_arrivee" placeholder="Londres (LHR)">
                        <i class="fas fa-plane-arrival input_icon"></i>
                    </div>

                    <div class="input_group">
                        <label for="date_depart">Date de départ</label>
                        <input type="date" id="date_depart" name="date_depart">
                        <i class="fas fa-calendar-alt input_icon"></i>
                    </div>

                    <div class="input_group">
                        <label for="date_retour">Date de retour</label>
                        <input type="date" id="date_retour" name="date_retour">
                        <i class="fas fa-calendar-alt input_icon"></i>
                    </div>

                    <div class="input_group">
                        <label for="passagers">Passagers</label>
                        <select id="passagers" name="passagers">
                            <option value="1">1 passager</option>
                            <option value="2">2 passagers</option>
                            <option value="3">3 passagers</option>
                            <option value="4">4 passagers</option>
                            <option value="5">5+ passagers</option>
                        </select>
                        <i class="fas fa-users input_icon"></i>
                    </div>

                    <div class="input_group">
                        <label for="classe">Classe</label>
                        <select id="classe" name="classe">
                            <option value="economique">Économique</option>
                            <option value="premium">Premium Éco</option>
                            <option value="affaires">Affaires</option>
                            <option value="premiere">Première</option>
                        </select>
                        <i class="fas fa-chair input_icon"></i>
                    </div>
                </div>

                <button type="submit" class="search_btn">
                    <i class="fas fa-search"></i>
                    Rechercher des vols
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main_content">
        <!-- POPULAR ROUTES -->
        <section class="popular_routes">
            <p class="sous_titre">Voyagez malin</p>
            <h2 class="section_titre">Routes <span>populaires</span></h2>

            <div class="routes_grid">
                <?php if (!empty($vols)): ?>
                    <?php 
                    $db = App\Core\Database::getInstance()->getConnection();
                    foreach ($vols as $vol): 
                        // Récupérer les informations des aéroports et compagnie
                        $stmtDeparture = $db->prepare("SELECT * FROM airports WHERE id = ?");
                        $stmtDeparture->execute([$vol['departure_airport_id']]);
                        $departureAirport = $stmtDeparture->fetch();
                        
                        $stmtArrival = $db->prepare("SELECT * FROM airports WHERE id = ?");
                        $stmtArrival->execute([$vol['arrival_airport_id']]);
                        $arrivalAirport = $stmtArrival->fetch();
                        
                        $stmtAirline = $db->prepare("SELECT * FROM airlines WHERE id = ?");
                        $stmtAirline->execute([$vol['airline_id']]);
                        $airline = $stmtAirline->fetch();
                        
                        // Récupérer l'image
                        $stmtImage = $db->prepare("SELECT url FROM images WHERE item_type = 'flight' AND item_id = ? LIMIT 1");
                        $stmtImage->execute([$vol['id']]);
                        $image = $stmtImage->fetch();
                        $imageUrl = $image ? $image['url'] : 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=600&h=400&fit=crop';
                    ?>
                        
                        <div class="route_card">
                            <img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($arrivalAirport['city'] ?? 'Destination') ?>" class="route_image">
                            <div class="route_info">
                                <div class="route_cities">
                                    <span class="city_name"><?= htmlspecialchars($departureAirport['city'] ?? 'Départ') ?></span>
                                    <i class="fas fa-plane route_icon"></i>
                                    <span class="city_name"><?= htmlspecialchars($arrivalAirport['city'] ?? 'Arrivée') ?></span>
                                </div>
                                <div class="route_details">
                                    <div>
                                        <div class="route_price"><?= intval(round($vol['price'])) ?>€</div>
                                        <div class="price_label">par personne</div>
                                    </div>
                                    <div class="route_company">
                                        <i class="fas fa-plane-departure"></i>
                                        <?= htmlspecialchars($airline['name'] ?? 'Compagnie') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Message si aucun vol -->
                    <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: #6B7280;">
                        <i class="fas fa-plane-slash" style="font-size: 3rem; margin-bottom: 1rem; color: #D1D5DB;"></i>
                        <p style="font-size: 1.2rem; font-weight: 600;">Aucun vol disponible pour le moment</p>
                        <p style="margin-top: 0.5rem;">Revenez plus tard pour découvrir nos offres</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- SERVICES SECTION -->
        <section class="services_section">
            <p class="sous_titre">Nos avantages</p>
            <h2 class="section_titre">Pourquoi réserver avec <span>nous</span> ?</h2>

            <div class="services_grid">
                <div class="service_card">
                    <div class="service_icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <h3 class="service_title">Meilleurs prix garantis</h3>
                    <p class="service_text">Nous comparons des centaines de compagnies aériennes pour vous offrir les tarifs les plus compétitifs du marché.</p>
                </div>

                <div class="service_card">
                    <div class="service_icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="service_title">Paiement sécurisé</h3>
                    <p class="service_text">Vos transactions sont protégées par un cryptage SSL de niveau bancaire pour une sécurité optimale.</p>
                </div>

                <div class="service_card">
                    <div class="service_icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="service_title">Confirmation instantanée</h3>
                    <p class="service_text">Recevez votre billet électronique immédiatement par email après validation de votre réservation.</p>
                </div>

                <div class="service_card">
                    <div class="service_icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="service_title">Support 24/7</h3>
                    <p class="service_text">Notre équipe d'assistance est disponible 24h/24 et 7j/7 pour répondre à toutes vos questions.</p>
                </div>
            </div>
        </section>

        <!-- AIRLINES PARTNERS -->
        <section class="airlines_section">
            <p class="sous_titre">Nos partenaires</p>
            <h2 class="section_titre">Compagnies <span>aériennes</span></h2>

            <div class="airlines_logos">
                <div style="width: 120px; height: 60px; display: flex; align-items: center; justify-content: center; background: white; border-radius: 0.5rem; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <span style="font-weight: 700; font-size: 1.2rem; color: #296CF2;">Air France</span>
                </div>
                <div style="width: 120px; height: 60px; display: flex; align-items: center; justify-content: center; background: white; border-radius: 0.5rem; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <span style="font-weight: 700; font-size: 1.2rem; color: #C41E3A;">Emirates</span>
                </div>
                <div style="width: 120px; height: 60px; display: flex; align-items: center; justify-content: center; background: white; border-radius: 0.5rem; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <span style="font-weight: 700; font-size: 1.2rem; color: #002D72;">Lufthansa</span>
                </div>
                <div style="width: 120px; height: 60px; display: flex; align-items: center; justify-content: center; background: white; border-radius: 0.5rem; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <span style="font-weight: 700; font-size: 1.2rem; color: #FF0000;">KLM</span>
                </div>
                <div style="width: 120px; height: 60px; display: flex; align-items: center; justify-content: center; background: white; border-radius: 0.5rem; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <span style="font-weight: 700; font-size: 1.2rem; color: #006DAA;">Qatar Airways</span>
                </div>
            </div>
        </section>
    </div>
</div>