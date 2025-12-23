/**
 * adminDash.js - AVEC ÉDITION COMPLÈTE
 */

import { CrudManager } from './CrudManager.js';
import { api } from './api.js';

// ==================== FONCTION DE CHARGEMENT ====================

export function loadPage(page, pushToHistory = true) {
    console.log('Chargement de la page:', page);
    
    const [pagePath, queryString] = page.split('?');
    const params = new URLSearchParams(queryString || '');
    const table = params.get('table') || 'users';
    const id = params.get('id') || null;
    
    const fullUrl = queryString 
        ? `./views/admin/${pagePath}.php?${queryString}` 
        : `./views/admin/${pagePath}.php`;
    
    console.log('URL complète:', fullUrl);
    
    fetch(fullUrl)
        .then(res => {
            if (!res.ok) {
                throw new Error(`HTTP error! status: ${res.status}`);
            }
            return res.text();
        })
        .then(html => {
            console.log('HTML reçu, taille:', html.length);
            document.getElementById('mainContent').innerHTML = html;
            
            // Attendre que le DOM soit mis à jour
            setTimeout(() => {
                initPage(pagePath, table, id);
            }, 100);
        
            if (pushToHistory) {
                history.pushState({ pageName: page }, "", `#${page}`);
            }
        })
        .catch((error) => {
            console.error('Erreur de chargement:', error);
            document.getElementById('mainContent').innerHTML = `
                <div class="p-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <p class="text-red-600 font-semibold">Erreur de chargement</p>
                        <p class="text-red-500 text-sm mt-2">Page: ${page}</p>
                        <p class="text-red-500 text-sm">Erreur: ${error.message}</p>
                        <button 
                            onclick="loadPage('dashboard')" 
                            class="mt-4 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                        >
                            Retour au dashboard
                        </button>
                    </div>
                </div>
            `;
        });
}

// ==================== INITIALISATION DES PAGES ====================

function initPage(pagePath, table, id = null) {
    console.log('Initialisation:', pagePath, 'pour table:', table, 'ID:', id);
    
    const crudTables = [
        'users', 'airports', 'airlines', 'flights', 'hotels', 
        'rooms', 'activities', 'reservations', 'transactions', 
        'payments', 'reviews', 'images'
    ];

    if (pagePath.startsWith('crud/') && crudTables.includes(table)) {
        const action = pagePath.split('/')[1];
        console.log('Action CRUD:', action);
        
        try {
            const manager = new CrudManager(table);
            console.log('CrudManager créé pour:', table);

            switch (action) {
                case 'index':
                    console.log('Affichage de la liste');
                    manager.renderList('tableBody');
                    manager.setupSearch('searchInput', 'tableBody');
                    break;

                case 'create':
                    console.log('Mode création - Génération du formulaire');
                    handleFormPage(manager, false, null);
                    break;

                case 'edit':
                    console.log(' Mode édition - ID:', id);
                    if (!id) {
                        alert('Erreur : ID manquant pour l\'édition');
                        return;
                    }
                    handleFormPage(manager, true, id);
                    break;
                case 'show':
                    console.log('Mode affichage - ID:', id);
                    if (!id) {
                        alert('Erreur : ID manquant pour l\'affichage');
                        return;
                    }
                    
                    const formContainer = document.getElementById('detailsContainer');
                    if (!formContainer) {
                        console.error('Element #detailsContainer introuvable !');
                        return;
                    }
                    
                    // Afficher les détails
                    manager.renderShow('detailsContainer', id);
                    break;
                default:
                    console.warn('Action CRUD inconnue:', action);
            }
        } catch (error) {
            console.error('Erreur dans initPage:', error);
            alert('Erreur: ' + error.message);
        }
    }
    else if (pagePath === 'dashboard') {
        console.log('Initialisation du dashboard');
        initDashboard();
    }
    else {
        console.log('Page standard:', pagePath);
    }
}

/**
 * Gère l'affichage du formulaire (création OU édition)
 */
