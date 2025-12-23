<!-- Template générique pour créer un élément -->
<!-- Place ce fichier dans : views/admin/crud/create.php -->

<?php
$table = $_GET['table'] ?? 'users';
?>

<div class="crud-create-page p-6" data-table="<?= htmlspecialchars($table) ?>">
    
    <!-- En-tête -->
    <header class="page-header flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold" id="pageTitle">
            Chargement...
        </h1>
        <button 
            type="button" 
            onclick="history.back()" 
            class="btn-secondary px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center gap-2"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour
        </button>
    </header>

    <!-- Conteneur du formulaire (sera rempli par JavaScript) -->
    <div class="bg-white rounded-lg shadow p-6">
        <div id="formContainer">
            <!-- Le formulaire sera généré dynamiquement par CrudManager.js -->
            <div class="flex justify-center items-center py-12">
                <div class="text-center">
                    <svg class="animate-spin h-10 w-10 text-blue-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="text-gray-500">Chargement du formulaire...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styles pour le formulaire */
    .styled-form {
        width: 100%;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        font-size: 0.875rem;
    }

    .form-input {
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        ring: 2px;
        ring-color: rgba(59, 130, 246, 0.2);
    }

    .form-input.border-red-500 {
        border-color: #ef4444;
    }

    .form-input.border-red-500:focus {
        ring-color: rgba(239, 68, 68, 0.2);
    }

    textarea.form-input {
        resize: vertical;
        min-height: 100px;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-start;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }

    .btn-primary {
        padding: 0.625rem 1.5rem;
        background-color: #3b82f6;
        color: white;
        border: none;
        border-radius: 0.375rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
        padding: 0.625rem 1.5rem;
        background-color: white;
        color: #374151;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-secondary:hover {
        background-color: #f9fafb;
    }

    .error-message {
        font-size: 0.75rem;
        color: #ef4444;
        min-height: 1rem;
    }

    /* Style pour les selects */
    select.form-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }

    /* Style pour les inputs file */
    input[type="file"].form-input {
        padding: 0.5rem;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    // Créer ou mettre à jour l'aperçu
                    let preview = document.getElementById('imagePreview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.id = 'imagePreview';
                        preview.className = 'mt-2 rounded-lg max-w-xs';
                        imageInput.parentElement.appendChild(preview);
                    }
                    preview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>