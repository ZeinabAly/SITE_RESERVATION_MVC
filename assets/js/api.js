

export const api = {
    /**
     * GET - Récupérer des données
     */
    async get(table) {
        const res = await fetch(`./api/admin.php?table=${table}&action=index`);
        return await res.json();
    },

    /**
     * POST - Créer un élément
     * Accepte soit un objet, soit un FormData
     */
    async post(table, data) {
        let body;
        
        // Si c'est déjà un FormData, l'utiliser directement
        if (data instanceof FormData) {
            body = data;
        } else {
            // Sinon, convertir l'objet en FormData
            body = new FormData();
            for (const [key, value] of Object.entries(data)) {
                body.append(key, value);
            }
        }

        const res = await fetch(`./api/admin.php?table=${table}&action=store`, {
            method: 'POST',
            // PAS de Content-Type header avec FormData !
            body: body
        });
        
        return await res.json();
    },

    /**
     * PUT - Modifier un élément
     * Accepte soit un objet, soit un FormData
     */
    async put(table, id, data) {
        let body;
        
        // Si c'est déjà un FormData, l'utiliser directement
        if (data instanceof FormData) {
            body = data;
        } else {
            // Sinon, convertir l'objet en FormData
            body = new FormData();
            for (const [key, value] of Object.entries(data)) {
                body.append(key, value);
            }
        }

        const res = await fetch(`./api/admin.php?table=${table}&action=update&id=${id}`, {
            method: 'POST',  // POST au lieu de PUT pour supporter FormData
            body: body
        });
        
        return await res.json();
    },

    /**
     * DELETE - Supprimer un élément
     */
    async delete(table, id) {
        const res = await fetch(`./api/admin.php?table=${table}&action=delete&id=${id}`, {
            method: 'DELETE'
        });
        return await res.json();
    }
};