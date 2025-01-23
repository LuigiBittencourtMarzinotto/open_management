<template>
  <div class="container-fluid m-0 vh-100 d-flex justify-content-center">
    <div class="row w-100">
      <div class="col-12 p-0">
        <card-component no-padding=true>
          <template v-slot:body>
            <div class="row h-100">
              <div class="col-lg-6 col-12 height-100">
                <card-component center=true no-padding=true>
                  <template v-slot:body>
                    <div class="row w-100">
                      <form-component form-id="frmLogin" :token="token" class="d-flex flex-column align-items-center"
                        @submit.prevent="formUpdatePassword($event)">
                        <template v-slot:body>
                          <img src="../../img/JAGUA_LOGO_PMS.png" alt="" class="logo my-3">
                          <h3 class="fw-bold">Definir uma nova senha</h3>
                          <div class='col-md-7 col-12 my-3'>
                            <p class="text text-body-secondary text-center">
                              Esqueceu sua senha? Não se preocupe! Defina uma nova senha abaixo para continuar acessando
                              sua conta de forma segura.
                            </p>
                          </div>

                          <!-- Campo de Senha -->
                          <input-component label="Senha:" id-input="password" col="col-md-7 col-12">
                            <template v-slot:input>
                              <div class="input-group">
                                <input :type="typeInputPassword" name="password" id="password" v-model="password"
                                  class="form-control border shadow-none" :class="{ 'border-danger': errors.password }"
                                  placeholder="Senha nova" @input="validatePassword('password')" />
                                <span class="input-group-text cursor-pointer" @click="changeTypeInput('password')">
                                  <i :class="typeInputPassword === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash'"></i>
                                </span>
                              </div>
                              <span v-if="errors.password" class="py-2">
                                <p v-for="(valid, rule) in passwordRules" :key="rule" class="p-1 m-0">
                                  <span>
                                    <i
                                      :class="errors[rule] ? 'bi bi-check-circle pe-1 text-success' : 'bi bi-x-circle pe-1 text-danger'"></i>
                                  </span>{{ valid }}
                                </p>
                              </span>
                            </template>
                          </input-component>

                          <!-- Campo de Confirmação de Senha -->
                          <input-component label="Confirme a senha:" id-input="passwordConfirm" col="col-md-7 col-12">
                            <template v-slot:input>
                              <div class="input-group">
                                <input :type="typeInputPasswordConfirm" name="passwordConfirm" id="passwordConfirm"
                                  v-model="passwordConfirm" class="form-control border shadow-none"
                                  :class="{ 'border-danger': errors.passwordConfirm }" placeholder="Confirme a senha"
                                  @input="validatePassword('passwordConfirm', true)" />
                                <span class="input-group-text cursor-pointer"
                                  @click="changeTypeInput('passwordConfirm')">
                                  <i
                                    :class="typeInputPasswordConfirm === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash'"></i>
                                </span>
                              </div>
                              <span v-if="errors.passwordConfirm" class="py-2 text-danger">{{ errors.passwordConfirm
                                }}</span>
                            </template>
                          </input-component>

                          <div class="col-7 my-3">
                            <button type="submit" class="btn btn-dark w-100"
                              :disabled="isSubmitDisabled">Salvar</button>
                          </div>
                        </template>
                      </form-component>
                    </div>
                  </template>
                </card-component>
              </div>
              <div class="col-lg-6 bg-overlay d-none d-lg-block"></div>
            </div>
          </template>
        </card-component>
      </div>
    </div>
  </div>
</template>
<script>
import { mapMutations } from 'vuex';

export default {
  props: ['token', 'updatePassword', 'id', 'routeLogin'],
  data() {
    return {
      errors: {},
      password: '',
      passwordConfirm: '',
      isSubmitDisabled: false,
      typeInputPassword: 'password',
      typeInputPasswordConfirm: 'password',
      passwordRules: {
        hasMinLength: 'Mínimo 6 caracteres',
        hasUpperCase: 'Letras maiúsculas',
        hasLowerCase: 'Letras minúsculas',
        hasNumber: 'Números',
        hasSpecialChar: 'Caractere especial',
      },
    };
  },
  methods: {
    ...mapMutations(['openModal', 'getLoading', 'closeLoading', 'successAlert', 'closeModal']),

    changeTypeInput(field) {
      this[`typeInput${field.charAt(0).toUpperCase() + field.slice(1)}`] = this[`typeInput${field.charAt(0).toUpperCase() + field.slice(1)}`] === 'text' ? 'password' : 'text';
    },

    validatePassword(field, isConfirm = false) {
      this.errors = { ...this.errors, [field]: '' };

      if (!isConfirm) {
        this.validatePasswordStrength(field);
        this.errors.passwordConfirm = this.password !== this.passwordConfirm ? 'Senhas não conferem' : '';

      } else {
        this.errors.passwordConfirm = this.password !== this.passwordConfirm ? 'Senhas não conferem' : '';
      }

      this.checkSubmitDisabled();
    },

    // Valida os requisitos da senha
    validatePasswordStrength(field) {
      const password = this[field];
      this.errors.hasMinLength = password.length >= 6;
      this.errors.hasUpperCase = /[A-Z]/.test(password);
      this.errors.hasLowerCase = /[a-z]/.test(password);
      this.errors.hasNumber = /\d/.test(password);
      this.errors.hasSpecialChar = /[\W_]/.test(password);
      this.errors.password = this.passwordRequirementsMet() ? '' : 'Sua senha não atende aos requisitos';
    },

    passwordRequirementsMet() {
      return Object.keys(this.errors)
        .filter(key => key !== 'password' && key !== 'passwordConfirm')
        .every(key => this.errors[key] === true);
    },
    checkSubmitDisabled() {
      this.isSubmitDisabled = !(this.passwordRequirementsMet() && this.errors.passwordConfirm == '');
    },
    formUpdatePassword(e) {
      this.validatePassword('password', false);
      this.validatePassword('passwordConfirm', true);
      this.getLoading()
      if (!this.isSubmitDisabled && this.password != '') {
        let url = this.updatePassword;
        let configuracao = {
          method: 'post',
          body: new URLSearchParams({
            'id': this.id,
            'password': this.password
          })
        }
        fetch(url, configuracao)
          .then(response => response.json())
          .then(data => {
            this.successAlert(data.message);
            setTimeout(() => { 
              this.$router.push({ name: 'LoginComponent', params: { url: this.routeLogin } });
            }, 1000);
          })
          .catch((errors) => {
            this.closeLoading();
            console.log(errors)

          })
      }

    }
  }
}
</script>
