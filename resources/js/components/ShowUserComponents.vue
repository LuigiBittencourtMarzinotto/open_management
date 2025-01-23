<template>
    <card-component class="m-5 d-flex col-lg-10 shadow border-radius-card">
        <template v-slot:body>
            <form-component form-id="frmLogin" :token="token" class="d-flex align-items-center"
                @submit.prevent="formRegister($event)">
                <template v-slot:body>
                    <div class="col-lg-12 col-12 p-3">
                        <div class="row justify-content-center">
                            <input-component label="Nome:" id-input="name" col="col-md-4 col-12" required="true">
                                <template v-slot:input>
                                    <input type="text" name="registername" id="registername"
                                        class="form-control border shadow-none"
                                        :class="(fetchError('name')) ? 'border-danger' : ''"
                                        placeholder="Digite seu nome:"
                                        @input="(event) => { $store.dispatch('validateField', { name: event.target.value }); fetchError('name'); }"
                                        v-model="name" />
                                    <span v-if="fetchError('name')" class="text-danger py-2">{{ fetchError('name')
                                        }}</span>
                                </template>
                            </input-component>

                            <input-component label="Email:" id-input="email" col="col-md-5 col-12" required="true">
                                <template v-slot:input>
                                    <input type="email" name="email" id="email" class="form-control border shadow-none"
                                        :class="(fetchError('email')) ? 'border-danger' : ''"
                                        placeholder="Digite seu E-mail:" @input="valideEmail()" v-model="email" />
                                    <span v-if="fetchError('email')" class="text-danger py-2">{{ fetchError('email')
                                        }}</span>
                                </template>
                            </input-component>

                            <input-component label="Selecione Tipo de Usuário:" id-input="user_tipo"
                                col="col-md-3 col-12" required="true">
                                <template v-slot:input>
                                    <div class="input-group">
                                        <select name="user_tipo" id="user_tipo" class="form-select border shadow-none"
                                            :class="(fetchError('user_tipo')) ? 'border-danger' : ''"
                                            v-model="user_tipo">
                                            <option value="0">Usuário Normal</option>
                                            <option value="1">Admin</option>
                                        </select>
                                    </div>
                                    <span v-if="fetchError('user_tipo')" class="text-danger py-2">
                                        {{ fetchError('user_tipo') }}
                                    </span>
                                </template>
                            </input-component>


                            <input-component label="CEP:" id-input="cep" col="col-md-3 col-12" required="true"
                                maxlength="9">
                                <template v-slot:input>
                                    <div class="input-group">
                                        <input type="text" name="cep" id="cep" class="form-control border shadow-none"
                                            :class="(fetchError('cep')) ? 'border-danger' : ''"
                                            placeholder="Digite seu CEP:"
                                            @input="mascararCEP(), (event) => { $store.dispatch('validateField', { cep: event.target.value }); fetchError('cep'); }"
                                            v-model="cep" />
                                        <span class="input-group-text cursor-pointer">
                                            <i :class="iconCEP"></i>
                                        </span>
                                    </div>
                                    <span v-if="fetchError('cep')" class="text-danger py-2">{{ fetchError('cep')
                                        }}</span>
                                </template>
                            </input-component>

                            <input-component label="UF:" id-input="uf" col="col-md-3 col-12" required="true">
                                <template v-slot:input>
                                    <input type="text" name="uf" id="uf" class="form-control border shadow-none"
                                        :class="(fetchError('uf')) ? 'border-danger' : ''" placeholder="Digite seu UF:"
                                        @input="(event) => { $store.dispatch('validateField', { uf: event.target.value }); fetchError('uf'); }"
                                        v-model="uf" />
                                    <span v-if="fetchError('uf')" class="text-danger py-2">{{ fetchError('uf') }}</span>
                                </template>
                            </input-component>

                            <input-component label="Cidade:" id-input="cidade" col="col-md-6 col-12" required="true">
                                <template v-slot:input>
                                    <input type="text" name="cidade" id="cidade" class="form-control border shadow-none"
                                        :class="(fetchError('cidade')) ? 'border-danger' : ''"
                                        placeholder="Digite sua Cidade:"
                                        @input="(event) => { $store.dispatch('validateField', { cidade: event.target.value }); fetchError('cidade'); }"
                                        v-model="cidade" />
                                    <span v-if="fetchError('cidade')" class="text-danger py-2">{{ fetchError('cidade')
                                        }}</span>
                                </template>
                            </input-component>

                            <input-component label="Bairro:" id-input="bairro" col="col-md-4 col-12" required="true">
                                <template v-slot:input>
                                    <input type="text" name="bairro" id="bairro" class="form-control border shadow-none"
                                        :class="(fetchError('bairro')) ? 'border-danger' : ''"
                                        placeholder="Digite seu Bairro:"
                                        @input="(event) => { $store.dispatch('validateField', { bairro: event.target.value }); fetchError('bairro'); }"
                                        v-model="bairro" />
                                    <span v-if="fetchError('bairro')" class="text-danger py-2">{{ fetchError('bairro')
                                        }}</span>
                                </template>
                            </input-component>

                            <input-component label="Endereço:" id-input="logradouro" col="col-md-5 col-12"
                                required="true">
                                <template v-slot:input>
                                    <input type="text" name="logradouro" id="logradouro"
                                        class="form-control border shadow-none"
                                        :class="(fetchError('logradouro')) ? 'border-danger' : ''"
                                        placeholder="Digite seu Endereço:"
                                        @input="(event) => { $store.dispatch('validateField', { logradouro: event.target.value }); fetchError('logradouro'); }"
                                        v-model="logradouro" />
                                    <span v-if="fetchError('logradouro')" class="text-danger py-2">{{
                                        fetchError('logradouro') }}</span>
                                </template>
                            </input-component>

                            <input-component label="N°:" id-input="numero" col="col-md-3 col-12" required="true">
                                <template v-slot:input>
                                    <input type="text" name="numero" id="numero" class="form-control border shadow-none"
                                        :class="(fetchError('numero')) ? 'border-danger' : ''" placeholder="N°:"
                                        @input="(event) => { $store.dispatch('validateField', { numero: event.target.value }); fetchError('numero'); }"
                                        v-model="numero" />
                                    <span v-if="fetchError('numero')" class="text-danger py-2">{{ fetchError('numero')
                                        }}</span>
                                </template>
                            </input-component>
                            <div class='col-md-7 col-12 my-3 '>
                                <button type="button" class="btn btn-dark w-100 rounded-pill my-3"
                                    @click="sendFormUpdateUser()">SALVAR</button>
                            </div>
                        </div>
                    </div>
                </template>
            </form-component>
        </template>
    </card-component>

