<template>
    <div class="col-12">
        <div class="card">
            <div class="card-header">Dados do usuário</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label">Nome</label>
                        <div class="wrap-input100">
                            <input
                                :class="'input100 form-control ' + errors.name"
                                name="name"
                                placeholder="Nome"
                                type="text"
                                
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
                                :class="'input100 form-control ' + errors.email"
                                name="email"
                                placeholder="E-mail"
                                type="text"
                                
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
                                :class="
                                    'input100 form-control ' +
                                    errors.password_confirmation
                                "
                                name="password"
                                placeholder="Senha"
                                type="password"
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
                        <label class="form-label">Confirmação de senha</label>
                        <div class="wrap-input100">
                            <input
                                :class="
                                    'input100 form-control ' +
                                    errors.password_confirmation
                                "
                                name="password_confirmation"
                                placeholder="Confirmação de senha"
                                type="password"
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
                    <button class="btn btn-primary" @click="createCostumer">
                        Inserir usuário
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CreateCostumer",
    data() {
        return {
            errors: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
        };
    },
    methods: {
        home() {
            window.location.href = '/';
        }
    },
};
</script>
