import './bootstrap';
import * as bootstrap from 'bootstrap';

import 'jquery/dist/jquery.min.js';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Swal from 'sweetalert2';
import { createApp } from 'vue';
import { createStore } from 'vuex';
import gAuthPlugin from 'vue3-google-login';
import router from './router/index';
import LoginComponent from './components/LoginComponent.vue';
import ForgotPasswordComponent from './components/ForgotPasswordComponent.vue';
import RegisterComponent from './components/RegisterComponent.vue';



// Criação da instância do Vue
const app = createApp({});
const store = createStore({
  state: {
    currentComponent: LoginComponent,
    theme: 'dark',
    errors: {},
  },
  mutations: {
    setCurrentComponent(state, component) {
      if (component === 'LoginComponent') {
        state.currentComponent = LoginComponent;
      } else if (component === 'ForgotPasswordComponent') {
        state.currentComponent = ForgotPasswordComponent;
      } else if (component === 'RegisterComponent') {
        state.currentComponent = RegisterComponent;
      }
    },
    openModal(state, id) {
      state.uniqueModal = new bootstrap.Modal(document.getElementById(id), {});
      state.uniqueModal.show();
    },
    closeModal(state, id) {
      if (state.uniqueModal) {
        state.uniqueModal.hide(); 
      }
    },
    successAlert(state, text) {
      Swal.fire({
        text: text,
        icon: "success",
        timer: 1500,
        showConfirmButton: false
      });
    },
    getLoading() {
      Swal.fire({
        title: '',
        html: '<img src="./img/logo.gif" width="170px">',
        background: 'transparent',
        allowOutsideClick: false,
        showConfirmButton: false,
      });
    },
    closeLoading() {
      setTimeout(function () {
        Swal.close();
      }, 1000);
    },


    setError(state, { fieldName, message }) {
      state.errors[fieldName] = message;
    },
    clearError(state, fieldName) {
      state.errors[fieldName] = '';
    },
  },
  actions: {
    async validateField({ commit, state, dispatch }, object) {
      const fieldName = Object.keys(object)[0]; // Captura a chave
      const fieldValue = object[fieldName]; // Captura o valor
      const isEmpty = await dispatch('empty', fieldValue);
      if (isEmpty) {
        commit('setError', { fieldName, message: 'Campo obrigatório.' });
      } else {
        commit('clearError', fieldName);
      }
    },
    empty(_, value) {
      return value === undefined || value === null || value === '' || value === '0';
    },

  },
  getters: {
    getErrors: (state) => (error) => {
      return state.errors[error] ?? '';
    },
  },
});

export default store;
// Uso da store
app.use(store);

// Uso do Google Auth
app.use(gAuthPlugin, {
  clientId: "705919866239-o9chu4h04h9loc3pui2uaav7jsnc7n8s.apps.googleusercontent.com"
});

// Uso do router
app.use(router);

// Registro de componentes
import HomeComponents from './components/HomeComponent.vue';
app.component('home-component', HomeComponents);

import NavbarComponents from './components/NavbarComponents.vue';
app.component('nav-bar-component', NavbarComponents);

import CardComponents from './components/CardComponent.vue';
app.component('card-component', CardComponents);

import FormComponents from './components/FormComponent.vue';
app.component('form-component', FormComponents);

import InputComponents from './components/InputComponent.vue';
app.component('input-component', InputComponents);

import ModalComponents from './components/ModalComponent.vue';
app.component('modal-component', ModalComponents);

import ResetPasswordComponent from './components/ResetPasswordComponent.vue';
app.component('reset-password-component', ResetPasswordComponent);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

// Montagem da aplicação
app.mount('#app');
