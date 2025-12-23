// Configuration de toutes les tables du dashboard admin
// Ajoute simplement une nouvelle entrée ici pour créer une nouvelle section CRUD

export const tablesConfig = {
    // ==================== UTILISATEURS ====================
    users: {
        name: 'Utilisateurs',
        title: 'un Utilisateur',
        icon: "<i class='fa-solid fa-user'></i>",
        
        columns: [
            { key: 'name', label: 'Nom complet', type: 'text', required: true, placeholder: 'Ex: Jean Dupont' },
            { key: 'email', label: 'Email', type: 'email', required: true, placeholder: 'jean@exemple.com' },
            { key: 'phone', label: 'Téléphone', type: 'tel', required: true, placeholder: '9 chiffres', maxlength: 9 },
            { key: 'password', label: 'Mot de passe', type: 'password', required: true, hideInList: true, minlength: 6 },
            { key: 'password_confirm', label: 'Confirmer mot de passe', type: 'password', required: true, hideInList: true, skipInUpdate: true },
            { key: 'role', label: 'Rôle', type: 'select', options: ['user', 'admin'], default: 'user' },
            { key: 'image', label: 'Photo de profil', type: 'file', accept: 'image/*', hideInList: true }
        ],
        
        displayColumns: ['name', 'email', 'phone', 'role'],
        searchableColumns: ['name', 'email', 'phone'],
    },

    // ==================== AÉROPORTS ====================
    airports: {
        name: 'Aéroports',
        title: 'Aéroport',
        icon: "<i class='fa-solid fa-plane-departure'></i>",
        
        columns: [
            { key: 'code', label: 'Code IATA', type: 'text', required: true, placeholder: 'Ex: CDG', maxlength: 10 },
            { key: 'name', label: 'Nom', type: 'text', required: true, placeholder: 'Charles de Gaulle' },
            { key: 'city', label: 'Ville', type: 'text', required: true, placeholder: 'Paris' },
            { key: 'country', label: 'Pays', type: 'text', required: true, placeholder: 'France' }
        ],
        
        displayColumns: ['code', 'name', 'city', 'country'],
        searchableColumns: ['code', 'name', 'city', 'country'],
    },

    // ==================== COMPAGNIES AÉRIENNES ====================
    airlines: {
        name: 'Compagnies aériennes',
        title: 'une Compagnie',
        icon: "<i class='fa-solid fa-plane'></i>",
        
        columns: [
            { key: 'id', label: '#', type: 'number', readonly: true },
            { key: 'name', label: 'Nom', type: 'text', required: true, placeholder: 'Air France' },
            { key: 'code', label: 'Code IATA', type: 'text', required: true, placeholder: 'AF', maxlength: 10 },
            { key: 'country', label: 'Pays', type: 'text', placeholder: 'France' },
            { key: 'logo', label: 'Logo (URL)', type: 'text', placeholder: 'https://...', hideInList: true }
        ],
        
        displayColumns: ['name', 'code', 'country'],
        searchableColumns: ['name', 'code', 'country'],
    },

    // ==================== VOLS ====================
    flights: {
        name: 'Vols',
        title: 'un Vol',
        icon: "<i class='fa-solid fa-plane-up'></i>",
        
        columns: [
            { key: 'airline_id', label: 'Compagnie aérienne', type: 'select', required: true, foreignKey: 'airlines', displayKey: 'name' },
            { key: 'departure_airport_id', label: 'Aéroport de départ', type: 'select', required: true, foreignKey: 'airports', displayKey: 'name' },
            { key: 'arrival_airport_id', label: 'Aéroport d\'arrivée', type: 'select', required: true, foreignKey: 'airports', displayKey: 'name' },
            { key: 'departure_time', label: 'Date/heure de départ', type: 'datetime-local', required: true },
            { key: 'arrival_time', label: 'Date/heure d\'arrivée', type: 'datetime-local', required: true },
            { key: 'price', label: 'Prix (€)', type: 'number', step: '0.01', required: true, min: 0 }
        ],
        
        displayColumns: ['airline_id', 'departure_airport_id', 'arrival_airport_id', 'departure_time', 'price'],
        searchableColumns: ['price'],
    },

    // ==================== HÔTELS ====================
    hotels: {
        name: 'Hôtels',
        title: 'un Hôtel',
        icon: "<i class='fa-solid fa-hotel'></i>",
        
        columns: [
            { key: 'id', label: '#', type: 'number', readonly: true },
            { key: 'name', label: 'Nom', type: 'text', required: true, placeholder: 'Hôtel Luxe Paris' },
            { key: 'city', label: 'Ville', type: 'text', required: true, placeholder: 'Paris' },
            { key: 'address', label: 'Adresse', type: 'text', placeholder: '10 Rue de la Paix' },
            { key: 'stars', label: 'Étoiles', type: 'number', min: 0, max: 5, default: 3 },
            { key: 'description', label: 'Description', type: 'textarea', rows: 4, hideInList: true }
        ],
        
        displayColumns: ['name', 'city', 'stars'],
        searchableColumns: ['name', 'city'],
    },

    // ==================== CHAMBRES ====================
    rooms: {
        name: 'Chambres',
        title: 'une Chambre',
        icon: "<i class='fa-solid fa-bed'></i>",
        
        columns: [
            { key: 'hotel_id', label: 'Hôtel', type: 'select', required: true, foreignKey: 'hotels', displayKey: 'name' },
            { key: 'type', label: 'Type', type: 'select', options: ['single', 'double', 'suite'], required: true },
            { key: 'capacity', label: 'Capacité (personnes)', type: 'number', required: true, min: 1 },
            { key: 'price_by_night', label: 'Prix/nuit (€)', type: 'number', step: '0.01', required: true, min: 0 },
            { key: 'description', label: 'Description', type: 'textarea', rows: 3, hideInList: true }
        ],
        
        displayColumns: ['hotel_id', 'type', 'capacity', 'price_by_night'],
        searchableColumns: ['type'],
    },

    // ==================== ACTIVITÉS ====================
    activities: {
        name: 'Activités',
        title: 'une Activité',
        icon: "<i class='fa-solid fa-person-running'></i>",
        
        columns: [
            { key: 'name', label: 'Nom', type: 'text', required: true, placeholder: 'Visite guidée du Louvre' },
            { key: 'city', label: 'Ville', type: 'text', required: true, placeholder: 'Paris' },
            { key: 'type', label: 'Type', type: 'text', placeholder: 'Culture, Sport, Nature...' },
            { key: 'description', label: 'Description', type: 'textarea', rows: 4, hideInList: true },
            { key: 'price', label: 'Prix (€)', type: 'number', step: '0.01', required: true, min: 0 },
            { key: 'duration', label: 'Durée (minutes)', type: 'number', min: 0 }
        ],
        
        displayColumns: ['name', 'city', 'type', 'price'],
        searchableColumns: ['name', 'city', 'type'],
    },

    // ==================== RÉSERVATIONS ====================
    reservations: {
        name: 'Réservations',
        title: 'une Réservation',
        icon: "<i class='fa-solid fa-ticket'></i>",
        
        columns: [
            { key: 'user_id', label: 'Utilisateur', type: 'select', required: true, foreignKey: 'users', displayKey: 'name' },
            { key: 'type', label: 'Type', type: 'select', options: ['flight', 'room', 'activity'], required: true },
            { key: 'item_id', label: 'ID de l\'élément', type: 'number', required: true },
            { key: 'start_date', label: 'Date de début', type: 'date' },
            { key: 'end_date', label: 'Date de fin', type: 'date' },
            { key: 'total_price', label: 'Prix total (€)', type: 'number', step: '0.01', required: true, min: 0 },
            { key: 'status', label: 'Statut', type: 'select', options: ['pending', 'paid', 'cancelled'], default: 'pending' }
        ],
        
        displayColumns: ['user_id', 'type', 'start_date', 'total_price', 'status'],
        searchableColumns: ['type', 'status'],
    },

    // ==================== TRANSACTIONS ====================
    transactions: {
        name: 'Transactions',
        title: 'une Transaction',
        icon: "<i class='fa-solid fa-arrow-right-arrow-left'></i>",
        
        columns: [
            { key: 'reservation_id', label: 'Réservation', type: 'select', required: true, foreignKey: 'reservations', displayKey: 'id' },
            { key: 'amount', label: 'Montant', type: 'number', step: '0.01', required: true, min: 0 },
            { key: 'devise', label: 'Devise', type: 'text', required: true, placeholder: 'EUR', maxlength: 10 },
            { key: 'status', label: 'Statut', type: 'select', options: ['pending', 'success', 'failed'], default: 'pending' }
        ],
        
        displayColumns: ['reservation_id', 'amount', 'devise', 'status'],
        searchableColumns: ['devise', 'status'],
    },

    // ==================== PAIEMENTS ====================
    payments: {
        name: 'Paiements',
        title: 'un Paiement',
        icon: "<i class='fa-solid fa-credit-card'></i>",
        
        columns: [
            { key: 'transaction_id', label: 'Transaction', type: 'select', required: true, foreignKey: 'transactions', displayKey: 'id' },
            { key: 'provider', label: 'Fournisseur', type: 'text', required: true, placeholder: 'stripe, paypal, orange_money' },
            { key: 'provider_transaction_id', label: 'ID transaction fournisseur', type: 'text', placeholder: 'ch_1Q7fdJDzeGHZ90' }
        ],
        
        displayColumns: ['transaction_id', 'provider', 'provider_transaction_id'],
        searchableColumns: ['provider'],
    },

    // ==================== AVIS ====================
    reviews: {
        name: 'Avis',
        title: 'un Avis',
        icon: "<i class='fa-solid fa-star'></i>",
        
        columns: [
            { key: 'user_id', label: 'Utilisateur', type: 'select', required: true, foreignKey: 'users', displayKey: 'name' },
            { key: 'item_type', label: 'Type d\'élément', type: 'select', options: ['hotel', 'room', 'flight', 'airport', 'activity'], required: true },
            { key: 'item_id', label: 'ID de l\'élément', type: 'number', required: true },
            { key: 'rating', label: 'Note (1-5)', type: 'number', min: 1, max: 5, required: true },
            { key: 'comment', label: 'Commentaire', type: 'textarea', rows: 3, hideInList: true }
        ],
        
        displayColumns: ['user_id', 'item_type', 'rating'],
        searchableColumns: ['item_type'],
    },

    // ==================== IMAGES ====================
    images: {
        name: 'Images',
        title: 'une Image',
        icon: "<i class='fa-solid fa-image'></i>",
        
        columns: [
            { key: 'item_type', label: 'Type d\'élément', type: 'select', options: ['hotel', 'flight', 'airport', 'room', 'activity'], required: true },
            { key: 'item_id', label: 'ID de l\'élément', type: 'number', required: true },
            { key: 'url', label: 'URL de l\'image', type: 'text', required: true, placeholder: 'https://...' }
        ],
        
        displayColumns: ['item_type', 'item_id', 'url'],
        searchableColumns: ['item_type'],
    },
};