</template>
<script>

import ForgotPasswordComponent from './ForgotPasswordComponent.vue';
import { mapGetters } from 'vuex';
import { mapMutations } from 'vuex';


export default {
    props: ['token', 'codigoUser', "routeUser", "routeVerifiedCep"],
    data() {
        return {
            typeInputPassword: 'password',
            errors: {},
            formData: ["name", "email", "cep", "cidade", "uf", "bairro", "logradouro", "numero", "user_tipo"],
            name: '',
            email: '',
            cep: '',
            cidade: '',
            uf: '',
            bairro: '',
            logradouro: '',
            numero: '',
            user_tipo: '0',
            timer: 120,
            interval: null,
            iconCEP: 'bi bi-exclamation-triangle text-danger',
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
            return this.$store.getters.getErrors(error) ?? "";
        },

        mascararCEP() {
            let valor = this.cep.replace(/\D/g, '');
            if (valor.length > 5) {
                valor = valor.slice(0, 5) + '-' + valor.slice(5, 8);
            }
            this.cep = valor;
            if (valor.length > 8) {
                this.getLocationByCEP();
            } else {
                this.uf = "";
                this.cidade = "";
                this.bairro = "";
                this.logradouro = "";
                this.iconCEP = "bi bi-exclamation-triangle text-danger";
            }
        },

        getLocationByCEP() {
            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            let url = this.routeVerifiedCep;
            let formData = new FormData();
            formData.append('cep', this.cep);
            axios.post(url, formData, config)
                .then((response) => {
                    var dataCep = response.data;
                    this.uf = dataCep.uf;
                    this.cidade = dataCep.localidade;
                    this.bairro = dataCep.bairro;
                    this.logradouro = dataCep.logradouro;
                    this.iconCEP = 'bi bi-check-lg text-success';
                })
                .catch((errors) => {
                    console.log(errors)
                })
        },
        isObject(value) {
            return value !== null && typeof value === 'object' && !Array.isArray(value);
        },
        getDataUser() {
            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            let url = this.routeUser;
            let formData = new FormData();
            axios.get(url, formData, config)
                .then((response) => {
                    let data = response.data;
                    Object.keys(data).forEach(element => {
                        this[element] = data[element]
                        if (this.isObject(data[element])) {
                            Object.keys(data[element]).forEach(elementlogradouro => {
                                if (elementlogradouro == 'cep') {
                                    this.iconCEP = "bi bi-check-lg text-success";
                                }
                                this[elementlogradouro] = data[element][elementlogradouro]

                            });
                        }


                    });
                })
                .catch((errors) => {
                    console.log(errors)
                })
        },
        sendFormUpdateUser() {
            let data = {};
            let config = {
                headers: {
                    "Content-Type": "application/json",
                },
            };
            let hasError = false;
            let url = this.routeUser;
            this.formData.forEach(element => {
                this.$store.dispatch('validateField', { [element]: this[element] });
                data[element] = this[element];
                hasError = (this.fetchError(element) == '') ? hasError : true;
            });
            if (!hasError) {
                axios.put(url, JSON.stringify(data), config)
                    .then((response) => {
                        this.successAlert("Dados atualizados com sucesso!")
                        window.location.reload();
                    })
                    .catch((errors) => {
                        console.log(errors)

                    })
            }
        }

    },
    mounted() {

        this.getDataUser();
    }
}
</script>