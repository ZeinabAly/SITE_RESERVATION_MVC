<!-- Template générique pour afficher la liste d'une table -->
<!-- Place ce fichier dans : views/admin/crud/index.php -->

<?php
// Récupérer le nom de la table depuis l'URL
$table = $_GET['table'] ?? 'users';
?>

<div class="crud-page p-6" id="crudPage" data-table="<?= htmlspecialchars($table) ?>">
    <div class="table-container bg-white rounded-lg shadow">
        
        <!-- En-tête avec titre et actions -->
        <div class="table-header flex justify-between items-center p-4 border-b">
            <h2 class="table-title text-2xl font-semibold" id="pageTitle">
                Chargement...
            </h2>
            
            <div class="flex gap-3">
                <!-- Champ de recherche -->
                <input 
                    type="search" 
                    id="searchInput" 
                    placeholder="Rechercher..." 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                
                <!-- Bouton d'ajout -->
                <a 
                    href="#crud/create?table=<?= htmlspecialchars($table) ?>" 
                    class="btn-add each_route flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                    data-page="crud/create?table=<?= htmlspecialchars($table) ?>"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Ajouter
                </a>
            </div>
        </div>

        <!-- Tableau des données -->
        <div class="table-wrapper overflow-x-auto">
            <table class="main-table w-full">
                <thead class="bg-gray-50" id="tableHead">
                    <!-- Les en-têtes seront injectés par JavaScript -->
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200">
                    <!-- Les lignes seront injectées par JavaScript -->
                    <tr>
                        <td colspan="100%" class="text-center py-8 text-gray-400">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                                </svg>
                                <p>Chargement des données...</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
/* Styles pour le tableau */
.table-container {
    margin-top: 0;
}

.main-table th {
    padding: 12px 16px;
    text-align: left;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.main-table td {
    padding: 12px 16px;
    color: #1f2937;
}

.main-table tbody tr:hover {
    background-color: #f9fafb;
}

/* Boutons d'action */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: flex-end;
}

.btn-icon {
    padding: 6px;
    border: none;
    background: transparent;
    cursor: pointer;
    border-radius: 4px;
    transition: all 0.2s;
}

.btn-icon svg {
    width: 20px;
    height: 20px;
}

.btn-icon.view {
    color: #3b82f6;
}

.btn-icon.view:hover {
    background: #eff6ff;
}

.btn-icon.edit {
    color: #10b981;
}

.btn-icon.edit:hover {
    background: #d1fae5;
}

.btn-icon.delete {
    color: #ef4444;
}

.btn-icon.delete:hover {
    background: #fee2e2;
}
</style>
