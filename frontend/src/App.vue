<template>
    <div id="app">
      <h1>Welcome to Vue in Docker 🐳</h1>
      <Home />
    </div>
  </template>
  
  <script>
  import Home from "./views/Home.vue";
  
  export default {
    components: {
      Home,
    },
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
  