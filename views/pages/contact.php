<div id="contact_page">
    <!-- HEADER -->
    <header class="header_section">
        <div class="navigation">
            <?php include_once "views/partials/_navigation.php"; ?>
        </div>
        <div class="header_content">
            <h1 class="header_title">Contactez-nous</h1>
            <p class="header_subtitle">Notre équipe est à votre écoute pour répondre à toutes vos questions</p>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <div class="main_content">
        <!-- CONTACT GRID -->
        <div class="contact_grid">
            <!-- CONTACT FORM -->
            <div class="contact_form_section">
                <h2 class="form_title">Envoyez-nous un message</h2>
                <p class="form_subtitle">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais</p>

                <form class="contact_form" id="contactForm">
                    <div class="form_row">
                        <div class="form_group">
                            <label>Nom <span class="required">*</span></label>
                            <input type="text" name="nom" placeholder="Votre nom" required>
                        </div>
                        <div class="form_group">
                            <label>Prénom <span class="required">*</span></label>
                            <input type="text" name="prenom" placeholder="Votre prénom" required>
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="form_group">
                            <label>Email <span class="required">*</span></label>
                            <input type="email" name="email" placeholder="votre@email.com" required>
                        </div>
                        <div class="form_group">
                            <label>Téléphone</label>
                            <input type="tel" name="telephone" placeholder="+33 6 00 00 00 00">
                        </div>
                    </div>

                    <div class="form_group">
                        <label>Sujet <span class="required">*</span></label>
                        <select name="sujet" required>
                            <option value="">Sélectionnez un sujet</option>
                            <option value="reservation">Question sur une réservation</option>
                            <option value="modification">Modification de réservation</option>
                            <option value="annulation">Annulation</option>
                            <option value="reclamation">Réclamation</option>
                            <option value="information">Demande d'information</option>
                            <option value="partenariat">Partenariat</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>

                    <div class="form_group">
                        <label>Message <span class="required">*</span></label>
                        <textarea name="message" placeholder="Écrivez votre message ici..." required></textarea>
                    </div>

                    <button type="submit" class="submit_btn">
                        <i class="fas fa-paper-plane"></i>
                        Envoyer le message
                    </button>
                </form>
            </div>

            <!-- CONTACT INFO -->
            <div class="contact_info_section">
                <!-- COORDONNÉES -->
                <div class="info_card">
                    <div class="info_card_header">
                        <div class="info_icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h3 class="info_card_title">Nos coordonnées</h3>
                    </div>

                    <div class="info_item">
                        <i class="fas fa-map-marker-alt info_item_icon"></i>
                        <div class="info_item_content">
                            <div class="info_item_label">Adresse</div>
                            <div class="info_item_value">123 Avenue des Voyages<br>75001 Paris, France</div>
                        </div>
                    </div>

                    <div class="info_item">
                        <i class="fas fa-phone info_item_icon"></i>
                        <div class="info_item_content">
                            <div class="info_item_label">Téléphone</div>
                            <div class="info_item_value">
                                <a href="tel:+33123456789">+33 1 23 45 67 89</a>
                            </div>
                        </div>
                    </div>

                    <div class="info_item">
                        <i class="fas fa-envelope info_item_icon"></i>
                        <div class="info_item_content">
                            <div class="info_item_label">Email</div>
                            <div class="info_item_value">
                                <a href="mailto:contact@votreagence.com">contact@votreagence.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="social_links">
                        <a href="#" class="social_btn" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social_btn" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social_btn" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social_btn" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social_btn" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- HORAIRES -->
                <div class="info_card">
                    <div class="info_card_header">
                        <div class="info_icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="info_card_title">Horaires d'ouverture</h3>
                    </div>

                    <div class="hours_table">
                        <div class="hours_row">
                            <span class="hours_day">Lundi - Vendredi</span>
                            <span class="hours_time hours_highlight">9h00 - 19h00</span>
                        </div>
                        <div class="hours_row">
                            <span class="hours_day">Samedi</span>
                            <span class="hours_time">10h00 - 18h00</span>
                        </div>
                        <div class="hours_row">
                            <span class="hours_day">Dimanche</span>
                            <span class="hours_time">Fermé</span>
                        </div>
                        <div class="hours_row">
                            <span class="hours_day">Urgence 24/7</span>
                            <span class="hours_time hours_highlight">
                                <i class="fas fa-phone"></i> +33 6 00 00 00 00
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAP -->
        <div class="map_section">
            <h2 class="map_title">Notre localisation</h2>
            <div class="map_container">
                <div class="map_placeholder">
                    <i class="fas fa-map-marked-alt"></i>
                    <p>123 Avenue des Voyages, 75001 Paris</p>
                    <small style="color: #9CA3AF; margin-top: 0.5rem;">
                        Intégrez ici votre Google Maps iframe
                    </small>
                </div>
                <!-- Exemple d'intégration Google Maps (à remplacer par votre propre URL) -->
                <!-- <iframe 
                    src="https://www.google.com/maps/embed?pb=..."
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe> -->
            </div>
        </div>

        <!-- FAQ -->
        <div class="faq_section">
            <h2 class="faq_title">Questions fréquentes</h2>
            <p class="faq_subtitle">Trouvez rapidement des réponses à vos questions</p>

            <div class="faq_grid">
                <div class="faq_item">
                    <div class="faq_question">
                        <i class="fas fa-question-circle"></i>
                        <span>Quels sont vos délais de réponse ?</span>
                    </div>
                    <p class="faq_answer">
                        Nous répondons à toutes les demandes dans un délai de 24h ouvrées. Pour les urgences, contactez notre ligne 24/7.
                    </p>
                </div>

                <div class="faq_item">
                    <div class="faq_question">
                        <i class="fas fa-question-circle"></i>
                        <span>Comment modifier ma réservation ?</span>
                    </div>
                    <p class="faq_answer">
                        Contactez-nous par téléphone ou email avec votre numéro de réservation. Les modifications sont possibles selon les conditions du prestataire.
                    </p>
                </div>

                <div class="faq_item">
                    <div class="faq_question">
                        <i class="fas fa-question-circle"></i>
                        <span>Puis-je annuler gratuitement ?</span>
                    </div>
                    <p class="faq_answer">
                        Les conditions d'annulation varient selon le type de réservation. Consultez vos conditions dans votre email de confirmation.
                    </p>
                </div>

                <div class="faq_item">
                    <div class="faq_question">
                        <i class="fas fa-question-circle"></i>
                        <span>Proposez-vous des assurances voyage ?</span>
                    </div>
                    <p class="faq_answer">
                        Oui, nous proposons différentes formules d'assurance voyage couvrant annulation, rapatriement et bagages.
                    </p>
                </div>

                <div class="faq_item">
                    <div class="faq_question">
                        <i class="fas fa-question-circle"></i>
                        <span>Acceptez-vous les paiements en plusieurs fois ?</span>
                    </div>
                    <p class="faq_answer">
                        Oui, nous proposons des facilités de paiement en 3 ou 4 fois sans frais pour les réservations de plus de 500€.
                    </p>
                </div>

                <div class="faq_item">
                    <div class="faq_question">
                        <i class="fas fa-question-circle"></i>
                        <span>Comment obtenir mes billets électroniques ?</span>
                    </div>
                    <p class="faq_answer">
                        Vos billets électroniques vous sont envoyés par email dès confirmation du paiement. Vérifiez également vos spams.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>