<template>
    <v-app>
        <div class="col-12">
            <div class="card">
                <div class="card-header">Dados do usuário sd</div>

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
                                    v-model="userData.name"
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
                                    v-model="userData.email"
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
                                    v-model="userData.password"
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
                                    v-model="userData.password_confirmation"
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
                        <button class="btn btn-danger" @click="home">
                            Cancelar
                        </button>
                        <button class="btn btn-primary" @click="updateUser">
                            Atualizar usuário
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
    name: "editUser",
    props: {
        user: {
            required: true,
        },
    },
    data() {
        return {
            userData: JSON.parse(this.user),
            password: "",
            password_confirmation: "",
            menu1: false,
            menu2: false,
        };
    },
    methods: {
        updateUser() {
            if (!!this.password && this.password !== this.password_confirmation) {
                alert("As senhas não conferem");
                return;
            }

            let body = this.password ? { ...this.userData, password: this.password, password_confirmation: this.password_confirmation } : this.userData;

            axios
                .post("/users/update/" + this.userData.id, body)
                .then((response) => {
                    if (response.status === 200) {
                        window.location.href = "/";
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        home() {
            window.location.href = "/";
        },
    },
    mounted() {
        console.log(this.userData);
    },
};
</script>
