<template>
  <footer class="pc-footer">
    <div class="footer-wrapper container-fluid">
      <div class="row">
        <div class="col-sm-6 my-1">
          <p class="m-0">
            &copy; {{ currentYear }} | Made with &#9829; by Team 
            <a href="https://themeforest.net/user/phoenixcoded" target="_blank" rel="noopener noreferrer">
              Phoenixcoded
            </a>
          </p>
        </div>
        
        <div class="col-sm-6 ms-auto my-1">
          <ul class="list-inline footer-link mb-0 justify-content-sm-end d-flex">
            <li 
              v-for="(link, index) in footerLinks" 
              :key="index" 
              class="list-inline-item"
            >
              <a 
                :href="link.url" 
                :target="link.external ? '_blank' : '_self'"
                :rel="link.external ? 'noopener noreferrer' : undefined"
              >
                {{ link.text }}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { ref } from 'vue';

// Año dinámico para el copyright
const currentYear = ref(new Date().getFullYear());

// Listado de enlaces para evitar repetir HTML (v-for)
const footerLinks = ref([
  { text: 'Home', url: '/', external: false },
  { text: 'Documentation', url: 'https://pcoded.gitbook.io/light-able/', external: true },
  { text: 'Support', url: 'https://phoenixcoded.support-hub.io/', external: true }
]);
</script>

<style scoped>
.pc-footer {
    margin-left: 260px;
    transition: margin-left .3s ease;
}

.pc-sidebar-hide .pc-footer {
    margin-left: 0;
}

@media (max-width: 1024px) {
    .pc-footer {
        margin-left: 0 !important;
    }
}
</style>