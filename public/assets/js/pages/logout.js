async function cerrarSesion() {
    const token = localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN);

    try {
        // 1. Avisamos al servidor para que mate el token
        await fetch(`${CONFIG.API_BASE_URL}/logout`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
    } catch (error) {
        console.error('Error al contactar la API para el logout:', error);
    } finally {
        // 2. PASE LO QUE PASE, borramos los datos locales
        localStorage.removeItem(CONFIG.STORAGE_KEYS.TOKEN);
        localStorage.removeItem(CONFIG.STORAGE_KEYS.USER);
        
        // 3. Mandamos al usuario al login
        window.location.href = '/login';
    }
}