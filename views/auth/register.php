<div class="loginPageContent">
    <?php include_once "views/partials/_navigation.php"; ?>
    <div id="login_page">
        <form class="form" method="POST" action="/register">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            <h2 class="title">Inscription</h2>
            <div class="input_group">
                <svg width="18" height="18" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.125 13.125a4.375 4.375 0 0 1 8.75 0M10 4.375a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" stroke="#6B7280" stroke-opacity=".6" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input name="name" value="<?= $old['name'] ?? '' ?>" class="input" type="text" placeholder="Nom">
               
            </div>
            <?php if(isset($errors['name'])): ?>
                <small class="error-text" style="color: red; font-size: 0.8rem;"><?= $errors['name'][0] ?></small>
            <?php endif; ?>
            <div class="input_group">
                <svg width="18" height="18" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="m2.5 4.375 3.875 2.906c.667.5 1.583.5 2.25 0L12.5 4.375" stroke="#6B7280" stroke-opacity=".6" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.875 3.125h-8.75c-.69 0-1.25.56-1.25 1.25v6.25c0 .69.56 1.25 1.25 1.25h8.75c.69 0 1.25-.56 1.25-1.25v-6.25c0-.69-.56-1.25-1.25-1.25Z" stroke="#6B7280" stroke-opacity=".6" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
                <input name="email" class="input" type="email" placeholder="Email" value="<?= $old['email'] ?? '' ?>">
            </div>
            <?php if(isset($errors['email'])): ?>
                <small class="error-text" style="color: red; font-size: 0.8rem;"><?= $errors['email'][0] ?></small>
            <?php endif; ?>
            <div class="input_group">
                <svg width="18" height="18" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="m2.5 4.375 3.875 2.906c.667.5 1.583.5 2.25 0L12.5 4.375" stroke="#6B7280" stroke-opacity=".6" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.875 3.125h-8.75c-.69 0-1.25.56-1.25 1.25v6.25c0 .69.56 1.25 1.25 1.25h8.75c.69 0 1.25-.56 1.25-1.25v-6.25c0-.69-.56-1.25-1.25-1.25Z" stroke="#6B7280" stroke-opacity=".6" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
                <input name="phone" class="input" type="number" placeholder="Phone" value="<?= $old['name'] ?? '' ?>">
            </div>
            <?php if(isset($errors['phone'])): ?>
                <small class="error-text" style="color: red; font-size: 0.8rem;"><?= $errors['phone'][0] ?></small>
            <?php endif; ?>
            <div class="input_group">
                <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 8.5c0-.938-.729-1.7-1.625-1.7h-.812V4.25C10.563 1.907 8.74 0 6.5 0S2.438 1.907 2.438 4.25V6.8h-.813C.729 6.8 0 7.562 0 8.5v6.8c0 .938.729 1.7 1.625 1.7h9.75c.896 0 1.625-.762 1.625-1.7zM4.063 4.25c0-1.406 1.093-2.55 2.437-2.55s2.438 1.144 2.438 2.55V6.8H4.061z" fill="#6B7280"/>
                </svg>
                <input name="password" class="input" type="password" placeholder="Password">
            </div>
            <?php if(isset($errors['password'])): ?>
                <small class="error-text" style="color: red; font-size: 0.8rem;"><?= $errors['password'][0] ?></small>
            <?php endif; ?>
            <div class="input_group">
                <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 8.5c0-.938-.729-1.7-1.625-1.7h-.812V4.25C10.563 1.907 8.74 0 6.5 0S2.438 1.907 2.438 4.25V6.8h-.813C.729 6.8 0 7.562 0 8.5v6.8c0 .938.729 1.7 1.625 1.7h9.75c.896 0 1.625-.762 1.625-1.7zM4.063 4.25c0-1.406 1.093-2.55 2.437-2.55s2.438 1.144 2.438 2.55V6.8H4.061z" fill="#6B7280"/>
                </svg>
                <input name="password_confirm" class="input" type="password" placeholder="Confirmer le mot de passe">
            </div>
            <?php if(isset($errors['password_confirm'])): ?>
                <small class="error-text" style="color: red; font-size: 0.8rem;"><?= $errors['password_confirm'][0] ?></small>
            <?php endif; ?>
            <button type="submit" class="btn_creer">Créer mon compte</button>
            <p class="text-center mt-4">J'ai déjà un compte? <a href="/login" class="text-blue-500 underline">Connexion</a></p>
        </form>
    </div>  
</div>