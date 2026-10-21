<template>
  <nav class="pc-sidebar">
    <div class="navbar-wrapper">
      <div class="m-header">
        <router-link to="/" class="b-brand">
          <svg class="logo-svg" viewBox="0 0 820 160">
            <g transform="translate(-60,-10) scale(1.25)">
              <defs>
                <linearGradient id="urnGrad" x1="0" y1="0" x2="0" y2="1">
                  <stop offset="0%" stop-color="var(--urn-top)" />
                  <stop offset="100%" stop-color="var(--urn-bottom)" />
                </linearGradient>
              </defs>

              <g transform="translate(20,20) scale(0.6)">
                <circle cx="128" cy="110" r="55" fill="var(--dog-main)" />
                <ellipse cx="90" cy="120" rx="18" ry="35" fill="var(--dog-ear)" />
                <ellipse cx="166" cy="120" rx="18" ry="35" fill="var(--dog-ear)" />
                <circle cx="112" cy="105" r="6" fill="var(--dog-eye)" />
                <circle cx="144" cy="105" r="6" fill="var(--dog-eye)" />
                <ellipse cx="128" cy="125" rx="18" ry="14" fill="var(--dog-mouth)" />
                <circle cx="128" cy="122" r="4" fill="var(--dog-eye)" />
                <path d="M118 135 Q128 142 138 135" stroke="var(--dog-eye)" stroke-width="3" fill="none" stroke-linecap="round" />
                <path d="M60 150 Q128 180 196 150 L180 245 Q128 265 76 245 Z" fill="url(#urnGrad)" />
                <ellipse cx="128" cy="150" rx="70" ry="18" fill="var(--urn-mid)" />
              </g>

              <text class="logo-text" x="210" y="100" font-family="Inter, Arial, sans-serif" font-size="44" font-weight="600" dominant-baseline="middle">
                Funeraria Mascotas
              </text>
            </g>
          </svg>
        </router-link>
      </div>

      <div class="navbar-content">
        <ul class="pc-navbar">
          <li class="pc-item pc-caption">
            <label>Navigation</label>
            <i class="ph-duotone ph-gauge"></i>
          </li>
          <li class="pc-item">
            <router-link to="/" class="pc-link">
              <span class="pc-micon"><i class="ph-duotone ph-gauge"></i></span>
              <span class="pc-mtext">Dashboard</span>
            </router-link>
          </li>

          <li class="pc-item pc-caption">
            <label>Opciones</label>
            <i class="ph-duotone ph-chart-pie"></i>
          </li>
          <li class="pc-item">
            <router-link to="/usuarios" class="pc-link">
              <span class="pc-micon"><i class="ph-duotone ph-user-circle"></i></span>
              <span class="pc-mtext">Usuarios</span>
            </router-link>
          </li>
          <li class="pc-item">
            <router-link to="/clientes" class="pc-link">
              <span class="pc-micon"><i class="ph-duotone ph-users"></i></span>
              <span class="pc-mtext">Clientes</span>
            </router-link>
          </li>
          <li class="pc-item">
            <router-link to="/contratos" class="pc-link">
              <span class="pc-micon"><i class="ph-duotone ph-notebook"></i></span>
              <span class="pc-mtext">Contratos</span>
            </router-link>
          </li>

          <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link" @click.prevent="toggleSubmenu('inventario')">
              <span class="pc-micon"><i class="ph-duotone ph-cube"></i></span>
              <span class="pc-mtext">Inventario</span>
              <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
            </a>
            <ul class="pc-submenu" v-show="activeSubmenu === 'inventario'">
              <li class="pc-item"><router-link class="pc-link" to="/ListaUrnas">Urnas</router-link></li>
            </ul>
          </li>
        </ul>
      </div>

      <!-- Card de Usuario -->
      <div class="card pc-user-card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-grow-1 ms-3">
              <div class="dropdown">
                <a href="#" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown">
                  <div class="d-flex align-items-center">
                    <div class="flex-grow-1 me-2">
                      <h6 class="mb-0">{{ user.nombre || 'Usuario' }}</h6>
                      <small>{{ user.role || 'Administrador' }}</small>
                    </div>
                    <div class="flex-shrink-0">
                      <div class="btn btn-icon btn-link-secondary avtar">
                        <i class="ph-duotone ph-windows-logo"></i>
                      </div>
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu">
                  <ul>
                    <li>
                      <a class="pc-user-links" @click.prevent="handleLogout">
                        <i class="ph-duotone ph-power"></i>
                        <span>Logout</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const user = ref({});
