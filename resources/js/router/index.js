import { createRouter, createWebHistory } from "vue-router";

import Login from '../components/HomeComponent.vue';
const routes = [
    {
        path: '/',
        name: 'HomeComponent',
        component: Login
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;