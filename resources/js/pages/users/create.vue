<template>
    <v-app>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Dados do usuário
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label">Nome</label>
                            <div class="wrap-input100">
                                <input :class="('input100 form-control ' + errors.name)" name="name" placeholder="Nome"
                                    type="text" v-model="user.name">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label">E-mail</label>
                            <div class="wrap-input100">
                                <input :class="('input100 form-control ' + errors.email)" name="email"
                                    placeholder="E-mail" type="text" v-model="user.email">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label">Senha</label>
                            <div class="wrap-input100">
                                <input :class="('input100 form-control ' + errors.password_confirmation)" name="password"
                                    placeholder="Senha" type="password" v-model="user.password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-lock"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label">Confirmação de senha</label>
                            <div class="wrap-input100">
                                <input :class="('input100 form-control ' + errors.password_confirmation)"
                                    name="password_confirmation" placeholder="Confirmação de senha" type="password"
                                    v-model="user.password_confirmation">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-lock"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 d-flex align-items-center justify-content-between mx-10">
                        <button class="btn btn-danger" @click="home">
                            Cancelar
                        </button>
                        <button class="btn btn-primary" @click="createUser">
                            Inserir usuário
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </v-app>

</template>
<script>
import axios from 'axios';

export default {
    name: 'UsersCreate',
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            menu1: false,
            menu2: false,
            errors: {
                name: '',
                email: '',
                password_confirmation: '',
            }
        }
    },
    methods: {
        createUser() {
            let loader = this.$loading.show();
            this.resetErrorFields();

            axios.post('/users/insert', this.user)
                .then(response => {
                    console.log(response);
                    window.location.href = '/';
                    loader.hide();
                })
                .catch(error => {
                    loader.hide();
                    this.getErrors(error.response.data.errors);
                    let errors = Object.values(error.response.data.errors);
                    errors.forEach(error => {
                        this.$toast.error(error[0]);
                    });
                });
        },
        home() {
            window.location.href = '/';
        },
        getErrors(err) {
            let errors = Object.keys(err);
            errors.forEach(error => {
                this.errors[error] = 'is-invalid state-invalid';
            });
        },
        resetErrorFields() {
            this.errors = {
                name: '',
                email: '',
                password_confirmation: '',
            }
        }
    }

}
</script>