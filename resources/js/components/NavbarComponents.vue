<template>
  <nav class="navbar navbar-expand-md navbar-custom navbar-light shadow mt-4 border-radius">
    <div class="container">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav w-100">
          <li class="nav-item ">
            <a class="nav-link" :href="routeHome">Início</a>
          </li>
          <li class="nav-item" v-if="tipoUser == '1'">
            <a class="nav-link" :href="routeUser">Usúarios</a>
          </li>
        </ul>
      </div>

      <div class="ms-auto d-flex">
        <button class="btn bg-transparent btn-no-border" @click="toggleTheme">
          <i :class="icon" class="fs-4"></i>
        </button>
        <div class="dropdown">
          <button class="btn bg-transparent btn-no-border dropdown-toggle" type="button" id="userDropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle fs-4"></i>
            {{ nameUser }}
          </button>
          <ul class="dropdown-menu pe-3" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" :href="routeLoginUser"><i class="bi bi-person fs-5 me-2"></i>Meu perfil</a>
            </li>
            <li><a class="dropdown-item text-danger" :href="routeLogout"><i
                  class="bi bi-box-arrow-in-right fs-5 me-2"></i>Sair</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapMutations } from 'vuex';
export default {
  data() {
    return {
      icon: "bi bi-moon",
      menus: []
    }
  },
  props: ['token', 'routeLogout', 'nameUser', 'routeLoginUser', 'routeMenu', 'routeHome', 'routeUser', "tipoUser"],
  methods: {
    ...mapMutations(['openModal', 'getLoading', 'closeLoading', 'successAlert', 'closeModal']),
    toggleTheme() {
      const body = document.body;
      const currentTheme = body.getAttribute('data-bs-theme');
      if (currentTheme === 'dark') {
        body.setAttribute('data-bs-theme', 'light');
        this.icon = 'bi bi-moon';
      } else {
        body.setAttribute('data-bs-theme', 'dark');
        this.icon = 'bi bi-sun';
      }
    },
    // getMenus() {
    //   let url = this.routeMenu
    //   let configuracao = {
    //     method: 'GET', 
    //     headers: {
    //       'Content-Type': 'application/json'
    //     }
    //   }
    //   fetch(url, configuracao)
    //     .then(response => response.json())
    //     .then(data => {
    //       console.log(data)
    //       this.closeLoading();

    //     })
    //     .catch((errors) => {
    //       this.closeLoading();
    //       console.log(errors)
    //     })

    // }
  },
  mounted() {

    // this.getMenus()
  }
};
</script>