import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from './stores/auth/auth';
import Home from './views/Home.vue';
import Login from './views/auth/Login.vue';
import Register from './views/auth/Register.vue';
import Dashboard from './views/main/Dashboard.vue';

const routes = [
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  { 
    path: '/', 
    component: Dashboard,
    meta: { requiresAuth: true }
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to) => {
  const authStore = useAuthStore();
  await authStore.fetchUser();

  if (to.meta.requiresAuth && !authStore.user) {
    return '/login'
  }
});

export default router;
