import api from './api.js';
import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

// BootstrapVue CSS
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
//import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
import 'bootstrap-icons/font/bootstrap-icons.css' // bootstrap icons

// Import BootstrapVueNext components
import * as BootstrapVueNext from 'bootstrap-vue-next'

// Toast notifications
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

// Translations
import i18n from './i18n';

const app = createApp(App);

//if (import.meta.env.MODE === 'development') {
    app.config.devtools = true; // Enable Vue DevTools
//}

app.use(createPinia()); // Register Pinia store management
app.use(router); // Vue routes

// Registering ALL BootstrapVueNext components
for (const [key, component] of Object.entries(BootstrapVueNext)) {
    app.component(key, component)
}

// Toast Options
const options = {
    position: "bottom-center",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: false,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: true,
    hideProgressBar: true,
    closeButton: "button",
    icon: true,
    rtl: false
};

app.use(Toast, options);
app.use(i18n);

api.get('/api/translations', {
    headers: { 'Accept-Language': 'en' }
}).then(({ data }) => {
    i18n.global.setLocaleMessage(data.locale, data.messages);
    i18n.global.locale.value = data.locale;

    // Hide spinner after app and translation load
    const spinner = document.getElementById('spinner');
    if (spinner) spinner.style.display = 'none';

    app.mount('#app');
});

//app.mount('#app');
