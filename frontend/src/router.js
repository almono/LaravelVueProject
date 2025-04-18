import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from './stores/auth/auth';
import Home from './views/Home.vue';
import Login from './views/auth/Login.vue';
import Register from './views/auth/Register.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/login', component: Login },
  { path: '/register', component: Register }
  /*
  { 
    path: '/dashboard', 
    component: Dashboard,
    meta: { requiresAuth: true }
  },*/
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to) => {
  const authStore = useAuthStore();
  await authStore.fetchUser();
  
  if (to.meta.requiresAuth && !authStore.user) {
    return '/login';
  }
});

export default router;