const activeSubmenu = ref(null);

onMounted(() => {
  const savedUser = localStorage.getItem(CONFIG.STORAGE_KEYS.USER);
  if (savedUser) {
    user.value = JSON.parse(savedUser);
  }
});

const toggleSubmenu = (name) => {
  activeSubmenu.value = activeSubmenu.value === name ? null : name;
};

const handleLogout = () => {
  localStorage.clear();
  window.location.href = '/login';
};
</script>

<style scoped>
/* 1. TAMAÑO Y TRANSICIONES DEL LOGO */
.logo-svg {
    width: 220px;
    transition: all 0.3s ease;
}

.logo-svg * {
    transition: all 0.3s ease;
}

.logo-text {
    fill: var(--logo-text);
}

.b-brand:hover .logo-svg {
    transform: scale(1.03);
}

/* 2. VARIABLES DE COLOR (DEFAULT / CLARO) */
.pc-sidebar {
    --logo-text: #1f2937;
    --dog-main: #f4c38a;
    --dog-ear: #e0ad6d;
    --dog-eye: #2f2f2f;
    --dog-mouth: #ffe2c2;
    --urn-top: #c68642;
    --urn-bottom: #8a4f2d;
    --urn-mid: #a86235;
}

/* 3. VARIABLES MODO OSCURO (Look Nocturno Integrado) */
:global([data-pc-theme="dark"]) .pc-sidebar {
    --logo-text: #ffffff;
    --dog-main: #e6b67f;
    --dog-ear: #c9975f;
    --dog-eye: #1a1a1a;
    --dog-mouth: #f5d7b5;
    --urn-top: #d89a5a;
    --urn-bottom: #6e3f24;
    --urn-mid: #8c4f2a;
}

/* 4. REMARCADO DE RUTA ACTIVA (VUE ROUTER) */
/* 4. REMARCADO DE RUTA ACTIVA (VUE ROUTER) */

/* 
   IMPORTANTE: Usamos .pc-link.router-link-active para que el resaltado 
   SOLO afecte a los botones del menú y NO al logo del perrito.
*/
.pc-link.router-link-active {
    background: rgba(var(--bs-primary-rgb), 0.1) !important;
    color: var(--bs-primary) !important;
    position: relative;
    border-radius: 8px;
    display: flex; /* Asegura que el fondo cubra bien el área */
}

/* El logo (.b-brand) cuando está activo no debe tener fondo ni barrita */
.b-brand.router-link-active {
    background: transparent !important;
}

.b-brand.router-link-active::after {
    display: none !important;
}

/* Asegurar que el icono y el texto cambien de color al estar activo */
.pc-link.router-link-active .pc-micon i,
.pc-link.router-link-active .pc-mtext {
    color: var(--bs-primary) !important;
}

/* Pequeña barra indicadora lateral solo para los links del menú */
.pc-link.router-link-active::after {
    content: "";
    position: absolute;
    left: 0;
    top: 10%;
    height: 80%;
    width: 4px;
    background: var(--bs-primary);
    border-radius: 0 4px 4px 0;
}

/* Estilo hover para los links que no están activos */
.pc-link:hover:not(.router-link-active) {
    background: rgba(0, 0, 0, 0.03);
}
</style>