async function handleFormPage(manager, isEdit, itemId) {
    const formContainer = document.getElementById('formContainer');
    if (!formContainer) {
        console.error('Element #formContainer introuvable !');
        return;
    }
    
    try {
        // 1. Charger les clés étrangères
        console.log('Chargement des clés étrangères...');
        await manager.loadAllForeignKeys();
        console.log('Clés étrangères chargées');
        
        // 2. Si édition, charger les données existantes
        let itemData = null;
        if (isEdit) {
            console.log('Chargement des données de l\'élément ID:', itemId);
            itemData = await manager.getItemById(itemId);
            console.log('Données chargées:', itemData);
        }
        
        // 3. Générer le formulaire
        const formHtml = manager.generateForm(itemData);
        console.log('Formulaire généré, taille:', formHtml.length);
        
        // 4. Injecter dans le DOM
        formContainer.innerHTML = formHtml;
        console.log('Formulaire injecté dans le DOM');
        
        // 5. Mettre à jour le titre
        const titleElement = document.getElementById('pageTitle');
        if (titleElement) {
            titleElement.textContent = `${isEdit ? 'Modifier' : 'Ajouter'} ${manager.config.title}`;
        }
        
        // 6. Attacher les événements
        const form = document.getElementById('crudForm');
        if (form) {
            console.log('Formulaire trouvé, attachement des événements');
            attachFormEvents(manager, form, isEdit, itemId);
        } else {
            console.error('Formulaire #crudForm introuvable après injection !');
        }
        
    } catch (error) {
        console.error('Erreur lors du chargement du formulaire:', error);
        formContainer.innerHTML = `
            <div class="text-red-500 p-4">
                Erreur lors du chargement du formulaire: ${error.message}
            </div>
        `;
    }
}

/**
 * Attache les événements au formulaire
 */
function attachFormEvents(manager, form, isEdit, itemId) {
    console.log('Attachement des événements au formulaire');
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        console.log('Soumission du formulaire');

        // Réinitialiser les erreurs
        document.querySelectorAll('.error-message').forEach(div => {
            div.textContent = '';
        });
        document.querySelectorAll('.form-input').forEach(input => {
            input.classList.remove('border-red-500');
        });

        // Récupérer les données
        const formData = new FormData(form);
        
        console.log('Données du formulaire (FormData)');
        for (let [key, value] of formData.entries()) {
            if (value instanceof File) {
                console.log(`  ${key}: [Fichier] ${value.name} (${value.size} bytes)`);
            } else {
                console.log(`  ${key}: ${value}`);
            }
        }

        try {
            let response;
            
            if (isEdit) {
                console.log('Mise à jour de l\'élément', itemId);
                response = await api.put(manager.tableName, itemId, formData);
            } else {
                console.log('Création d\'un nouvel élément');
                response = await api.post(manager.tableName, formData);
            }

            console.log('Réponse reçue:', response);

            // Gestion des erreurs de validation
            if (response.errors) {
                console.warn('Erreurs de validation:', response.errors);
                
                for (const [field, messages] of Object.entries(response.errors)) {
                    const errorDiv = document.querySelector(`.error-message[data-field="${field}"]`);
                    const input = form.querySelector(`[name="${field}"]`);

                    if (errorDiv) {
                        errorDiv.textContent = Array.isArray(messages) ? messages.join(', ') : messages;
                    }

                    if (input) {
                        input.classList.add('border-red-500');
                    }
                }
                return;
            }

            // Succès
            console.log('Succès !');
            alert(`${manager.config.singular} ${isEdit ? 'modifié' : 'créé'} avec succès !`);
            loadPage(`crud/index?table=${manager.tableName}`);

        } catch (error) {
            console.error('Erreur serveur:', error);
            alert('Une erreur est survenue: ' + error.message);
        }
    });
}

/**
 * Initialise le dashboard principal
 */
function initDashboard() {
    console.log('Dashboard initialisé');
}

// ==================== ÉVÉNEMENTS GLOBAUX ====================

document.addEventListener("DOMContentLoaded", () => {
    console.log('DOM chargé, initialisation...');
    
    // Gestion du menu burger
    const burgerBtn = document.getElementById('burgerBtn');
    const sidebar = document.getElementById('adminSidebar');
    
    if (burgerBtn && sidebar) {
        sidebar.classList.add('resizeSidebar');
        burgerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            sidebar.classList.toggle('resizeSidebar');
        });
    }

    // Chargement initial
    const initialHash = window.location.hash.replace('#', '') || 'dashboard';
    console.log('Chargement initial:', initialHash);
    loadPage(initialHash, false);

    // Navigation dynamique
    document.addEventListener('click', (e) => {
        const route = e.target.closest('.each_route');
        if (!route || !route.dataset.page) return;

        e.preventDefault();
        loadPage(route.dataset.page);

        document.querySelectorAll('.each_route').forEach(r => r.classList.remove('active'));
        route.classList.add('active');
    });

    // Gestion de l'historique
    window.addEventListener('popstate', (event) => {
        if (event.state && event.state.pageName) {
            loadPage(event.state.pageName, false);
        } else {
            loadPage('dashboard', false);
        }
    });
});

// Rendre loadPage accessible globalement
window.loadPage = loadPage;