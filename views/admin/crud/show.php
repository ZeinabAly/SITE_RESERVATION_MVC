<!-- Template générique pour afficher les détails d'un élément -->
<!-- Place ce fichier dans : views/admin/crud/show.php -->

<?php
$table = $_GET['table'] ?? 'users';
$id = $_GET['id'] ?? null;

if (!$id) {
    echo '<div class="p-6 text-red-500">Erreur : ID manquant</div>';
    exit;
}
?>

<div class="crud-show-page p-6" data-table="<?= htmlspecialchars($table) ?>" data-id="<?= htmlspecialchars($id) ?>">
    
    <!-- En-tête -->
    <header class="page-header flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold" id="pageTitle">
            Chargement...
        </h1>
        <div class="flex gap-2">
            <button 
                type="button" 
                id="btnEdit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Modifier
            </button>
            <button 
                type="button" 
                onclick="history.back()" 
                class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center gap-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour
            </button>
        </div>
    </header>

    <!-- Conteneur des détails -->
    <div class="bg-white rounded-lg shadow">
        <div id="detailsContainer">
            <!-- Les détails seront injectés ici par JavaScript -->
            <div class="flex justify-center items-center py-12">
                <div class="text-center">
                    <svg class="animate-spin h-10 w-10 text-blue-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="text-gray-500">Chargement des détails...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Styles pour la page de détails */
.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    padding: 1.5rem;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.detail-label {
    font-weight: 600;
    color: #6b7280;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.detail-value {
    color: #1f2937;
    font-size: 1rem;
    padding: 0.75rem;
    background-color: #f9fafb;
    border-radius: 0.375rem;
    border: 1px solid #e5e7eb;
    min-height: 2.5rem;
    display: flex;
    align-items: center;
}

.detail-value.empty {
    color: #9ca3af;
    font-style: italic;
}

.detail-value img {
    max-width: 200px;
    max-height: 200px;
    border-radius: 0.5rem;
    border: 2px solid #e5e7eb;
}

.detail-section {
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 1rem;
    margin-bottom: 1rem;
}

.detail-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.detail-section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1rem;
    padding: 1rem 1.5rem;
    background: linear-gradient(to right, #f3f4f6, transparent);
    border-left: 4px solid #3b82f6;
}

.badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.badge-success {
    background-color: #d1fae5;
    color: #065f46;
}

.badge-warning {
    background-color: #fef3c7;
    color: #92400e;
}

.badge-danger {
    background-color: #fee2e2;
    color: #991b1b;
}

.badge-info {
    background-color: #dbeafe;
    color: #1e40af;
}
</style>