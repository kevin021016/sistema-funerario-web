// public/assets/js/config.js

const CONFIG = {
    // Si cambias de local a un servidor real, solo editas esta línea
    API_BASE_URL: 'http://127.0.0.1:8000/api',
    
    // Aquí puedes centralizar los nombres de las tablas del localStorage
    // para no equivocarte al escribirlos en otros archivos
    STORAGE_KEYS: {
        TOKEN: 'funeraria_token',
        USER: 'funeraria_user_data'
    },

    // Puedes agregar más configuraciones globales aquí
    APP_NAME: 'Sistema Funerario Grupo Espino'
};

// Congelamos el objeto para que nadie pueda modificarlo por accidente desde la consola
Object.freeze(CONFIG);