<template>
    <div class="bg-white">
        <navbarVue />
        <div class="container">
            <div class="mb-3">
                <div>
                    Nome: <h2 class="d-inline">{{ costumer.name }}</h2>
                </div>
                <div>
                    Telefone: <h5 class="d-inline">{{ costumer.phone }}</h5>
                </div>

                <div class="float-end">
                    <button class="btn btn-danger" @click="deleteCostumer">Excluir</button>
                </div>
            </div>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Histórico</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Ficha
                        cadastral</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                    tabindex="0">
                    <v-app class="mt-3">
                        <v-data-table
                            :headers="[{ text: 'Data', value: 'created_at' }, { text: 'Horário', value: 'time' }, { text: 'Observação', value: 'observation' }]"
                            :items="reedeems" class="elevation-1">
                            <template v-slot:item.created_at="{ item }">
                                {{ new Date(item.created_at).toLocaleDateString("pt-br") }}
                            </template>
                            <template v-slot:item.time="{ item }">
                                {{
                                    new Date(item.created_at).toLocaleTimeString("pt-br").split(":").slice(0,
                                        2).join("h")
                                }}
                            </template>
                        </v-data-table>
                    </v-app>
                </div>



                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                    tabindex="0">
                    <v-app class="mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div>
                                        Dados do básicos
                                    </div>
                                    <div>
                                        <button id="costumerEdit" class="text-primary"
                                            @click="editCostumer">Editar</button>
                                        <button id="costumerSave" class="btn btn-success" style="display: none;"
                                            @click="saveCostumer">Salvar</button>
                                        <button id="costumerCancel" class="btn btn-danger" style="display: none;"
                                            @click="cancelEditCostumer">Cancelar</button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Nome</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control costumerGroup'"
                                                    name="name" placeholder="Nome" type="text"
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
                                                <input disabled :class="'input100 form-control costumerGroup'"
                                                    name="phone" placeholder="Telefone" type="text"
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
                                            <input disabled type="text" class="form-control"
                                                :value="costumer.birth_date">
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Estado civil</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control costumerGroup'"
                                                    name="marital_status" placeholder="Estado Civil" type="text"
                                                    v-model="costumer.marital_status" />
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
                                                <input disabled :class="'input100 form-control costumerGroup'" name="rg"
                                                    placeholder="RG" type="text" v-model="costumer.rg" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">CPF</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control costumerGroup'"
                                                    name="cpf" placeholder="CPF" type="text" v-model="costumer.cpf" />
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
                                                <input disabled :class="'input100 form-control costumerGroup'"
                                                    name="schooling" placeholder="Escolaridade" type="text"
                                                    v-model="costumer.schooling" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Profissão</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control costumerGroup'"
                                                    name="occupation" placeholder="Profissão" type="text"
                                                    v-model="costumer.occupation" />
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
                                                <input disabled :class="'input100 form-control costumerGroup'"
                                                    name="salary" placeholder="Salário" type="number"
                                                    v-model="costumer.salary" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Renda familiar</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control costumerGroup'"
                                                    name="family_income" placeholder="Renda Familiar" type="number"
                                                    v-model="costumer.family_income" />
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
                                <div class="card-header d-flex justify-content-between">
                                    <div>
                                        Endereço
                                    </div>
                                    <div>
                                        <button id="addressEdit" class="text-primary"
                                            @click="editAddress">Editar</button>
                                        <button id="addressSave" class="btn btn-success" style="display: none;"
                                            @click="saveAddress">Salvar</button>
                                        <button id="addressCancel" class="btn btn-danger" style="display: none;"
                                            @click="cancelEditAddress">Cancelar</button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">CEP</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control addressGroup'" name="cep"
                                                    placeholder="CEP" type="text" v-model="address.cep" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Rua</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control addressGroup'"
                                                    name="street" placeholder="Rua" type="text"
                                                    v-model="address.street" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Número</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control addressGroup'"
                                                    name="number" placeholder="Número" type="string"
                                                    v-model="address.number" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Bairro</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control addressGroup'"
                                                    name="neighborhood" placeholder="Bairro" type="text"
                                                    v-model="address.neighborhood" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Cidade</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control addressGroup'"
                                                    name="city" placeholder="Cidade" type="text"
                                                    v-model="address.city" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Estado</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control addressGroup'"
                                                    name="state" placeholder="Estado" type="text"
                                                    v-model="address.state" maxlength="2" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="mdi mdi-account"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-12 mb-3">
                                            <label class="form-label">Referência</label>
                                            <div class="wrap-input100">
                                                <input disabled :class="'input100 form-control '" name="reference"
                                                    placeholder="Referência" type="text" v-model="address.reference" />
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
                                <div class="card-header d-flex justify-content-between">
                                    <div>
                                        Grupo familiar
                                    </div>
                                    <div>
                                        <button id="relativesEdit" class="text-primary"
                                            @click="editRelatives">Editar</button>
                                        <button id="relativesSave" class="btn btn-success" style="display: none;"
                                            @click="saveRelatives">Salvar</button>
                                        <button id="relativesCancel" class="btn btn-danger" style="display: none;"
                                            @click="cancelEditRelatives">Cancelar</button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div v-for="relative in relatives" class="row">
                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label">Nome</label>
                                            <div class="wrap-input100">
                                                <input :disabled="viewMode"
                                                    :class="'input100 form-control relativesGroup'" name="relative_name"
                                                    placeholder="Nome" type="text" v-model="relative.name" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-2 mb-3">
                                            <label class="form-label">Parentesco</label>
                                            <div class="wrap-input100">
                                                <input :disabled="viewMode"
                                                    :class="'input100 form-control relativesGroup'"
                                                    name="relative_relationship" placeholder="Parentesco" type="text"
                                                    v-model="relative.relationship" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2 mb-3">
                                            <label class="form-label">Idade</label>
                                            <div class="wrap-input100">
                                                <input :disabled="viewMode"
                                                    :class="'input100 form-control relativesGroup'" name="relative_age"
                                                    placeholder="Idade" type="text" v-model="relative.age" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2 mb-3">
                                            <label class="form-label">Profissão</label>
                                            <div class="wrap-input100">
                                                <input :disabled="viewMode"
                                                    :class="'input100 form-control relativesGroup'" name="occupation"
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
                                                <input :disabled="viewMode"
                                                    :class="'input100 form-control relativesGroup'"
                                                    name="relative_salary" placeholder="Salário" type="text"
                                                    v-model="relative.salary" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="relativesAdd" class="row" style="display: none;">
                                        <div class="col-12 text-center">
                                            <a class="text-primary" @click="addRelative">Adicionar mais parentes</a>
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
                                            <input disabled type="checkbox" id="checkCadastroUnico"
                                                v-model="costumer.cadastro_unico" />
                                            <label for="checkCadastroUnico">Cadastro Único</label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input disabled type="checkbox" id="checkBolsaFamilia"
                                                v-model="costumer.bolsa_familia" />
                                            <label for="checkBolsaFamilia">Bolsa Família</label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input disabled type="checkbox" id="checkPrestacaoContinuada"
                                                v-model="costumer.prestacao_continuada" />
                                            <label for="checkPrestacaoContinuada">Prestação Continuada</label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input disabled type="checkbox" id="checkRendaCidada"
                                                v-model="costumer.renda_cidada" />
                                            <label for="checkRendaCidada">Renda Cidadã</label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input disabled type="checkbox" id="checkCestaBasica"
                                                v-model="costumer.cesta_basica" />
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
                                                <input v-if="!!healthSituation" disabled
                                                    :class="'input100 form-control '" name="chronicDiseases"
                                                    placeholder="Doenças Crônicas" type="text"
                                                    v-model="healthSituation.chronic_diseases" />
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label">Vícios</label>
                                            <div class="wrap-input100">
                                                <input v-if="!!healthSituation" disabled
                                                    :class="'input100 form-control '" name="vices" placeholder="Vícios"
                                                    type="text" v-model="healthSituation.vices" />
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
                                            <input disabled type="radio" id="radioRented" value="rented"
                                                v-model="habitation.ownership" />
                                            <label for="radioRented">Alugada</label>
                                        </div>

                                        <div class="col-12 col-md-2">
                                            <input disabled type="radio" id="radioOwned" value="owned"
                                                v-model="habitation.ownership" />
                                            <label for="radioOwned">Própria</label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input disabled type="radio" id="radioGived" value="gived"
                                                v-model="habitation.ownership" />
                                            <label for="radioGived">Cedida</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col md-6">
                                            <label class="form-label" for="habitationCondition">Condição</label>
                                            <input disabled :class="'input100 form-control '" type="text"
                                                id="habitationCondition" name="habitationCondition"
                                                placeholder="Condição" v-model="habitation.condition" />
                                        </div>
                                        <div v-if="habitation.ownership === 'rented'" class="col-12 col-md-6">
                                            <label class="form-label">Valor do aluguel</label>
                                            <input disabled :class="'input100 form-control '" name="value"
                                                placeholder="Valor do aluguel" type="number"
                                                v-model="habitation.value" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-5">
                                <div class="card-header">Observações adicionais</div>
                                <div class="card-body">
                                    <div class="row">
                                        <textarea v-if="!!observations" disabled :class="'form-control'"
                                            placeholder="Digite as observações aqui..." rows="4"
                                            v-model="observations.observation"></textarea>
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
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import navbarVue from '../../components/navbar.vue';
export default {
    name: "viewCosumer",
    props: {
        data: String
    },
    components: {
        navbarVue
    },
    data() {
        return {
            personsData: {},
            costumer: {},
            address: {},
            relatives: {},
            healthSituation: {},
            habitation: {},
            observations: {},
            reedeems: [],
            viewMode: true,
        };
    },
    methods: {
        home() {
            window.location.href = "/";
        },

        deleteCostumer() {

            let confirmation = confirm("Deseja realmente excluir este usuário?");

            if (!confirmation) {
                return;
            }

            axios
                .delete("/costumers/" + this.costumer.id)
                .then((response) => {
                    this.home();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addRelative() {
            this.relatives.push({
                name: "",
                relationship: "",
                age: "",
                occupation: "",
                salary: "",
                costumer_id: this.costumer.id
            });
        },
        editCostumer() {
            $("#costumerEdit").hide();
            $("#costumerSave").show();
            $("#costumerCancel").show();
            $('.costumerGroup').removeAttr('disabled');
        },
        saveCostumer() {
            axios
                .put("/costumers/" + this.costumer.id, {
                    costumer: this.costumer
                })
                .then((response) => {
                    $("#costumerEdit").show();
                    $("#costumerSave").hide();
                    $("#costumerCancel").hide();
                    $('.costumerGroup').attr('disabled', 'disabled');
                    this.personsData.costumer = { ...this.costumer };
                    this.$toast.success("Usuário atualizado com sucesso!");
                })
                .catch((error) => {
                    console.log(error);
                    this.$toast.error(error.response.data.errors[Object.keys(error.response.data.errors)[0]][0]);
                    this.cancelEditCostumer();
                });
        },
        cancelEditCostumer() {
            $("#costumerEdit").show();
            $("#costumerSave").hide();
            $("#costumerCancel").hide();
            $('.costumerGroup').attr('disabled', 'disabled');
            console.log(this.personsData.costumer)
            this.costumer = { ...this.personsData.costumer };
        },
        editAddress() {
            $("#addressEdit").hide();
            $("#addressSave").show();
            $("#addressCancel").show();
            $('.addressGroup').removeAttr('disabled');
        },
        saveAddress() {
            axios
                .put("/costumers/" + this.costumer.id, {
                    address: this.address
                })
                .then((response) => {
                    $("#addressEdit").show();
                    $("#addressSave").hide();
                    $("#addressCancel").hide();
                    $('.addressGroup').attr('disabled', 'disabled');
                    this.personsData.address = { ...this.address };
                    this.$toast.success("Endereço atualizado com sucesso!");
                })
                .catch((error) => {
                    console.log(error);
                    this.$toast.error(error.response.data.errors[Object.keys(error.response.data.errors)[0]][0]);
                    this.cancelEditAddress();
                });
        },
        cancelEditAddress() {
            $("#addressEdit").show();
            $("#addressSave").hide();
            $("#addressCancel").hide();
            $('.addressGroup').attr('disabled', 'disabled');
            this.address = { ...this.personsData.address };
            this.viewMode = true;
        },
        editRelatives() {
            $("#relativesEdit").hide();
            $("#relativesSave").show();
            $("#relativesCancel").show();
            $('#relativesAdd').show();
            $('.relativesGroup').removeAttr('disabled');
            this.viewMode = false;
        },
        saveRelatives() {
            axios
                .put("/costumers/" + this.costumer.id, {
                    relatives: this.relatives
                })
                .then((response) => {
                    $("#relativesEdit").show();
                    $("#relativesSave").hide();
                    $("#relativesCancel").hide();
                    $('#relativesAdd').hide();
                    this.viewMode = true;
                    this.personsData.familyGroup = [...this.relatives];
                    this.$toast.success("Família atualizada com sucesso!");
                })
                .catch((error) => {
                    console.log(error);
                    this.$toast.error(error.response.data.errors[Object.keys(error.response.data.errors)[0]][0]);
                    this.cancelEditRelatives();
                });
        },
        cancelEditRelatives() {
            $("#relativesEdit").show();
            $("#relativesSave").hide();
            $("#relativesCancel").hide();
            $('#relativesAdd').hide();
            $('.relativesGroup').attr('disabled', 'disabled');
            this.relatives = [...this.personsData.familyGroup];
        },
    },
    mounted() {
        this.personsData = JSON.parse(this.data);
        let person = JSON.parse(this.data);
        this.costumer = person.costumer;
        this.address = person.address;
        this.relatives = person.familyGroup;
        this.healthSituation = person.healthSituation;
        this.habitation = person.habitation;
        this.observations = person.observations;
        this.reedeems = person.reedeems;


        this.costumer.birth_date = this.costumer.birth_date.split('-').reverse().join('/') || null;

        setTimeout(() => {
            $('.relativesGroup').attr('disabled', 'disabled');
        }, 1000);
        console.log(this.personsData)
    },
    watch: {
        address: {
            handler: function (val, oldVal) {
                let cep = val.cep.replace(/\D/g, '');
                if (cep.length == 8) {
                    axios
                        .get("https://viacep.com.br/ws/" + cep + "/json/")
                        .then((response) => {
                            this.address.street = response.data.logradouro;
                            this.address.neighborhood = response.data.bairro;
                            this.address.city = response.data.localidade;
                            this.address.state = response.data.uf;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            },
            deep: true
        },
    }
};
</script>
