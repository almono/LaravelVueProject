import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'

// BootstrapVue CSS
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'
import 'bootstrap-icons/font/bootstrap-icons.css' // bootstrap icons

// Import BootstrapVueNext components
import * as BootstrapVueNext from 'bootstrap-vue-next'

// Toast notifications
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

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

app.mount('#app');
