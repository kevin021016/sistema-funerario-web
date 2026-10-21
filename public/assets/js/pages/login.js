// public/assets/js/pages/login.js

document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const btn = document.getElementById('btnEntrar');
    let verify_credentials = true;

    btn.disabled = true;

    try {
        // Usamos CONFIG.API_BASE_URL en lugar de la URL larga
        const response = await fetch(`${CONFIG.API_BASE_URL}/login`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        if (response.ok) {
            // Usamos las llaves centralizadas
            localStorage.setItem(CONFIG.STORAGE_KEYS.TOKEN, data.token);
            localStorage.setItem(CONFIG.STORAGE_KEYS.USER, JSON.stringify(data.user));
            alert(localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN))

            window.location.href = '/';
        } else {
            const errorMsg = document.getElementById('error-message');

            errorMsg.style.display = 'block';

            btn.disabled = false;
            btn.innerHTML = 'Entrar al Sistema';
        }
    } catch (error) {
        console.error('Error:', error);
        btn.disabled = false;
    }
});

// Detectar cuando el usuario regresa a la página (Back button)
window.addEventListener('pageshow', function (event) {
    const btn = document.getElementById('btnEntrar');
    if (btn) {
        btn.disabled = false;
        btn.innerHTML = 'Entrar al Sistema'; // O el texto original que tengas
    }
});