<template>
  <div class="d-flex h-screen">
    <!-- Sidebar -->
    <Sidebar class="w-64 bg-gray-800 text-white" />

    <!-- Navbar + Content + Footer -->
    <div class="d-flex dashboard-container">
      <ContentNavbar class="h-16 bg-white shadow" />
      <main class="main-container p-4 bg-gray-50">
        <router-view />
      </main>
      <ContentFooter class="h-12 bg-white border-t" />
    </div>
  </div>
</template>

<script setup>
import ContentNavbar from '../../components/UI/ContentNavbar.vue';
import ContentFooter from '../../components/UI/ContentFooter.vue';
import Sidebar from '../../components/UI/Sidebar.vue';

</script>

<script>
  export default {
    name: "Dashboard",
  };
</script>

<style lang="scss">
:root {
	--primary: #4ade80;
	--primary-alt: #22c55e;
	--grey: #64748b;
	--dark: #1e293b;
	--dark-alt: #334155;
	--light: #f1f5f9;
	--sidebar-width: 300px;
}

* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Fira sans', sans-serif;
}

body {
	background: var(--light);
}

button {
	cursor: pointer;
	appearance: none;
	border: none;
	outline: none;
	background: none;
}

.app {
	display: flex;

	main {
		flex: 1 1 0;
		padding: 2rem;

		@media (max-width: 1024px) {
			padding-left: 6rem;
		}
	}
}

.dashboard-container {
  flex-direction: column;
  overflow: hidden;
  flex: 1;
}

.main-container {
  flex: 1;
  overflow-y: auto;
}
</style>
