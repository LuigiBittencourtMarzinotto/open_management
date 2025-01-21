<template>
    <card-component center=true no-padding=true>
        <template v-slot:body>
            <div class="row w-100">
                <form-component form-id="frmLogin" :token="token" class="d-flex flex-column align-items-center"
                    @submit.prevent="formRegister($event)">
                    <template v-slot:body>
                        <div class="w-100 text-start">
                            <a class="custom-link-black text text-body-secondary" href="#"
                                @click.prevent="$store.commit('setCurrentComponent', 'LoginComponent')"> <i
                                    class="bi bi-arrow-left m-1"></i>Volta</a>

                        </div>
                        <img src="../../img/FINANCE.png" alt="" class="logo my-3">
                        <h3 class="fw-bold">Crie sua Conta</h3>
                        <div class='col-md-7 col-12 my-3'>
                            <p class="text text-body-secondary text-center">
                                Junte-se a nós e comece a gerenciar suas finanças de forma fácil e eficiente.
                            </p>
                        </div>
                        <input-component label="Nome:" id-input="registerNome" col="col-md-7 col-12" required="true">
                            <template v-slot:input>
                                <input type="text" name="registerNome" id="registerNome"
                                    class="form-control border shadow-none"
                                    :class="(fetchError('name')) ? 'border-danger' : ''" placeholder="Digite seu nome."
                                    @input="(event) => { $store.dispatch('validateField', { name: event.target.value }); fetchError('name'); }"
                                    v-model="name" />
                                <span v-if="fetchError('name')" class="text-danger py-2">{{ fetchError('name') }}</span>
                            </template>
                        </input-component>
                        <input-component label="Email:" id-input="registerEmail" col="col-md-7 col-12" required="true">
                            <template v-slot:input>
                                <input type="email" name="registerEmail" id="registerEmail"
                                    class="form-control border shadow-none"
                                    :class="(errors.email) ? 'border-danger' : ''" placeholder="Digite seu e-mail."
                                    @input="valideEmail()" v-model="email" />
                                <span v-if="errors.email" class="text-danger py-2">{{ errors.email }}</span>

                            </template>
                        </input-component>
                        <input-component label="Senha:" id-input="registerPassword" class="col-md-7 col-12"
                            required="true">
                            <template v-slot:input>
                                <div class="input-group ">
                                    <input :type="typeInputPassword" name="registerPassword" id="registerPassword"
                                        @input="validePassword()" v-model="password"
                                        class="form-control border shadow-none"
                                        :class="!(passwordRequirements) ? 'border-danger' : ''"
                                        placeholder="Entre com sua senha." />
                                    <span class="input-group-text cursor-pointer" @click="changeTypeInput()">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                </div>
                                <span v-if="errors.senha" class="py-2">
                                    <p class="p-1 m-0"><span><i
                                                :class="(!errors.hasMinLength) ? 'bi bi-x-circle pe-1 text-danger' : 'bi bi-check-circle pe-1 text-success'"></i></span>Mínimo
                                        6 caracteres</p>
                                    <p class="p-1 m-0"><span><i
                                                :class="(!errors.hasNumber) ? 'bi bi-x-circle pe-1 text-danger' : 'bi bi-check-circle pe-1 text-success'"></i></span>Números
                                    </p>
                                    <p class="p-1 m-0"><span><i
                                                :class="(!errors.hasUpperCase) ? 'bi bi-x-circle pe-1 text-danger' : 'bi bi-check-circle pe-1 text-success'"></i></span>Letras
                                        maiúsculas</p>
                                    <p class="p-1 m-0"><span><i
                                                :class="(!errors.hasLowerCase) ? 'bi bi-x-circle pe-1 text-danger' : 'bi bi-check-circle pe-1 text-success'"></i></span>Letras
                                        minúsculas</p>
                                    <p class="p-1 m-0"><span><i
                                                :class="(!errors.hasSpecialChar) ? 'bi bi-x-circle pe-1 text-danger' : 'bi bi-check-circle pe-1 text-success'"></i></span>Caractere
                                        especial</p>
                                </span>

                            </template>
                        </input-component>
                        <div class='col-md-7 col-12 my-3'>
                            <button type="submit" class="btn btn-dark w-100"
                                :disabled="isSubmitDisabled">Registre-se</button>
                        </div>
                        <div class='col-md-7 col-12'>
                            <div class="d-flex align-items-center">
                                <hr class="flex-grow-1">
                                <span class="mx-2 text text-body-secondary fs-6">Ou registre-se com</span>
                                <hr class="flex-grow-1">
                            </div>
                        </div>
                        <div class="mb-3 d-flex">
                            <GoogleLogin :callback="registerWithGoogle"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" prompt
                                :button-config="{ text: 'signup_with', shape: 'circle' }" />
                        </div>
                    </template>
                </form-component>
            </div>
            <!-- <button class="btn btn-primary" @click="openModal">Abrir Modal</button> -->
            <modal-component id-modal="valideEmail" title-modal="Open your Finance" center-modal="true"
                size-modal="modal-lg" static-mogdal="true">
                <template v-slot:body>

                    <form-component form-id="frmValideEmail" :token="token"
                        class="d-flex flex-column align-items-center justify-content-center">
                        <template v-slot:body>
                            <h4 class="fw-bold">Verificação de segurança</h4>
                            <p class="text text-body-secondary text-center">Enviamos um código de segurança para o
                                e-mail:</p>
                            <h5 class="text fw-bold text-center mb-4">{{ email }}</h5>
                            <input-component id-input="verificationInput" col="0"
                                class="m-0 position-absolute top-0 start-0">
                                <template v-slot:input>
                                    <input type="text" v-model="verificationInput" ref="verificationInputRef"
                                        @input="verificationInputCod()" maxlength="5"
                                        class="form-control border shadow-none "
                                        style="opacity: 0; position: absolute; pointer-events: none;" />
                                </template>
                            </input-component>
                            <div class="d-flex flex-row align-items-center justify-content-center row">
                                <div v-for="(numberField, index) in numbersFields" :key="index"
                                    class="divVerification col mx-3 cardBoxVerification d-flex align-items-center justify-content-center"
                                    :id="'boxVerificarion-' + index" @click="validateCodigoEmail(index)">
                                    {{ verificationInput[index] ?? '' }}
                                </div>
                            </div>
                            <span v-if="errors.verificationCod" class="text-danger py-2 mt-2"
                                v-html="errors.verificationCod">
                            </span>
                            <div class='col-md-7 col-12 my-3'>
                                <button type="submit" class="btn btn-dark w-100 rounded-pill my-3"
                                    :disabled="verificationInput.length < 5">VALIDAR CÓDIGO</button>

                                <p class="mx-2 text text-body-secondary fs-6 d-flex justify-content-center"><strong>Não
                                        recebeu o
                                        código?&nbsp;</strong> <span v-if="!resendCode"> Aguarde {{ formattedTime }}s
                                    </span> <span v-if="resendCode"> <a href="#" @click.prevent="resendCodeEmail"
                                            class="link-outline-black">
                                            Reenviar
                                            Código</a></span></p>
                            </div>
                        </template>
                    </form-component>
                </template>
            </modal-component>
        </template>
    </card-component>
