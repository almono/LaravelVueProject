<template>
  <div id="main-div">
    <Navbar v-if="isAuthenticated" />
    <router-view></router-view>
    <Footer v-if="isAuthenticated" />
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useAuthStore } from './stores/auth/auth.js'

const authStore = useAuthStore()
const isAuthenticated = computed(() => authStore.isAuthenticated)
</script>

<script>
import Navbar from './components/UI/Navbar.vue'
import Footer from './components/UI/Footer.vue'

export default {
  components: {
    Navbar,
    Footer
  }
};
</script>

<style>
body {
  font-family: Arial, sans-serif;
  background: #f4f4f4;
  text-align: center;
  padding: 20px;
}
</style>
  