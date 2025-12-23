import { api } from './api.js';
import { tablesConfig } from './config/tablesConfig.js';

export class CrudManager {
    constructor(tableName) {
        this.tableName = tableName;
        this.config = tablesConfig[tableName];
        this.foreignData = {};
        
        if (!this.config) {
            throw new Error(`Table "${tableName}" non configurée dans tablesConfig.js`);
        }
        
        console.log(`CrudManager initialisé pour: ${tableName}`);
    }

    // Charger un élément par son ID
    async getItemById(id) {
        try {
            console.log(`Récupération de l'élément ID ${id} de la table ${this.tableName}`);
            
            // Récupérer tous les éléments
            const allItems = await api.get(this.tableName);
            
            // Trouver celui qui correspond à l'ID
            const item = allItems.find(item => item.id == id);
            
            if (!item) {
                throw new Error(`Élément avec ID ${id} introuvable`);
            }
            
            console.log(`Élément trouvé:`, item);
            return item;
            
        } catch (error) {
            console.error(`Erreur lors de la récupération de l'élément:`, error);
            throw error;
        }
    }

    // ==================== AFFICHAGE DE LA LISTE ====================
    
    async renderList(tableBodyId) {
        try {
            console.log(`Chargement de la liste ${this.tableName}...`);
            const data = await api.get(this.tableName);
            console.log(`${data.length} éléments chargés`);
            
            await this.loadAllForeignKeys();
            this.updatePageTitle();
            this.renderTableHeaders();
            
            const tbody = document.getElementById(tableBodyId);
            if (!tbody) {
                console.error(`Element #${tableBodyId} introuvable`);
                return;
            }

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="100%" class="text-center py-8 text-gray-500">
                            Aucune donnée disponible
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = data.map(item => this.renderTableRow(item)).join('');
            this.attachListEvents(tableBodyId);
            
        } catch (error) {
            console.error('Erreur lors du chargement des données:', error);
            alert('Erreur lors du chargement des données');
        }
    }

    updatePageTitle() {
        const titleElement = document.getElementById('pageTitle');
        if (titleElement) {
            titleElement.innerHTML = this.config.icon + ' ' + this.config.name;
        }
    }

    renderTableHeaders() {
        const thead = document.getElementById('tableHead');
        if (!thead) return;

        const headers = this.config.displayColumns.map(colKey => {
            const column = this.config.columns.find(col => col.key === colKey);
            return `<th class="px-4 py-3">${column?.label || colKey}</th>`;
        }).join('');

        thead.innerHTML = `
            <tr>
                ${headers}
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        `;
    }

