<header class="admin_topbar">
    <div class="topbar_left">
        <h2 class="dashboard_title">Tableau de bord</h2>
    </div>

    <div class="topbar_right">

        <!-- Search -->
        <div class="topbar_search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher...">
        </div>

        <div class="hidden">
            <!-- Notifications -->
            <div class="icon_item">
                <i class="fas fa-bell"></i>
                <span class="badge">3</span>
            </div>
    
            <!-- Messages -->
            <div class="icon_item">
                <i class="fas fa-envelope"></i>
                <span class="badge">5</span>
            </div>
        </div>

        <!-- User -->
        <div class="user_profile" id="userProfile">
            <img src="/assets/images/avatar.jpg" class="avatar" alt="avatar">
            <span class="username">Admin</span>
            <i class="fas fa-chevron-down"></i>

            <div class="dropdown_menu hidden" id="userDropdown">
                <a href="#profil">Profil</a>
                <a href="#parametres">Paramètres</a>
                <hr>
                <a href="#deconnexion" class="logout">Déconnexion</a>
            </div>
            <!-- Burger button (mobile only) -->
            <button id="burgerBtn" class="burger-btn">
                ☰
            </button>
        </div>


    </div>
</header>