</template>

<script setup>
import { useRouter } from "vue-router";
const router = useRouter();

const registerWithGoogle = (response) => {
    console.log("Resposta:", response);
};
</script>
<script>

import ForgotPasswordComponent from './ForgotPasswordComponent.vue';
import { mapGetters } from 'vuex';
import { mapMutations } from 'vuex';


export default {
    props: ['token', 'routeRegister', 'routeCodeVerificationEmail', 'routeVerifiedEmail'],
    data() {
        return {
            typeInputPassword: 'password',
            errors: {},
            email: '',
            timer: 120,
            interval: null,
            verificationInput: '',
            isSubmitDisabled: false,
            codeVerification: '',
            passwordRequirements: true,
            resendCode: false,
            numbersFields: [1, 2, 3, 4, 5]
        }
    },
    components: {
        ForgotPasswordComponent
    }, computed: {
        ...mapGetters(['getErrors']),
        formattedTime() {
            const minutes = Math.floor(this.timer / 60);
            const seconds = this.timer % 60;
            return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        },
    },
    methods: {
        ...mapMutations(['openModal', 'getLoading', 'closeLoading', 'successAlert', 'closeModal']),

        fetchError(error) {
            return this.$store.getters.getErrors(error);
        },

        resendCodeEmail() {
            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            let url = this.routeCodeVerificationEmail;
            let formData = new FormData();
            formData.append('email', registerEmail.value);
            formData.append('name', registerNome.value);
            axios.post(url, formData, config)
                .then((response) => {
                    this.codeVerification = response.data.code_verification
                    this.successAlert("Código de verificação reenviado!");
                })
                .catch((errors) => {
                    let error = errors.response;
                    Object.keys(error).forEach(key => {
                        this.errors[key] = error[key][0];
                    });
                })
        },
        startTimer() {
            this.timer = 120;
            if (this.interval) clearInterval(this.interval);
            this.interval = setInterval(() => {
                if (this.timer > 1) {
                    this.timer--;
                } else {
                    clearInterval(this.interval);
                    this.resendCode = true;

                }
            }, 1000);
        },
        changeTypeInput() {
            this.typeInputPassword = this.typeInputPassword === 'text' ? 'password' : 'text';
        },

        validateCodigoEmail(id) {
            this.numbersFields.forEach(number => {
                number = number - 1;
                $("#boxVerificarion-" + number).removeClass("active-box-validate")
                if (number == id) {
                    $("#boxVerificarion-" + id).addClass("active-box-validate")
                }
            });
            this.$nextTick(() => {
                this.$refs.verificationInputRef.focus();
            });
        },
        verificationInputCod() {
            const lastNumberIndex = this.numbersFields.length - 1;

            for (let i = 0; i < this.numbersFields.length; i++) {
                const number = this.numbersFields[i] - 1;
                $("#boxVerificarion-" + number).removeClass("active-box-validate");
            }

            if (this.verificationInput.length === this.numbersFields.length) {
                $("#boxVerificarion-" + lastNumberIndex).addClass("active-box-validate");
                if (this.verificationInput == this.codeVerification) {
                    this.verifiedEmail();

                } else {
                    this.errors.verificationCod = '<strong>Não foi possível validar o seu código.</strong> Por favor, tente de novamente .';
                }
            } else {
                $("#boxVerificarion-" + this.verificationInput.length).addClass("active-box-validate");
            }
        },
        verifiedEmail() {
            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            let url = this.routeVerifiedEmail;
            let formData = new FormData();
            formData.append('email', registerEmail.value);
            axios.post(url, formData, config)
                .then((response) => {
                    this.successAlert("Seu e-mail foi verificado com sucesso. Agradecemos por confirmar sua conta!");
                    this.closeModal('valideEmail');
                    this.errors.verificationCod = '';
                    this.verificationInput = '';
                })
                .catch((errors) => {
                })
        },
        filterInput(event) {
            const value = event.target.value;
            if (value.length > 1 || (value && (value < 0 || value > 9))) {
                this.inputValue = value.slice(0, 1);
            } else {
                this.inputValue = value;
            }
        },
        validePassword() {
            this.passwordRequirements = false;
            this.$store.dispatch('validateField', { password: this.password });
            this.errors.senha = true;

            let promiseEmpty = this.$store.dispatch('empty', this.password);
            promiseEmpty.then((resultado) => {
                let isEmpty = resultado;
                this.errors.hasMinLength = (!isEmpty && this.password.length >= 6);
                this.errors.hasLowerCase = (!isEmpty && /[a-z]/.test(this.password));

            });
            this.errors.hasUpperCase = /[A-Z]/.test(this.password);
            this.errors.hasNumber = /\d/.test(this.password);
            this.errors.hasSpecialChar = /[\W_]/.test(this.password);
            this.passwordRequirements = (this.errors.hasMinLength == true && this.errors.hasSpecialChar == true && this.errors.hasLowerCase == true && this.errors.hasUpperCase == true && this.errors.hasNumber == true) ? true : false;
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
            this.isSubmitDisabled = (this.errors.email == '' && this.name != '' && this.email != '' && this.passwordRequirements) ? false : true;
        },
        formRegister(event) {
            this.getLoading();

            this.validePassword();
            this.valideEmail();
            this.$store.dispatch('validateField', { name: this.name });
            this.verificationInput = '';
            if (!this.isSubmitDisabled) {
                let config = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                };

                let url = this.routeRegister;
                let formData = new FormData();
                formData.append('email', registerEmail.value);
                formData.append('name', registerNome.value);
                formData.append('password', registerPassword.value);
                axios.post(url, formData, config)
                    .then((response) => {
                        this.codeVerification = response.data.code_verification
                        this.errors.verificationCod = '';
                        this.openModal('valideEmail');
                        this.closeLoading();
                        this.startTimer();
                    })
                    .catch((errors) => {
                        let error = errors.response.data.errors;
                        Object.keys(error).forEach(key => {
                            this.errors[key] = error[key][0];
                        });
                        this.closeLoading();
                    })
            } else {
                this.closeLoading();
            }

        },
    }
}
</script>
