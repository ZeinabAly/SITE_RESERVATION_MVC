<div class="loginPageContent">
    <?php include_once "views/partials/_navigation.php"; ?>

    <div id="login_page">
        <form class="form" method="POST" action="/login">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
            
            <h2 class="title">Connexion</h2>

            <?php if(isset($error)): ?>
                <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.9rem; text-align: center;">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <div class="input_group">
                <svg width="18" height="18" viewBox="0 0 15 15" fill="none">
                    <path d="m2.5 4.375 3.875 2.906c.667.5 1.583.5 2.25 0L12.5 4.375" stroke="#6B7280" stroke-opacity=".6" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.875 3.125h-8.75c-.69 0-1.25.56-1.25 1.25v6.25c0 .69.56 1.25 1.25 1.25h8.75c.69 0 1.25-.56 1.25-1.25v-6.25c0-.69-.56-1.25-1.25-1.25Z" stroke="#6B7280" stroke-opacity=".6" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
                <input name="email" class="input" type="email" placeholder="Email" value="<?= $old_email ?? '' ?>" required>
            </div>

            <div class="input_group">
                <svg width="13" height="17" viewBox="0 0 13 17" fill="none">
                    <path d="M13 8.5c0-.938-.729-1.7-1.625-1.7h-.812V4.25C10.563 1.907 8.74 0 6.5 0S2.438 1.907 2.438 4.25V6.8h-.813C.729 6.8 0 7.562 0 8.5v6.8c0 .938.729 1.7 1.625 1.7h9.75c.896 0 1.625-.762 1.625-1.7zM4.063 4.25c0-1.406 1.093-2.55 2.437-2.55s2.438 1.144 2.438 2.55V6.8H4.061z" fill="#6B7280"/>
                </svg>
                <input name="password" class="input" type="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn_creer">Connexion</button>
            <p class="text-center mt-4">J'ai pas de compte? <a href="/register" class="text-blue-500 underline">Inscription</a></p>
        </form>
    </div>
</div>