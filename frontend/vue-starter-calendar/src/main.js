import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'

import { createRouter, createWebHistory} from 'vue-router'
import VCalendar from 'v-calendar';
import 'v-calendar/style.css';

const routes = [
    { path: '/', component: App },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})
  

createApp(App)
    .use(router)
    .use(VCalendar)
    .mount('#app')
