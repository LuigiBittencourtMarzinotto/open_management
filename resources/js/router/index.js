import { createRouter, createWebHistory } from "vue-router";

import Login from '../components/HomeComponent.vue';
const routes = [
    {
      path: '/',
      name: 'HomeComponent',
      component: Login
    },
    {
      path: '/login/:url', 
      name: 'LoginComponent',
      redirect: (to) => {
        const url = to.params.url; 
        window.location.href = `${url}`; 
      },
    },
    {
      path: '/v1/dashboard/:url', 
      name: 'DashboardComponent',
      redirect: (to) => {
        const url = to.params.url; 
        window.location.href = `${url}`; 
      },
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;