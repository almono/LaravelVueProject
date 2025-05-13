import { defineStore } from 'pinia';
import api from '../../api';

export const useTranslationsStore = defineStore('translations', {
  state: () => ({
    currentLocale: 'en',
  }),

  actions: {
    async setLocale(locale) {
      // Fetch translations from backend API
      try {
        const response = await api.get('/api/setLocale', {
          headers: { 'Accept-Language': locale }
        });
        // Store the locale and the fetched translations
        this.currentLocale = locale;
        return response.data.messages;  // Return messages to update in component
      } catch (error) {
        console.error('Error fetching translations:', error);
      }
    }
  }
});
