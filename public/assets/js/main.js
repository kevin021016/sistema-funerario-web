document.addEventListener('DOMContentLoaded', function() {
    const userData = localStorage.getItem(CONFIG.STORAGE_KEYS.USER);
    
    if (userData) {
        const user = JSON.parse(userData);
        
        // Buscamos el elemento del nombre
        const nameElement = document.getElementById('user-name-sidebar');
        const roleElement = document.getElementById('user-role-sidebar');

        if (nameElement) {
            // Priorizamos el nombre completo si lo tienes, o el nombre de pila
            nameElement.textContent = user.nombre || user.name || 'Usuario';
        }

        // Si quieres cambiar el rol dinámicamente también:
        if (roleElement) {
            roleElement.textContent = user.rol;
        }
    }
});