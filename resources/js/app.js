import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // El que crearás en el paso 2

const app = createApp(App);
app.config.globalProperties.$asset = (path) => `/${path}`;
app.use(router);
app.mount('#app');