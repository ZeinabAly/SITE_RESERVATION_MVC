<div id="page_location_voiture">
    <!-- HEADER -->
    <header class="header_section">
        <div class="navigation">
            <?php include_once "views/partials/_navigation.php"; ?>
        </div>
        <div class="header_content">
            <div class="car_icon">
                <i class="fas fa-car"></i>
            </div>
            <h1 class="header_title">Location de <span style="color: #EAB308;">Voitures</span></h1>
            <p class="header_subtitle">Explorez en toute liberté avec notre large gamme de véhicules adaptés à tous vos besoins</p>
        </div>
    </header>

    <!-- SEARCH SECTION -->
    <div class="search_section">
        <form class="search_form">
            <div class="input_group">
                <label>Lieu de prise en charge</label>
                <input type="text" placeholder="Ville ou aéroport">
            </div>
            <div class="input_group">
                <label>Date de début</label>
                <input type="date" id="pickup_date">
            </div>
            <div class="input_group">
                <label>Date de fin</label>
                <input type="date" id="return_date">
            </div>
            <div class="input_group">
                <label>Heure</label>
                <input type="time" value="10:00">
            </div>
            <button type="submit" class="search_btn">
                <i class="fas fa-search"></i> Rechercher des véhicules
            </button>
        </form>
    </div>

    <!-- CATEGORIES -->
    <section class="categories_section">
        <p class="section_title">Choisissez votre catégorie</p>
        <h2 class="section_heading">Types de <span>véhicules</span></h2>

        <div class="categories_grid">
            <div class="category_card">
                <div class="category_icon">🚗</div>
                <div class="category_name">Économique</div>
                <div class="category_count">45 véhicules</div>
            </div>
            <div class="category_card">
                <div class="category_icon">🏎️</div>
                <div class="category_name">Sport</div>
                <div class="category_count">12 véhicules</div>
            </div>
            <div class="category_card">
                <div class="category_icon">🚙</div>
                <div class="category_name">SUV</div>
                <div class="category_count">28 véhicules</div>
            </div>
            <div class="category_card">
                <div class="category_icon">👔</div>
                <div class="category_name">Luxe</div>
                <div class="category_count">15 véhicules</div>
            </div>
            <div class="category_card">
                <div class="category_icon">⚡</div>
                <div class="category_name">Électrique</div>
                <div class="category_count">20 véhicules</div>
            </div>
            <div class="category_card">
                <div class="category_icon">👨‍👩‍👧‍👦</div>
                <div class="category_name">Familiale</div>
                <div class="category_count">32 véhicules</div>
            </div>
        </div>
    </section>

    <!-- CARS GRID -->
    <section class="cars_section">
        <p class="section_title">Nos véhicules disponibles</p>
        <h2 class="section_heading">Voitures <span>populaires</span></h2>

        <div class="cars_grid">
            <!-- CAR 1 -->
            <div class="car_card">
                <div class="car_image_container">
                    <img src="https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?w=600&h=400&fit=crop" alt="BMW Série 3" class="car_image">
                    <span class="car_badge">Premium</span>
                </div>
                <div class="car_info">
                    <div class="car_header">
                        <div class="car_category">Sport / Luxe</div>
                        <h3 class="car_name">BMW Série 3</h3>
                    </div>
                    <div class="car_specs">
                        <div class="spec_item">
                            <i class="fas fa-users spec_icon"></i>
                            <div class="spec_value">5</div>
                            <div class="spec_label">Places</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-cog spec_icon"></i>
                            <div class="spec_value">Auto</div>
                            <div class="spec_label">Boîte</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-gas-pump spec_icon"></i>
                            <div class="spec_value">Diesel</div>
                            <div class="spec_label">Carburant</div>
                        </div>
                    </div>
                    <div class="car_features">
                        <span class="feature_badge">GPS inclus</span>
                        <span class="feature_badge">Climatisation</span>
                        <span class="feature_badge">Bluetooth</span>
                    </div>
                    <div class="car_footer">
                        <div class="car_price">
                            <span class="price_amount">89€</span>
                            <span class="price_period">par jour</span>
                        </div>
                        <button class="rent_btn">Réserver</button>
                    </div>
                </div>
            </div>

            <!-- CAR 2 -->
            <div class="car_card">
                <div class="car_image_container">
                    <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=600&h=400&fit=crop" alt="Tesla Model 3" class="car_image">
                    <span class="car_badge">Populaire</span>
                    <span class="eco_badge">⚡ Électrique</span>
                </div>
                <div class="car_info">
                    <div class="car_header">
                        <div class="car_category">Électrique / Premium</div>
                        <h3 class="car_name">Tesla Model 3</h3>
                    </div>
                    <div class="car_specs">
                        <div class="spec_item">
                            <i class="fas fa-users spec_icon"></i>
                            <div class="spec_value">5</div>
                            <div class="spec_label">Places</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-cog spec_icon"></i>
                            <div class="spec_value">Auto</div>
                            <div class="spec_label">Boîte</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-battery-full spec_icon"></i>
                            <div class="spec_value">450km</div>
                            <div class="spec_label">Autonomie</div>
                        </div>
                    </div>
                    <div class="car_features">
                        <span class="feature_badge">Autopilot</span>
                        <span class="feature_badge">Écologique</span>
                        <span class="feature_badge">Supercharge</span>
                    </div>
                    <div class="car_footer">
                        <div class="car_price">
                            <span class="price_amount">99€</span>
                            <span class="price_period">par jour</span>
                        </div>
                        <button class="rent_btn">Réserver</button>
                    </div>
                </div>
            </div>

            <!-- CAR 3 -->
            <div class="car_card">
                <div class="car_image_container">
                    <img src="https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=600&h=400&fit=crop" alt="Range Rover Evoque" class="car_image">
                    <span class="car_badge" style="background: #EAB308;">Nouveau</span>
                </div>
                <div class="car_info">
                    <div class="car_header">
                        <div class="car_category">SUV / Luxe</div>
                        <h3 class="car_name">Range Rover Evoque</h3>
                    </div>
                    <div class="car_specs">
                        <div class="spec_item">
                            <i class="fas fa-users spec_icon"></i>
                            <div class="spec_value">5</div>
                            <div class="spec_label">Places</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-cog spec_icon"></i>
                            <div class="spec_value">Auto</div>
                            <div class="spec_label">Boîte</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-gas-pump spec_icon"></i>
                            <div class="spec_value">Hybride</div>
                            <div class="spec_label">Carburant</div>
                        </div>
                    </div>
                    <div class="car_features">
                        <span class="feature_badge">4x4</span>
                        <span class="feature_badge">Cuir</span>
                        <span class="feature_badge">Caméra 360°</span>
                    </div>
                    <div class="car_footer">
                        <div class="car_price">
                            <span class="price_amount">129€</span>
                            <span class="price_period">par jour</span>
                        </div>
                        <button class="rent_btn">Réserver</button>
                    </div>
                </div>
            </div>

            <!-- CAR 4 -->
            <div class="car_card">
                <div class="car_image_container">
                    <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=600&h=400&fit=crop" alt="Renault Clio" class="car_image">
                    <span class="car_badge" style="background: #10B981;">Économique</span>
                </div>
                <div class="car_info">
                    <div class="car_header">
                        <div class="car_category">Économique / Citadine</div>
                        <h3 class="car_name">Renault Clio</h3>
                    </div>
                    <div class="car_specs">
                        <div class="spec_item">
                            <i class="fas fa-users spec_icon"></i>
                            <div class="spec_value">5</div>
                            <div class="spec_label">Places</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-cog spec_icon"></i>
                            <div class="spec_value">Manuelle</div>
                            <div class="spec_label">Boîte</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-gas-pump spec_icon"></i>
                            <div class="spec_value">Essence</div>
                            <div class="spec_label">Carburant</div>
                        </div>
                    </div>
                    <div class="car_features">
                        <span class="feature_badge">Climatisation</span>
                        <span class="feature_badge">Radio</span>
                        <span class="feature_badge">Faible conso.</span>
                    </div>
                    <div class="car_footer">
                        <div class="car_price">
                            <span class="price_amount">35€</span>
                            <span class="price_period">par jour</span>
                        </div>
                        <button class="rent_btn">Réserver</button>
                    </div>
                </div>
            </div>

            <!-- CAR 5 -->
            <div class="car_card">
                <div class="car_image_container">
                    <img src="https://images.unsplash.com/photo-1502877338535-766e1452684a?w=600&h=400&fit=crop" alt="Mercedes Classe E" class="car_image">
                    <span class="car_badge">Luxe</span>
                </div>
                <div class="car_info">
                    <div class="car_header">
                        <div class="car_category">Luxe / Berline</div>
                        <h3 class="car_name">Mercedes Classe E</h3>
                    </div>
                    <div class="car_specs">
                        <div class="spec_item">
                            <i class="fas fa-users spec_icon"></i>
                            <div class="spec_value">5</div>
                            <div class="spec_label">Places</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-cog spec_icon"></i>
                            <div class="spec_value">Auto</div>
                            <div class="spec_label">Boîte</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-gas-pump spec_icon"></i>
                            <div class="spec_value">Diesel</div>
                            <div class="spec_label">Carburant</div>
                        </div>
                    </div>
                    <div class="car_features">
                        <span class="feature_badge">Cuir</span>
                        <span class="feature_badge">Massage</span>
                        <span class="feature_badge">Sonos</span>
                    </div>
                    <div class="car_footer">
                        <div class="car_price">
                            <span class="price_amount">149€</span>
                            <span class="price_period">par jour</span>
                        </div>
                        <button class="rent_btn">Réserver</button>
                    </div>
                </div>
            </div>

            <!-- CAR 6 -->
            <div class="car_card">
                <div class="car_image_container">
                    <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=600&h=400&fit=crop" alt="Peugeot 3008" class="car_image">
                </div>
                <div class="car_info">
                    <div class="car_header">
                        <div class="car_category">SUV / Familiale</div>
                        <h3 class="car_name">Peugeot 3008</h3>
                    </div>
                    <div class="car_specs">
                        <div class="spec_item">
                            <i class="fas fa-users spec_icon"></i>
                            <div class="spec_value">5</div>
                            <div class="spec_label">Places</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-cog spec_icon"></i>
                            <div class="spec_value">Auto</div>
                            <div class="spec_label">Boîte</div>
                        </div>
                        <div class="spec_item">
                            <i class="fas fa-gas-pump spec_icon"></i>
                            <div class="spec_value">Diesel</div>
                            <div class="spec_label">Carburant</div>
                        </div>
                    </div>
                    <div class="car_features">
                        <span class="feature_badge">GPS</span>
                        <span class="feature_badge">7 places</span>
                        <span class="feature_badge">Grand coffre</span>
                    </div>
                    <div class="car_footer">
                        <div class="car_price">
                            <span class="price_amount">69€</span>
                            <span class="price_period">par jour</span>
                        </div>
                        <button class="rent_btn">Réserver</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BENEFITS -->
    <section class="benefits_section">
        <p class="section_title">Nos avantages</p>
        <h2 class="section_heading">Pourquoi louer avec <span>nous</span> ?</h2>

        <div class="benefits_grid">
            <div class="benefit_card">
                <div class="benefit_icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="benefit_title">Assurance complète</h3>
                <p class="benefit_text">Tous nos véhicules incluent une assurance tous risques pour votre tranquillité d'esprit.</p>
            </div>

            <div class="benefit_card">
                <div class="benefit_icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="benefit_title">Service 24/7</h3>
                <p class="benefit_text">Assistance disponible jour et nuit en cas de problème ou de question.</p>
            </div>

            <div class="benefit_card">
                <div class="benefit_icon">
                    <i class="fas fa-ban"></i>
                </div>
                <h3 class="benefit_title">Annulation gratuite</h3>
                <p class="benefit_text">Modifiez ou annulez votre réservation gratuitement jusqu'à 24h avant.</p>
            </div>

            <div class="benefit_card">
                <div class="benefit_icon">
                    <i class="fas fa-gas-pump"></i>
                </div>
                <h3 class="benefit_title">Carburant flexible</h3>
                <p class="benefit_text">Options de plein à la prise en charge ou au retour selon vos préférences.</p>
            </div>
        </div>
    </section>
</div>
