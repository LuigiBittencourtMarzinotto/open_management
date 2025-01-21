<template>
  <nav class="navbar navbar-expand-md navbar-custom navbar-light shadow mt-4 border-radius">
    <div class="container">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav w-100">
          <li class="nav-item">
            <a class="nav-link">Início</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown link
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item active">
            <a class="nav-link">Início</a>
          </li>
          <li class="nav-item">
            <a class="nav-link">Início</a>
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
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear fs-5 me-2"></i>Configuração</a></li>
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
  props: ['token', 'routeLogout', 'nameUser', 'routeLoginUser', 'routeMenu'],
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
    getMenus() {
      let url = this.routeMenu
      let configuracao = {
        method: 'GET', 
        headers: {
          'Content-Type': 'application/json'
        }
      }
      fetch(url, configuracao)
        .then(response => response.json())
        .then(data => {
          console.log(data)
          this.closeLoading();

        })
        .catch((errors) => {
          this.closeLoading();
          console.log(errors)
        })

    }
  },
  mounted() {
    const currentTheme = document.body.getAttribute('data-bs-theme');
    this.icon = currentTheme === 'dark' ? 'bi bi-sun' : 'bi bi-moon';
    const divs = document.querySelectorAll('.nav-item');
    divs.forEach(el => el.addEventListener('click', e => {
      let classItemNavBar = e.target.parentNode.classList[0];
      $(`.${classItemNavBar}`).addClass("active")
    }));

    this.getMenus()
  }
};
</script>