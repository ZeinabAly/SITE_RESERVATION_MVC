import { api } from '../api.js';
import { loadPage } from '../adminDash.js';


export function initUsers() {
    const root = document.getElementById('usersPage');
    if (!root) return;

    loadUsers();
    handleActions();
}

async function loadUsers() {
    const users = await api.get('users');
    renderUsers(users);
}

function renderUsers(users) {
    const tbody = document.getElementById('usersTableBody');
    if (!tbody) return;

    tbody.innerHTML = users.map(user => `
        <tr>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>
                <div class="action-buttons">
                <button class="btn-icon view" title="Voir">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </button>
                <button class="btn-icon edit" title="Modifier">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </button>
                <button class="btn-icon delete delete-user" title="Supprimer" data-id="${user.id}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
                </div>
            </td>
        </tr>
    `).join('');
}


function handleActions() {
    document.addEventListener('click', e => {
        if (!e.target.classList.contains('delete-user')) return;

        const id = e.target.dataset.id;
        if (!confirm('Supprimer ?')) return;

        api.delete('users', id).then(loadUsers);
    });
}


export function initUserCreate() {
    const avatarInput = document.getElementById('avatarInput');
    const imagePreview = document.getElementById('imagePreview');
 
    // --- LOGIQUE APERÇU IMAGE ---
    avatarInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    const form = document.getElementById('createUserForm');
    if (!form) return;

    form.addEventListener('submit', async e => {
        e.preventDefault();

        // Reset erreurs
        document.querySelectorAll('.error-message').forEach(div => div.innerText = '');
        document.querySelectorAll('input').forEach(input => input.classList.remove('is-invalid'));

        // FormData -> Object
        const data = Object.fromEntries(new FormData(form));

        try {
            const response = await api.post('users', data);

            // ERREURS DE VALIDATION
            if (response.errors) {
                for (const [field, messages] of Object.entries(response.errors)) {

                    // div erreur
                    const errorDiv = document.querySelector(
                        `.error-message[data-field="${field}"]`
                    );

                    // input correspondant
                    const input = form.querySelector(`[name="${field}"]`);

                    if (errorDiv) {
                        errorDiv.innerText = messages.join(', ');
                    }

                    if (input) {
                        input.classList.add('is-invalid');
                    }
                }
                return;
            }

            // SUCCÈS
            alert('Utilisateur créé avec succès');
            // loadPage('users/index');

        } catch (error) {
            console.error('Erreur serveur', error);
            alert('Erreur serveur');
        }
    });

}

