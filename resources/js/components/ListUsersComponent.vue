<template>
    <card-component class="m-5 d-flex col-lg-10 shadow border-radius-card">
        <template v-slot:body>
            <div class="table-responsive">
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">CEP</th>
                            <th scope="col">UF</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">Bairro</th>
                            <th scope="col">Logradouro</th>
                            <th scope="col">N°</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="(user, index) in users" :key="user.id">
                            <th scope="row">{{ user.id }}</th>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.endereco_user.cep }}</td>
                            <td>{{ user.endereco_user.uf }}</td>
                            <td>{{ user.endereco_user.cidade }}</td>
                            <td>{{ user.endereco_user.bairro }}</td>
                            <td>{{ user.endereco_user.logradouro }}</td>
                            <td>{{ user.endereco_user.numero }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
            users: []
        };
    },
    components: {
        ForgotPasswordComponent
    },
    computed: {
        ...mapGetters(['getErrors']),
        formattedTime() {
            const minutes = Math.floor(this.timer / 60);
            const seconds = this.timer % 60;
            return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        },
    },
    methods: {
        ...mapMutations(['openModal', 'getLoading', 'closeLoading', 'successAlert', 'closeModal']),
        getDataUsers() {
            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            let url = this.routeUser;

            axios
                .get(url, config)
                .then((response) => {
                    this.users = response.data;
                    console.log(response)
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
    },
    mounted() {
        this.getDataUsers();
    }
};
</script>
