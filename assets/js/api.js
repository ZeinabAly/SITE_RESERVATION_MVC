
export const api = {
    async get(table) {
        const res = await fetch(`./api/admin.php?table=${table}&action=index`);
        return await res.json();
    },

    async post(table, data) {
        const res = await fetch(`./api/admin.php?table=${table}&action=store`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        return await res.json();
    },

    async put(table, id, data) {
        const res = await fetch(`./api/admin.php?table=${table}&action=update&id=${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        return await res.json();
    },

    async delete(table, id) {
        const res = await fetch(`./api/admin.php?table=${table}&action=delete&id=${id}`, {
            method: 'DELETE'
        });
        return await res.json();
    }
};

