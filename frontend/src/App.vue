<template>
  <div id="main-div">
    <router-view></router-view>
  </div>
</template>

<script setup>
import { useAuthStore } from './stores/auth/auth.js'

const authStore = useAuthStore()
</script>

<script>
export default {
  name: "App"
};
</script>

<style>
body {
  font-family: Arial, sans-serif;
  background: #f4f4f4;
  text-align: center;
  padding: 0px;
}
</style>
  