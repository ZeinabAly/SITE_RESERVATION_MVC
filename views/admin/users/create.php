<div class="user-create-page">
    <header class="page-header">
        <h1>Ajouter un utilisateur</h1>
        <button type="button" onclick="loadPage('users/index')" class="btn-secondary">Retour</button>
    </header>

    <form method="POST" action="javascript:void(0);" id="createUserForm" class="styled-form" enctype="multipart/form-data">
        <div class="form-grid">
            <section class="form-section">
                <h2 class="section-title">Informations personnelles</h2>
                
                <div class="form-group">
                    <label>Nom complet</label>
                    <input type="text" name="name" id="name" placeholder="Ex: Jean Dupont">
                    <div class="error-message" data-field="name"></div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" placeholder="jean@exemple.com">
                    <div class="error-message" data-field="email"></div>
                </div>

                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="text" name="phone" id="phone" placeholder="9 chiffres">
                    <div class="error-message" data-field="phone"></div>
                </div>
            </section>

            <section class="form-section">
                <h2 class="section-title">Sécurité & Profil</h2>

                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" id="password" name="password">
                    <div class="error-message" data-field="password"></div>
                </div>

                <div class="form-group">
                    <label>Confirmer mot de passe</label>
                    <input type="password" id="password_confirm" name="password_confirm">
                    <div class="error-message" data-field="password_confirm"></div>
                </div>

                <div class="form-group">
                    <label>Photo de profil</label>
                    <div class="image-upload-wrapper">
                        <label for="avatarInput" class="image-placeholder">
                            <img id="imagePreview" src="assets/img/default-avatar.png" alt="Aperçu">
                            <span>Cliquez pour choisir</span>
                        </label>
                        <input type="file" id="image" name="image" hidden accept="image/*">
                    </div>
                    <div class="error-message" data-field="avatar"></div>
                </div>
            </section>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Enregistrer l'utilisateur</button>
        </div>
    </form>
</div>