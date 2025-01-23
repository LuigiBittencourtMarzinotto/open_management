<template>
    <card-component center=true no-padding=true>
        <template v-slot:body>
            <div class="row w-100">
                <form-component form-id="frmLogin" method="POST" :token="token"
                    class="d-flex flex-column align-items-center" @submit.prevent="formLogin($event)">
                    <template v-slot:body>
                        <img src="../../img/JAGUA_LOGO_PMS.png" alt="" class="logo my-3">
                        <h3 class="fw-bold">Gerenciador de Usuarios</h3>
                        <p class="text text-body-secondary">
                            Gerencie seus usuarios com facilidade
                        </p>
                        <input-component label="Email:" id-input="email" col="col-md-7 col-12">
                            <template v-slot:input>
                                <input type="email" name="email" id="email" @input="valideEmail()" v-model="email"
                                    class="form-control border shadow-none "
                                    :class="(errors.email) ? 'border-danger' : ''" placeholder="Entre com seu email." />
                                <span v-if="errors.email" class="text-danger py-2">{{ errors.email }}</span>
                            </template>
                        </input-component>

                        <input-component label="Senha:" id-input="password" col="col-md-7 col-12">
                            <template v-slot:input>
                                <div class="input-group ">
                                    <input :type="typeInputPassword" name="password" id="password"
                                        @input="validePassword()" v-model="password"
                                        class="form-control border shadow-none"
                                        :class="(errors.senha) ? 'border-danger' : ''"
                                        placeholder="Entre com sua senha." />
                                    <span class="input-group-text cursor-pointer" @click="changeTypeInput()">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                </div>
                                <span v-if="errors.senha" class="text-danger py-2">{{ errors.senha }}</span>
                                <div class="d-flex justify-content-between mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                            checked>
                                        <label class="form-check-label text text-body-secondary fs-6"
                                            for="flexCheckChecked">
                                            Lembre-se de mim
                                        </label>
                                    </div>
                                    <a class="custom-link-black" href="#"
                                        @click.prevent="$store.commit('setCurrentComponent', 'ForgotPasswordComponent')">Esqueceu
                                        a senha?</a>
                                </div>
                            </template>
                        </input-component>
                        <span v-if="errors.userInvalido" class="text text-danger" role="alert">
                            {{ errors.userInvalido }}
                        </span>
                        <div class='col-md-7 col-12 my-3'>
                            <button type="submit" class="btn btn-dark w-100"
                                :disabled="isSubmitDisabled">Entrar</button>
                        </div>
                        <div class='col-md-7 col-12'>
                            <div class="d-flex align-items-center">
                                <hr class="flex-grow-1">
                                <span class="mx-2 text text-body-secondary fs-6">Ou logar com</span>
                                <hr class="flex-grow-1">
                            </div>
                        </div>
                        <div class="mb-3 d-flex">
                            <GoogleLogin :callback="callback"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" prompt
                                :button-config="{ shape: 'circle' }" />
                        </div>
                        <span class="mx-2 text text-body-secondary fs-6">Não tem uma conta? <a class="custom-link-black"
                                href="#"
                                @click.prevent="$store.commit('setCurrentComponent', 'RegisterComponent')">Cadastra-se</a></span>

                    </template>
                </form-component>
            </div>
        </template>
    </card-component>
</template>
<script setup>
import { useRouter } from "vue-router";
const router = useRouter();

const callback = (response) => {
    console.log("Resposta:", response);
};
</script>
<script>
import ForgotPasswordComponent from './ForgotPasswordComponent.vue';
import { mapMutations } from 'vuex';
export default {
    props: ['token', 'routeDashboard', 'routeLogin'],
    data() {
        return {
            errors: {},
            email: '',
            password: '',
            typeInputPassword: 'password',
            isSubmitDisabled: false,
            inputEmailValido: false,
            inputPasswordValido: false,
        }
    },
    components: {
        ForgotPasswordComponent
    },
    methods: {
        ...mapMutations(['openModal', 'getLoading', 'closeLoading', 'successAlert', 'closeModal']),
        changeTypeInput() {
            this.typeInputPassword = this.typeInputPassword === 'text' ? 'password' : 'text';
        },
        validePassword() {
            if (this.password.length < 6) {
                this.errors.senha = this.password.length === 0 ? 'Senha é obrigatório.' : 'Deve ter no mínimo 6 caracteres.';
            } else {
                this.errors.senha = "";
            }
            this.checkSubmitDisabled();
        },
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
            this.isSubmitDisabled = !!(this.errors.email || this.errors.senha || !this.email || !this.password);
        },
        valideForm() {
            this.errors = {}; // Limpa os erros antes de validar
            this.valideEmail();
            this.validePassword();
            if (!this.email || !this.password) {
                if (!this.email) {
                    this.errors.email = 'E-mail é obrigatório.';
                }
                if (!this.password) {
                    this.errors.senha = 'Senha é obrigatório.';
                }
            }
        },
        formLogin(e) {
            this.valideForm();
            this.getLoading()

            let url = this.routeLogin
            let configuracao = {
                method: 'post',
                body: new URLSearchParams({
                    'email': this.email,
                    'password': this.password
                })
            }

            fetch(url, configuracao)
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        document.cookie = 'token=' + data.token
                        this.$router.push({ name: 'DashboardComponent', params: { url: this.routeDashboard } });
                    }
                    this.errors.userInvalido = data.erro;
                    this.closeLoading();

                })
                .catch((errors) => {
                    this.closeLoading();
                    console.log(errors)
                })
        },
    }
}
</script>
