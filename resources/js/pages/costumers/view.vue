<template>
    <v-app class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Dados do básicos</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Nome</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="name" placeholder="Nome" type="text"
                                    v-model="costumer.name" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Telefone</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="phone" placeholder="Telefone" type="text"
                                    v-model="costumer.phone" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Data de nascimento</label>
                            <v-menu v-model="menu2" :close-on-content-click="false" transition="scale-transition"
                                max-width="290">
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field v-model="
                                        costumer.birth_date
                                            .split('-')
                                            .reverse()
                                            .join('/')
                                    " readonly v-bind="attrs" v-on="on" class="pt-0"></v-text-field>
                                </template>
                                <v-date-picker v-model="costumer.birth_date" no-title
                                    @input="menu2 = false"></v-date-picker>
                            </v-menu>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Estado civil</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="marital_status"
                                    placeholder="Estado Civil" type="text" v-model="costumer.marital_status" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-lock"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">RG</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="rg" placeholder="RG" type="text"
                                    v-model="costumer.rg" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">CPF</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="cpf" placeholder="CPF" type="text"
                                    v-model="costumer.cpf" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Escolaridade</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="schooling" placeholder="Escolaridade"
                                    type="text" v-model="costumer.schooling" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Profissão</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="occupation" placeholder="Profissão"
                                    type="text" v-model="costumer.occupation" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Salário</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="salary" placeholder="Salário"
                                    type="number" v-model="costumer.salary" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Renda familiar</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="family_income"
                                    placeholder="Renda Familiar" type="number" v-model="costumer.family_income" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">Endereço</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Rua</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="street" placeholder="Rua" type="text"
                                    v-model="address.street" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Número</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="number" placeholder="Número"
                                    type="string" v-model="address.number" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Bairro</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="neighborhood" placeholder="Bairro"
                                    type="text" v-model="address.neighborhood" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Cidade</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="city" placeholder="Cidade" type="text"
                                    v-model="address.city" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Estado</label>
                            <div class="wrap-input100">
                                <input
                                    :class="'input100 form-control '"
                                    name="state"
                                    placeholder="Estado"
                                    type="text"
                                    v-model="address.state"
                                    maxlength="2"
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

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">CEP</label>
                            <div class="wrap-input100">
                                <input
                                    :class="'input100 form-control '"
                                    name="cep"
                                    placeholder="CEP"
                                    type="text"
                                    v-model="address.cep"
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
                    </div> -->

                    <div class="row">
                        <!-- <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Complemento</label>
                            <div class="wrap-input100">
                                <input
                                    :class="'input100 form-control '"
                                    name="complement"
                                    placeholder="Complemento"
                                    type="text"
                                    v-model="address.complement"
                                />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i
                                        aria-hidden="true"
                                        class="mdi mdi-account"
                                    ></i>
                                </span>
                            </div>
                        </div> -->

                        <div class="col-12 col-md-12 mb-3">
                            <label class="form-label">Referência</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="reference" placeholder="Referência"
                                    type="text" v-model="address.reference" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">Grupo familiar</div>

                <div class="card-body">
                    <div v-for="relative in relatives" class="row">
                        <div class="col-12 col-md-4 mb-3">
                            <label class="form-label">Nome</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="relative_name" placeholder="Nome"
                                    type="text" v-model="relative.name" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mb-3">
                            <label class="form-label">Parentesco</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="relative_relationship"
                                    placeholder="Parentesco" type="text" v-model="relative.relationship" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mb-3">
                            <label class="form-label">Idade</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="relative_age" placeholder="Idade"
                                    type="text" v-model="relative.age" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mb-3">
                            <label class="form-label">Profissão</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="occupation"
                                    placeholder="Profissão" type="text" v-model="relative.occupation" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mb-3">
                            <label class="form-label">Salário</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="relative_salary" placeholder="Salário"
                                    type="text" v-model="relative.salary" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">
                    Benefícios de transferência de renda
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-2">
                            <input type="checkbox" id="checkCadastroUnico" v-model="costumer.cadastro_unico" />
                            <label for="checkCadastroUnico">Cadastro Único</label>
                        </div>
                        <div class="col-12 col-md-2">
                            <input type="checkbox" id="checkBolsaFamilia" v-model="costumer.bolsa_familia" />
                            <label for="checkBolsaFamilia">Bolsa Família</label>
                        </div>
                        <div class="col-12 col-md-2">
                            <input type="checkbox" id="checkPrestacaoContinuada"
                                v-model="costumer.prestacao_continuada" />
                            <label for="checkPrestacaoContinuada">Prestação Continuada</label>
                        </div>
                        <div class="col-12 col-md-2">
                            <input type="checkbox" id="checkRendaCidada" v-model="costumer.renda_cidada" />
                            <label for="checkRendaCidada">Renda Cidadã</label>
                        </div>
                        <div class="col-12 col-md-2">
                            <input type="checkbox" id="checkCestaBasica" v-model="costumer.cesta_basica" />
                            <label for="checkCestaBasica">Cesta Básica</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">Situação de saúde</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4 mb-3">
                            <label class="form-label">Doenças crônicas</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="chronicDiseases"
                                    placeholder="Doenças Crônicas" type="text"
                                    v-model="healthSituation.chronicDiseases" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 mb-3">
                            <label class="form-label">Vícios</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="vices" placeholder="Vícios" type="text"
                                    v-model="healthSituation.vices" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">Habitação</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-2">
                            <input type="radio" id="radioRented" value="rented" v-model="habitation.ownership" />
                            <label for="radioRented">Alugada</label>
                        </div>

                        <div class="col-12 col-md-2">
                            <input type="radio" id="radioOwned" value="owned" v-model="habitation.ownership" />
                            <label for="radioOwned">Própria</label>
                        </div>
                        <div class="col-12 col-md-2">
                            <input type="radio" id="radioGived" value="gived" v-model="habitation.ownership" />
                            <label for="radioGived">Cedida</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col md-6">
                            <label class="form-label" for="habitationCondition">Condição</label>
                            <input :class="'input100 form-control '" type="text" id="habitationCondition"
                                name="habitationCondition" placeholder="Condição" v-model="habitation.conditions" />
                        </div>
                        <div v-if="habitation.ownership === 'rented'" class="col-12 col-md-6">
                            <input :class="'input100 form-control '" name="value" placeholder="Valor do aluguel"
                                type="number" v-model="habitation.value" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">Observações adicionais</div>
                <div class="card-body">
                    <div class="row">
                        <textarea :class="'form-control'" placeholder="Digite as observações aqui..."
                            rows="4" v-model="observations.observation" ></textarea>
                    </div>
                </div>
            </div>

            <!-- <div class="mt-5 pb-5 d-flex align-items-center justify-content-between mx-10">
                <button class="btn btn-danger" @click="home">Cancelar</button>
                <button class="btn btn-primary" @click="createCostumer">
                    Inserir usuário
                </button>
            </div> -->
        </div>
    </v-app>
</template>

<script>
export default {
    name: "viewCosumer",
    props: {
        data: String
    },
    data() {
        return {
            costumer: {},
            address: {},
            relatives: {},
            healthSituation: {},
            habitation: {},
            observations: {},

            menu2: false,
        };
    },
    methods: {
        home() {
            window.location.href = "/";
        }
    },
    mounted() {
        let personsData = JSON.parse(this.data)
        this.costumer = personsData.costumer
        this.address = personsData.address
        this.relatives = personsData.familyGroup
        this.healthSituation = personsData.healthSituation
        this.habitation = personsData.habitation
        this.observations = personsData.observations

        console.log(personsData)
    },
};
</script>
