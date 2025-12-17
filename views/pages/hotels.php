<div id="page_hotels">
    <!-- HEADER -->
    <header class="header_section">
        <div class="navigation">
            <?php include_once "views/partials/_navigation.php"; ?>
        </div>
        <div class="header_section_content">
            <div class="banniere">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600&h=600&fit=crop" alt="Hôtels" class="banniere_img">
                <div class="banniere_content">
                    <h1 class="banniere_title">Trouvez votre <span style="color: #EAB308;">hébergement</span> idéal</h1>
                    <p class="banniere_text">Des hôtels de luxe aux chambres d'hôtes authentiques, découvrez nos meilleures offres</p>
                </div>
            </div>
        </div>
    </header>

    <!-- SEARCH BAR -->
    <div class="search_bar">
        <form class="search_form">
            <div class="input_group">
                <label>Destination</label>
                <input type="text" placeholder="Où souhaitez-vous aller ?">
            </div>
            <div class="input_group">
                <label>Arrivée</label>
                <input type="date" id="checkin">
            </div>
            <div class="input_group">
                <label>Départ</label>
                <input type="date" id="checkout">
            </div>
            <div class="input_group">
                <label>Voyageurs</label>
                <input type="number" min="1" value="2" placeholder="2 adultes">
            </div>
            <button type="submit" class="search_btn">
                <i class="fas fa-search"></i> Rechercher
            </button>
        </form>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main_content">
        <div class="content_layout">
            <!-- FILTERS SIDEBAR -->
            <aside class="filters_sidebar">
                <h2 class="filter_title">
                    <i class="fas fa-filter"></i>
                    Filtres
                </h2>

                <!-- PRICE RANGE -->
                <div class="filter_section">
                    <h3>Budget par nuit</h3>
                    <input type="range" class="price_range" min="0" max="500" value="250" id="priceRange">
                    <div class="price_display">
                        <span>0€</span>
                        <span id="priceValue">250€</span>
                    </div>
                </div>

                <!-- HOTEL TYPE -->
                <div class="filter_section">
                    <h3>Type d'hébergement</h3>
                    <div class="checkbox_item">
                        <input type="checkbox" id="hotel" checked>
                        <label for="hotel">Hôtel</label>
                    </div>
                    <div class="checkbox_item">
                        <input type="checkbox" id="resort">
                        <label for="resort">Resort</label>
                    </div>
                    <div class="checkbox_item">
                        <input type="checkbox" id="appartement">
                        <label for="appartement">Appartement</label>
                    </div>
                    <div class="checkbox_item">
                        <input type="checkbox" id="villa">
                        <label for="villa">Villa</label>
                    </div>
                </div>

                <!-- RATING -->
                <div class="filter_section">
                    <h3>Étoiles</h3>
                    <div class="checkbox_item">
                        <input type="checkbox" id="5stars">
                        <label for="5stars">⭐⭐⭐⭐⭐ 5 étoiles</label>
                    </div>
                    <div class="checkbox_item">
                        <input type="checkbox" id="4stars">
                        <label for="4stars">⭐⭐⭐⭐ 4 étoiles</label>
                    </div>
                    <div class="checkbox_item">
                        <input type="checkbox" id="3stars">
                        <label for="3stars">⭐⭐⭐ 3 étoiles</label>
                    </div>
                </div>

                <!-- AMENITIES -->
                <div class="filter_section">
                    <h3>Équipements</h3>
                    <div class="checkbox_item">
                        <input type="checkbox" id="wifi">
                        <label for="wifi">WiFi gratuit</label>
                    </div>
                    <div class="checkbox_item">
                        <input type="checkbox" id="piscine">
                        <label for="piscine">Piscine</label>
                    </div>
                    <div class="checkbox_item">
                        <input type="checkbox" id="parking">
                        <label for="parking">Parking</label>
                    </div>
                    <div class="checkbox_item">
                        <input type="checkbox" id="restaurant">
                        <label for="restaurant">Restaurant</label>
                    </div>
                    <div class="checkbox_item">
                        <input type="checkbox" id="spa">
                        <label for="spa">Spa</label>
                    </div>
                </div>
            </aside>

            <!-- HOTELS LIST -->
            <section class="hotels_section">
                <div class="section_header">
                    <div class="results_count">
                        <strong><?= count($hotels) ?></strong> hôtel<?= count($hotels) > 1 ? 's' : '' ?> trouvé<?= count($hotels) > 1 ? 's' : '' ?>
                    </div>
                    <select class="sort_select">
                        <option>Trier par: Recommandés</option>
                        <option>Prix croissant</option>
                        <option>Prix décroissant</option>
                        <option>Meilleures notes</option>
                        <option>Distance</option>
                    </select>
                </div>

                <div class="hotels_grid">
                    <?php if (!empty($hotels)): ?>
                        <?php 
                        $db = App\Core\Database::getInstance()->getConnection();
                        foreach ($hotels as $index => $hotel): 
                            // Récupérer l'image de l'hôtel
                            $stmtImage = $db->prepare("SELECT url FROM images WHERE item_type = 'hotel' AND item_id = ? LIMIT 1");
                            $stmtImage->execute([$hotel['id']]);
                            $image = $stmtImage->fetch();
                            $imageUrl = $image ? $image['url'] : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=600&h=400&fit=crop';
                            
                            // Récupérer les chambres pour trouver le prix minimum
                            $stmtRooms = $db->prepare("SELECT MIN(price_by_night) as min_price FROM rooms WHERE hotel_id = ?");
                            $stmtRooms->execute([$hotel['id']]);
                            $rooms = $stmtRooms->fetch();
                            $minPrice = $rooms['min_price'] ?? 99;
                            
                            // Générer les étoiles
                            $stars = str_repeat('⭐', $hotel['stars']);
                            // Badge selon l'index
                            $badges = [
                                ['text' => 'Meilleure offre', 'color' => '#296CF2'],
                                ['text' => 'Populaire', 'color' => '#EAB308'],
                                ['text' => 'Nouveau', 'color' => '#10B981'],
                            ];
                            $badgeInfo = $index < 3 ? $badges[$index] : null;
                            
                            // Note aléatoire réaliste
                            $rating = rand(80, 98) / 10;
                            $reviewCount = rand(100, 1500);
                        ?>
                            
                            <!-- HOTEL CARD <?= $index + 1 ?> -->
                            <div class="hotel_card">
                                <div class="hotel_image_container">
                                    <img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($hotel['name']) ?>" class="hotel_image">
                                    <?php if ($badgeInfo): ?>
                                        <span class="hotel_badge" style="background: <?= $badgeInfo['color'] ?>;"><?= $badgeInfo['text'] ?></span>
                                    <?php endif; ?>
                                    <button class="favorite_btn">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                                <div class="hotel_info">
                                    <div>
                                        <div class="hotel_header">
                                            <h3 class="hotel_name"><?= htmlspecialchars($hotel['name']) ?></h3>
                                            <div class="hotel_location">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span><?= htmlspecialchars($hotel['city']) ?><?= !empty($hotel['address']) ? ' - ' . htmlspecialchars($hotel['address']) : '' ?></span>
                                            </div>
                                        </div>
                                        <div class="hotel_rating">
                                            <div class="stars"><?= $stars ?></div>
                                            <span class="rating_score"><?= $rating ?></span>
                                            <span style="color: #6B7280; font-size: 0.875rem;">(<?= number_format($reviewCount, 0, ',', ' ') ?> avis)</span>
                                        </div>
                                        <div class="hotel_amenities">
                                            <span class="amenity"><i class="fas fa-wifi"></i> WiFi gratuit</span>
                                            <span class="amenity"><i class="fas fa-swimming-pool"></i> Piscine</span>
                                            <span class="amenity"><i class="fas fa-parking"></i> Parking</span>
                                            <span class="amenity"><i class="fas fa-utensils"></i> Restaurant</span>
                                        </div>
                                    </div>
                                    <div class="hotel_footer">
                                        <div class="price_section">
                                            <span class="price_label">À partir de</span>
                                            <div>
                                                <span class="hotel_price"><?= intval(round($minPrice)) ?>€</span>
                                                <span class="night_label">/ nuit</span>
                                            </div>
                                        </div>
                                        <button class="book_btn">Réserver</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Message si aucun hôtel -->
                        <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: #6B7280;">
                            <i class="fas fa-hotel" style="font-size: 3rem; margin-bottom: 1rem; color: #D1D5DB;"></i>
                            <p style="font-size: 1.2rem; font-weight: 600;">Aucun hôtel disponible pour le moment</p>
                            <p style="margin-top: 0.5rem;">Modifiez vos critères de recherche</p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</div>