// FUNCTION LOADPAGE
export function loadPage(page, pushToHistory = true) {
    fetch(`./views/admin/${page}.php`)
        .then(res => {
            if(!res.ok) throw new Error("Page not found");
            return res.text();
        })
        .then(html => {
        document.getElementById('mainContent').innerHTML = html;
        initPage(page);
    
        // On ajoute à l'historique seulement si ce n'est pas un bouton "Retour"
        if (pushToHistory) {
            history.pushState({ pageName: page }, "", `#${page}`);
        }

    })
    .catch(() => {
        document.getElementById('mainContent').innerHTML =
            '<p class="text-red-500">Page introuvable</p>';
    });
}

// APPELER CHAQUE PAGE
function initPage(page) {
    switch (page) {
        case 'users/index':
            import('./pages/users.js').then(m => m.initUsers());
            break;

        case 'users/create':
            import('./pages/users.js').then(m => m.initUserCreate());
            break;
    }
}


document.addEventListener("DOMContentLoaded", () => {
    const burgerBtn = document.getElementById('burgerBtn');
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    const userProfile = document.getElementById('userProfile');
    const userDropdown = document.getElementById('userDropdown');

    
    sidebar.classList.add('resizeSidebar');
    burgerBtn.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        sidebar.classList.toggle('resizeSidebar');
        // overlay.classList.toggle('active');
    });

    // overlay.addEventListener('click', () => {
    //     sidebar.classList.remove('open');
    //     overlay.classList.remove('active');
    // });


    // Dropdown toggle
    // A DECOMMENTER PLUS TARD
    // userProfile.addEventListener('click', (e) => {
    //     e.stopPropagation();
    //     userDropdown.classList.toggle('hidden');
    // });

    // // Close dropdown on outside click
    // document.addEventListener('click', () => {
    //     userDropdown.classList.add('hidden');
    // });

    // Initial load
    loadPage("dashboard");
    
    document.querySelectorAll('.each_route').forEach(route => {
        route.addEventListener('click', (e) => {
           route.classList.remove('active'); 
        });
    });

    // CHARGEMENT DU CONTENU DYNAMIQUE DANS LE DASHBOARD ADMIN
    document.addEventListener('click', (e) => {
        const route = e.target.closest('.each_route');
        if (!route || !route.dataset.page) return;

        loadPage(route.dataset.page);

        // Verifier que each_route est dans le tableau ADMIN_SIDEBAR_ROUTES et qu'il est cliqué
        if (route && route.dataset.page) {
           route.classList.add('active'); 
        }
    });

    
    // GERER LES EVENEMENTS PRECEDENTS/SUIUVANTS DU NAVIGATEUR
    window.addEventListener('popstate', (event) => {
        // On récupère le nom de la page stocké dans l'objet 'state'
        if (event.state && event.state.pageName) {
            loadPage(event.state.pageName, false);
        } else {
            // Charger la page par défaut si pas d'état
            loadPage('dashboard', false);
        }
    });

    // document.addEventListener('DOMContentLoaded', () => {
    //     // On regarde si on a un hash dans l'URL (ex: #utilisateurs)
    //     const initialPage = window.location.hash.replace('#', '/') || 'dashboard';
        
    //     // On charge la page initiale
    //     loadPage(initialPage);
    // });


    

});