    renderTableRow(item) {
        const cells = this.config.displayColumns
            .map(colKey => `<td class="px-4 py-3">${this.formatCell(item, colKey)}</td>`)
            .join('');

        return `
            <tr data-id="${item.id}" class="hover:bg-gray-50">
                ${cells}
                <td class="px-4 py-3">
                    <div class="action-buttons">
                        <button class="btn-icon view-item" data-id="${item.id}" title="Voir">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        <button class="btn-icon edit-item" data-id="${item.id}" title="Modifier">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <button class="btn-icon delete-item" data-id="${item.id}" title="Supprimer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    }

    formatCell(item, columnKey) {
        const column = this.config.columns.find(col => col.key === columnKey);
        let value = item[columnKey];

        if (value === null || value === undefined || value === '') {
            return '<span class="text-gray-400">-</span>';
        }

        if (column?.foreignKey) {
            const foreignItem = this.foreignData[column.foreignKey]?.find(
                fItem => fItem.id == value
            );
            return foreignItem?.[column.displayKey] || value;
        }

        switch (column?.type) {
            case 'number':
                if (columnKey.includes('price') || columnKey.includes('amount')) {
                    return parseFloat(value).toFixed(2) + ' €';
                }
                return value;

            case 'datetime-local':
                return new Date(value).toLocaleString('fr-FR', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

            case 'date':
                return new Date(value).toLocaleDateString('fr-FR');

            case 'select':
                const translations = {
                    'pending': 'En attente',
                    'paid': 'Payé',
                    'cancelled': 'Annulé',
                    'success': 'Succès',
                    'failed': 'Échoué',
                    'user': 'Utilisateur',
                    'admin': 'Administrateur',
                    'single': 'Simple',
                    'double': 'Double',
                    'suite': 'Suite',
                };
                return translations[value] || value;

            default:
                if (typeof value === 'string' && value.length > 50) {
                    return value.substring(0, 50) + '...';
                }
                return value;
        }
    }

    async loadAllForeignKeys() {
        console.log('Chargement des clés étrangères...');
        const foreignKeys = this.config.columns
            .filter(col => col.foreignKey)
            .map(col => col.foreignKey);

        const uniqueForeignKeys = [...new Set(foreignKeys)];

        for (const foreignKey of uniqueForeignKeys) {
            try {
                this.foreignData[foreignKey] = await api.get(foreignKey);
                console.log(`${foreignKey}: ${this.foreignData[foreignKey].length} éléments`);
            } catch (error) {
                console.error(`Erreur lors du chargement de ${foreignKey}:`, error);
                this.foreignData[foreignKey] = [];
            }
        }
    }

    attachListEvents(tableBodyId) {
        const tbody = document.getElementById(tableBodyId);
        if (!tbody) return;

        tbody.querySelectorAll('.delete-item').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                const id = e.currentTarget.dataset.id;
                if (!confirm(`Voulez-vous vraiment supprimer cet élément ?`)) return;

                try {
                    await api.delete(this.tableName, id);
                    alert('Élément supprimé avec succès');
                    this.renderList(tableBodyId);
                } catch (error) {
                    console.error('Erreur lors de la suppression:', error);
                    alert('Erreur lors de la suppression');
                }
            });
        });

        tbody.querySelectorAll('.edit-item').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = e.currentTarget.dataset.id;
                window.loadPage(`crud/edit?table=${this.tableName}&id=${id}`);
            });
        });

        tbody.querySelectorAll('.view-item').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = e.currentTarget.dataset.id;
                window.loadPage(`crud/show?table=${this.tableName}&id=${id}`);
            });
        });
    }

    // ==================== GÉNÉRATION DE FORMULAIRE ====================

    generateForm(data = null) {
        console.log('Génération du formulaire...', data ? 'avec données' : 'vide');
        const isEdit = !!data;
        
        const formColumns = this.config.columns.filter(col => {
            if (col.key === 'id') return false;
            if (isEdit && col.skipInUpdate) return false;
            return true;
        });

        const formFields = formColumns.map(col => 
            this.generateFormField(col, data?.[col.key])
        ).join('');

        return `
            <form id="crudForm" class="styled-form" enctype="multipart/form-data">
                <div class="form-grid">
                    ${formFields}
                </div>
                
                <div class="form-actions mt-6">
                    <button type="submit" class="btn-primary">
                        ${isEdit ? 'Mettre à jour' : 'Créer'}
                    </button>
                    <button type="button" onclick="history.back()" class="btn-secondary">
                        Annuler
                    </button>
                </div>
            </form>
        `;
    }

    generateFormField(column, value = '') {
        const { 
            key, label, type, required, options, accept, 
            min, max, step, placeholder, maxlength, rows,
            foreignKey, displayKey
        } = column;
        
        let input = '';
        
        switch (type) {
            case 'textarea':
                input = `<textarea 
                    name="${key}" 
                    id="${key}" 
                    rows="${rows || 4}"
                    placeholder="${placeholder || ''}"
                    ${required ? 'required' : ''}
                    class="form-input"
                >${value || ''}</textarea>`;
                break;
                
            case 'select':
                if (options) {
                    input = `
                        <select name="${key}" id="${key}" ${required ? 'required' : ''} class="form-input">
                            <option value="">-- Choisir --</option>
                            ${options.map(opt => 
                                `<option value="${opt}" ${value === opt || opt === column.default ? 'selected' : ''}>${opt}</option>`
                            ).join('')}
                        </select>
                    `;
                } else if (foreignKey) {
                    const foreignItems = this.foreignData[foreignKey] || [];
                    input = `
                        <select name="${key}" id="${key}" ${required ? 'required' : ''} class="form-input">
                            <option value="">-- Choisir --</option>
                            ${foreignItems.map(item => 
                                `<option value="${item.id}" ${value == item.id ? 'selected' : ''}>
                                    ${item[displayKey] || item.name || item.id}
                                </option>`
                            ).join('')}
                        </select>
                    `;
                }
                break;
                
            case 'file':
                input = `
                    <input 
                        type="file" 
                        name="${key}" 
                        id="${key}" 
                        accept="${accept || '*'}"
                        class="form-input"
                    />
                    ${value ? `<p class="text-sm text-gray-500 mt-1">Fichier actuel : ${value}</p>` : ''}
                `;
                break;
                
            case 'password':
                // En édition, ne pas afficher la valeur du mot de passe
                input = `<input 
                    type="${type}" 
                    name="${key}" 
                    id="${key}" 
                    placeholder="${placeholder || ''}"
                    ${!value && required ? 'required' : ''}
                    ${min !== undefined ? `min="${min}"` : ''}
                    ${max !== undefined ? `max="${max}"` : ''}
                    ${step !== undefined ? `step="${step}"` : ''}
                    ${maxlength !== undefined ? `maxlength="${maxlength}"` : ''}
                    class="form-input"
                />`;
                break;
                
            default:
                input = `<input 
                    type="${type}" 
                    name="${key}" 
                    id="${key}" 
                    value="${value || ''}"
                    placeholder="${placeholder || ''}"
                    ${required ? 'required' : ''}
                    ${min !== undefined ? `min="${min}"` : ''}
                    ${max !== undefined ? `max="${max}"` : ''}
                    ${step !== undefined ? `step="${step}"` : ''}
                    ${maxlength !== undefined ? `maxlength="${maxlength}"` : ''}
                    class="form-input"
                />`;
        }

        return `
            <div class="form-group">
                <label for="${key}" class="form-label">
                    ${label} ${required ? '<span class="text-red-500">*</span>' : ''}
                </label>
                ${input}
                <div class="error-message text-red-500 text-sm mt-1" data-field="${key}"></div>
            </div>
        `;
    }

    // ==================== RECHERCHE ====================

    async setupSearch(searchInputId, tableBodyId) {
        const searchInput = document.getElementById(searchInputId);
        if (!searchInput) return;

        let allData = await api.get(this.tableName);
        await this.loadAllForeignKeys();

        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();

            if (!query) {
                this.renderFilteredList(tableBodyId, allData);
                return;
            }

            const filtered = allData.filter(item => {
                return this.config.searchableColumns.some(col => {
                    const value = String(item[col] || '').toLowerCase();
                    return value.includes(query);
                });
            });

            this.renderFilteredList(tableBodyId, filtered);
        });
    }

    renderFilteredList(tableBodyId, data) {
        const tbody = document.getElementById(tableBodyId);
        if (!tbody) return;

        if (data.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="100%" class="text-center py-8 text-gray-500">
                        Aucun résultat trouvé
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = data.map(item => this.renderTableRow(item)).join('');
        this.attachListEvents(tableBodyId);
    }

    // ///////////////////  POUR VIEWPAGE ///////////

    /**
     * Affiche les détails d'un élément
     * @param {string} containerId - ID du conteneur où afficher les détails
     * @param {number} itemId - ID de l'élément à afficher
     */
    async renderShow(containerId, itemId) {
        try {
            console.log(`Affichage des détails de l'élément ID ${itemId}`);
            
            // 1. Charger les données de l'élément
            const item = await this.getItemById(itemId);
            console.log('Données chargées:', item);
            
            // 2. Charger les clés étrangères
            await this.loadAllForeignKeys();
            
            // 3. Mettre à jour le titre
            const titleElement = document.getElementById('pageTitle');
            if (titleElement) {
                titleElement.textContent = `Détails `;
            }
            
            // 4. Générer le HTML des détails
            const detailsHtml = this.generateDetailsHtml(item);
            
            // 5. Injecter dans le DOM
            const container = document.getElementById(containerId);
            if (container) {
                container.innerHTML = detailsHtml;
                console.log('Détails affichés');
            }
            
            // 6. Attacher l'événement au bouton Modifier
            const btnEdit = document.getElementById('btnEdit');
            if (btnEdit) {
                btnEdit.addEventListener('click', () => {
                    window.loadPage(`crud/edit?table=${this.tableName}&id=${itemId}`);
                });
            }
            
        } catch (error) {
            console.error('Erreur lors de l\'affichage des détails:', error);
            const container = document.getElementById(containerId);
            if (container) {
                container.innerHTML = `
                    <div class="p-6 text-red-500">
                        <p class="font-semibold">Erreur lors du chargement</p>
                        <p class="text-sm mt-2">${error.message}</p>
                    </div>
                `;
            }
        }
    }

    /**
     * Génère le HTML pour afficher les détails
     * @param {Object} item - L'objet contenant les données
     * @returns {string} HTML des détails
     */
    generateDetailsHtml(item) {
        // Grouper les colonnes par sections (optionnel)
        const sections = this.groupColumnsBySections();
        
        let html = '';
        
        sections.forEach(section => {
            html += `<div class="detail-section">`;
            
            if (section.title) {
                html += `<h2 class="detail-section-title">${section.title}</h2>`;
            }
            
            html += `<div class="detail-grid">`;
            
            section.columns.forEach(column => {
                // Ignorer l'ID et les champs cachés
                if (column.key === 'id' || column.hideInShow) return;
                
                const value = item[column.key];
                const formattedValue = this.formatDetailValue(column, value);
                
                html += `
                    <div class="detail-item">
                        <label class="detail-label">${column.label}</label>
                        <div class="detail-value ${!value && value !== 0 ? 'empty' : ''}">
                            ${formattedValue}
                        </div>
                    </div>
                `;
            });
            
            html += `</div></div>`;
        });
        
        return html;
    }

    /**
     * Formate une valeur pour l'affichage dans les détails
     * @param {Object} column - Configuration de la colonne
     * @param {*} value - Valeur à formater
     * @returns {string} Valeur formatée en HTML
     */
    formatDetailValue(column, value) {
        // Valeur vide
        if (value === null || value === undefined || value === '') {
            return '<span class="text-gray-400 italic">Non renseigné</span>';
        }
        
        // Mot de passe (ne jamais afficher)
        if (column.type === 'password') {
            return '<span class="text-gray-400">••••••••</span>';
        }
        
        // Image
        if (column.type === 'file' && column.accept?.includes('image')) {
            return `<img src="${value}" alt="${column.label}" class="rounded-lg" onerror="this.src='assets/img/default-avatar.png'" />`;
        }
        
        // Fichier (autre que image)
        if (column.type === 'file') {
            return `<a href="${value}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Télécharger
            </a>`;
        }
        
        // Clé étrangère
        if (column.foreignKey) {
            const foreignItem = this.foreignData[column.foreignKey]?.find(
                fItem => fItem.id == value
            );
            return foreignItem?.[column.displayKey] || value;
        }
        
        // Select avec badge coloré pour les statuts
        if (column.type === 'select') {
            const badges = {
                'pending': { class: 'badge-warning', text: 'En attente' },
                'paid': { class: 'badge-success', text: 'Payé' },
                'success': { class: 'badge-success', text: 'Succès' },
                'cancelled': { class: 'badge-danger', text: 'Annulé' },
                'failed': { class: 'badge-danger', text: 'Échoué' },
                'user': { class: 'badge-info', text: 'Utilisateur' },
                'admin': { class: 'badge-danger', text: 'Administrateur' },
                'single': { class: 'badge-info', text: 'Simple' },
                'double': { class: 'badge-info', text: 'Double' },
                'suite': { class: 'badge-success', text: 'Suite' },
            };
            
            const badge = badges[value];
            if (badge) {
                return `<span class="badge ${badge.class}">${badge.text}</span>`;
            }
            return value;
        }
        
        // Prix / Montant
        if (column.key.includes('price') || column.key.includes('amount')) {
            return `<strong>${parseFloat(value).toFixed(2)} €</strong>`;
        }
        
        // Date et heure
        if (column.type === 'datetime-local') {
            return new Date(value).toLocaleString('fr-FR', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }
        
        // Date
        if (column.type === 'date') {
            return new Date(value).toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });
        }
        
        // Textarea (préserver les retours à la ligne)
        if (column.type === 'textarea') {
            return value.replace(/\n/g, '<br>');
        }
        
        // Email
        if (column.type === 'email') {
            return `<a href="mailto:${value}" class="text-blue-600 hover:underline">${value}</a>`;
        }
        
        // Téléphone
        if (column.type === 'tel') {
            return `<a href="tel:${value}" class="text-blue-600 hover:underline">${value}</a>`;
        }
        
        // URL
        if (column.type === 'url') {
            return `<a href="${value}" target="_blank" class="text-blue-600 hover:underline">${value}</a>`;
        }
        
        // Valeur par défaut
        return value;
    }

    /**
     * Groupe les colonnes par sections (optionnel, pour organiser l'affichage)
     * @returns {Array} Tableau de sections
     */
    groupColumnsBySections() {
        // Par défaut, tout dans une seule section
        // Tu peux personnaliser pour chaque table dans tablesConfig
        
        if (this.config.sections) {
            // Si des sections sont définies dans la config
            return this.config.sections.map(section => ({
                title: section.title,
                columns: section.columns.map(key => 
                    this.config.columns.find(col => col.key === key)
                ).filter(Boolean)
            }));
        }
        
        // Sinon, grouper automatiquement par type de champ
        const infoColumns = [];
        const detailColumns = [];
        
        this.config.columns.forEach(col => {
            if (col.key === 'id') return;
            
            if (['name', 'email', 'phone', 'role', 'status'].includes(col.key)) {
                infoColumns.push(col);
            } else {
                detailColumns.push(col);
            }
        });
        
        const sections = [];
        
        if (infoColumns.length > 0) {
            sections.push({
                title: 'Informations principales',
                columns: infoColumns
            });
        }
        
        if (detailColumns.length > 0) {
            sections.push({
                title: 'Détails',
                columns: detailColumns
            });
        }
        
        return sections;
    }
}