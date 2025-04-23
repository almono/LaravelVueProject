import { defineStore } from 'pinia';
import api from '../../api.js';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: null
  }),
  actions: {
    async login(credentials) {
      await api.get('/sanctum/csrf-cookie') // CSRF protection
      
      const response = await api.post('/api/auth/login', credentials)

      if(response.status === 200) {
        this.token = response.data.accessToken
        api.defaults.headers.common["Authorization"] = `Bearer ${this.token}`
        await this.fetchUser()
      }
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

      // Remove token from Axios
      delete axios.defaults.headers.common["Authorization"]
    },
  },
});
