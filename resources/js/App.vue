
<template>
    
  <div class="main-wrapper">
    <Topbar /> <!-- Se queda fijo -->
    <div class="content-body">
      <Sidebar /> <!-- Se queda fijo -->
      <router-view /> <!-- Solo esto cambia -->
    </div>
  </div>
  <Footer/>
</template>

<script setup>
import Topbar from './components/Topbar.vue';
import Sidebar from './components/Sidebar.vue';
import Footer from './components/Footer.vue';
</script>
