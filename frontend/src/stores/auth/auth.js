import { defineStore } from 'pinia';
import api from '../../api.js';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: null,
    isAuthenticated: false
  }),
  getters: {
    isAuthenticated: (state) => !!state.isAuthenticated
  },
  actions: {
    async login(credentials) {
      //await api.get('/sanctum/csrf-cookie') // CSRF protection
      await api.get('/sanctum/csrf-cookie').then(response => {
          const loginResponse = api.post('/api/auth/login', credentials)

          if(loginResponse.status === 200) {
            this.token = loginResponse.data.accessToken
            this.isAuthenticated = true
            api.defaults.headers.common["Authorization"] = `Bearer ${this.token}`
            this.fetchUser()
          }
      });
    },

    async register(data) {
      try {
        const response = await api.post('/api/auth/register', { ...data })
        this.user = response.data
      } catch (error) {
        this.user = null
        if(error?.response?.data) {
          return error.response.data
        }
      }
    },

    async fetchUser() {
      try {
        const response = await api.get('/api/auth/user')
        this.user = response.data
      } catch {
        this.user = null;
      }
    },

    async logout() {
      await api.post('/logout')
      this.user = null
      this.token = null
      this.isAuthenticated = false

      // Remove token from Axios
      delete axios.defaults.headers.common["Authorization"]
    },
  },
});
