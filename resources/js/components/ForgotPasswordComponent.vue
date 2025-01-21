<template>
  <card-component center=true no-padding=true>
    <template v-slot:body>
      <div class="row w-100">
        <form-component form-id="frmLogin" :token="token" class="d-flex flex-column align-items-center"
          @submit.prevent="formForgotPassword($event)">
          <template v-slot:body>
            <div class="w-100 text-start">
              <a class="custom-link-black text text-body-secondary" href="#"
                @click.prevent="$store.commit('setCurrentComponent', 'LoginComponent')"> <i
                  class="bi bi-arrow-left m-1"></i>Volta</a>

            </div>
            <img src="../../img/FINANCE.png" alt="" class="logo my-3">
            <h3 class="fw-bold">Esqueceu sua senha?</h3>
            <div class='col-7 my-3'>
              <p class="text text-body-secondary text-center">
                Para redefinir sua senha, insira seu endereço de e-mail e siga as instruções enviadas para você. Se
                precisar de ajuda, entre em contato com o suporte.
              </p>
            </div>
            <input-component label="Email:" id-input="email" col="col-md-7 col-12">
              <template v-slot:input>
                <input type="email" name="email" id="email" @input="valideEmail()"
                  class="form-control border shadow-none" :class="(errors.email) ? 'border-danger' : ''"
                  placeholder="Digite seu e-mail para recuperação." v-model="email" />
                <span v-if="errors.email" class="text-danger py-2">{{ errors.email }}</span>
              </template>
            </input-component>
            <div class='col-7 my-3'>
              <button type="submit" class="btn btn-dark w-100" :disabled="isSubmitDisabled">Recuperar Senha</button>
            </div>

          </template>
        </form-component>
      </div>
    </template>
  </card-component>
</template>
<script>
import { mapMutations } from 'vuex';
export default {
  props: ['token'],
  props: ['token', 'routeForgettenPassword'],


  data() {
    return {
      errors: {},
      email: '',
      isSubmitDisabled: false,
      inputEmailValido: false,
    }
  },
  methods: {
    ...mapMutations(['openModal', 'getLoading', 'closeLoading', 'successAlert', 'closeModal']),
    valideEmail() {
      const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com.*$/;
      if (!emailPattern.test(this.email)) {
        this.errors.email = 'E-mail inválido!';
      } else {
        this.errors.email = "";
      }
      this.checkSubmitDisabled();
    },
    checkSubmitDisabled() {
      this.isSubmitDisabled = !!(this.errors.email || !this.email);
    },
    valideForm() {
      this.errors = {}; // Limpa os erros antes de validar
      this.valideEmail();

      if (!this.email) {
        this.errors.email = 'E-mail é obrigatório.';
      }
    },
    formForgotPassword(e) {
      this.getLoading();

      this.valideForm();
      let url = this.routeForgettenPassword
      let configuracao = {
        method: 'post',
        body: new URLSearchParams({
          'email': this.email
        })
      }

      fetch(url, configuracao)
        .then(response => {
          return response.json().then(data => {
            data.status = response.status;
            return data;
          });
        })
        .then(data => {
          if(data.status != 403){
            this.successAlert("E-mail para configurar senha enviado!");
          }else{
            this.errors.email = data.message
          }
          this.closeLoading();
        })
        .catch((errors) => {
          console.log(errors)
          this.closeLoading();
        })
    },
  }
}
</script>
