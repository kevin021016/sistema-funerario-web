// public/assets/js/auth-guard.js

(function () {
    const token = localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN);
    const currentPath = window.location.pathname;

    // Si NO hay token, manda al login
    if (!token && currentPath !== '/login') {
        window.location.href = '/login';
    }

    // Si YA hay token e intentas ir al login, manda al dashboard (index)
    if (token && currentPath === '/login') {
        window.location.href = '/';
    }
})();