<template>
    <v-app>
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ title }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label">Nome</label>
                            <div class="wrap-input100">
                                <input
                                    :class="'input100 form-control '"
                                    name="name"
                                    placeholder="Nome"
                                    type="text"
                                    v-model="form.name"
                                />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i
                                        aria-hidden="true"
                                        class="mdi mdi-account"
                                    ></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label">E-mail</label>
                            <div class="wrap-input100">
                                <input
                                    :class="'input100 form-control '"
                                    name="email"
                                    placeholder="E-mail"
                                    type="text"
                                    v-model="form.email"
                                />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i
                                        aria-hidden="true"
                                        class="zmdi zmdi-email"
                                    ></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label">Senha</label>
                            <div class="wrap-input100">
                                <input
                                    :class="'input100 form-control '"
                                    name="password"
                                    placeholder="Senha"
                                    type="password"
                                    v-model="form.password"
                                />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i
                                        aria-hidden="true"
                                        class="zmdi zmdi-lock"
                                    ></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label"
                                >Confirmação de senha</label
                            >
                            <div class="wrap-input100">
                                <input
                                    :class="'input100 form-control '"
                                    name="password_confirmation"
                                    placeholder="Confirmação de senha"
                                    type="password"
                                    v-model="form.password_confirmation"
                                />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i
                                        aria-hidden="true"
                                        class="zmdi zmdi-lock"
                                    ></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="mt-3 d-flex align-items-center justify-content-between mx-10"
                    >
                        <button class="btn btn-danger" @click="cancel">
                            Cancelar
                        </button>
                        <button class="btn btn-primary" @click="submit">
                            {{ buttonText }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </v-app>
</template>

<script>
import axios from "axios";

export default {
    name: "UserForm",
    props: {
        user: {
            type: Object,
            default: null,
        },
    },
    data() {
        return {
            form: this.user ? { ...this.user } : {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
        };
    },
    computed: {
        isEditMode() {
            return !!this.user;
        },
        title() {
            return this.isEditMode ? "Editar dados do usuário" : "Cadastrar novo usuário";
        },
        buttonText() {
            return this.isEditMode ? "Atualizar usuário" : "Salvar usuário";
        },
        submissionUrl() {
            return this.isEditMode ? `/users/update/${this.user.id}` : "/users/insert";
        }
    },
    methods: {
        submit() {
            if (this.form.password !== this.form.password_confirmation) {
                this.$toast.open({
                    message: "As senhas não conferem.",
                    type: "error",
                });
                return;
            }

            axios
                .post(this.submissionUrl, this.form)
                .then((response) => {
                    if (response.status === 200 || response.status === 201) {
                         this.$toast.open({
                            message: "Usuário salvo com sucesso!",
                            type: "success",
                        });
                        setTimeout(() => {
                            window.location.href = "/users";
                        }, 2000);
                    }
                })
                .catch((error) => {
                    let message = "Ocorreu um erro ao salvar o usuário.";
                    if (error.response && error.response.data && error.response.data.message) {
                        message = error.response.data.message;
                    }
                    this.$toast.open({
                        message: message,
                        type: "error",
                    });
                    console.log(error);
                });
        },
        cancel() {
            window.location.href = "/users";
        },
    },
};
</script>
