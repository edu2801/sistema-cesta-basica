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
                                <input :class="'input100 form-control '" name="phone" placeholder="Telefone"
                                    type="text" v-model="costumer.phone" @input="formatPhone" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="mdi mdi-phone"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Data de nascimento</label>

                            <v-menu v-model="menu2" :close-on-content-click="false" transition="scale-transition"
                                offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs }">
                                    <div class="wrap-input100">
                                        <input :class="'input100 form-control'" placeholder="DD/MM/AAAA" type="text"
                                            v-model="birthDateInput" v-bind="attrs" v-on="on" />
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i aria-hidden="true" class="mdi mdi-calendar"></i>
                                        </span>
                                    </div>
                                </template>

                                <v-date-picker v-model="costumer.birth_date" no-title @input="menu2 = false"
                                    locale="pt-BR"></v-date-picker>
                            </v-menu>
                            <div v-if="costumerAge" class="text-muted" style="font-size: 0.875em; margin-top: 4px;">
                                Idade: {{ costumerAge }}
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Estado civil</label>
                            <select class="form-control" v-model="costumer.marital_status">
                                <option value="" disabled>Selecione...</option>
                                <option value="solteiro">Solteiro(a)</option>
                                <option value="casado">Casado(a)</option>
                                <option value="divorciado">Divorciado(a)</option>
                                <option value="viuvo">Viúvo(a)</option>
                                <option value="separado">Separado(a)</option>
                                <option value="uniao_estavel">União Estável</option>
                            </select>
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
                                <input :class="{ 'input100 form-control': true, 'is-invalid': isCpfInvalid }" name="cpf"
                                    placeholder="CPF" type="text" v-model="costumer.cpf" @input="formatCpf" 
                                    maxlength="14"
                                    />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                            <div v-if="isCpfInvalid" class="text-danger mt-1" style="font-size: 0.875em;">
                                CPF já cadastrado no sistema
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Escolaridade</label>
                            <select class="form-control" v-model="costumer.schooling">
                                <option value="">Selecione</option>
                                <option value="analfabeto">Analfabeto</option>
                                <option value="fundamental_incompleto">Fundamental Incompleto</option>
                                <option value="fundamental_completo">Fundamental Completo</option>
                                <option value="medio_incompleto">Médio Incompleto</option>
                                <option value="medio_completo">Médio Completo</option>
                                <option value="superior_incompleto">Superior Incompleto</option>
                                <option value="superior_completo">Superior Completo</option>
                            </select>
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
                            <label class="form-label">CEP</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="cep" placeholder="CEP" type="text"
                                    v-model="address.cep" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="zmdi zmdi-email"></i>
                                </span>
                            </div>
                        </div>

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
                    </div>

                    <div class="row">
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
                    </div>

                    <div class="row">
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

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Estado</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="state" placeholder="Estado" type="text"
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
                    <div v-for="(relative, index) in relatives" :key="index" class="row">
                        <div class="col-12 col-md-3 mb-3">
                            <label class="form-label">Nome</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="relative_name" placeholder="Nome"
                                    type="text" v-model="relative.name" />
                            </div>
                        </div>

                        <div class="col-12 col-md-2 mb-3">
                            <label class="form-label">Parentesco</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="relative_kinship"
                                    placeholder="Parentesco" type="text" v-model="relative.kinship" />
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mb-3">
                            <label class="form-label">Data de Nascimento</label>

                            <v-menu v-model="relative.menu" :close-on-content-click="false"
                                transition="scale-transition" offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs }">
                                    <input :class="'input100 form-control'" placeholder="DD/MM/AAAA" type="text"
                                        v-model="relative.birth_date_input" @input="onRelativeDateInput(relative)"
                                        v-bind="attrs" v-on="on" />
                                </template>

                                <v-date-picker v-model="relative.birth_date" no-title
                                    @input="onRelativePickerChange($event, relative); relative.menu = false"
                                    locale="pt-BR"></v-date-picker>
                            </v-menu>
                            <div v-if="calculateAge(relative.birth_date)" class="text-muted"
                                style="font-size: 0.875em; margin-top: 4px;">
                                {{ calculateAge(relative.birth_date) }}
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mb-3">
                            <label class="form-label">Fonte de Renda</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="relative_income_source"
                                    placeholder="Fonte de Renda" type="text" v-model="relative.income_source" />
                            </div>
                        </div>
                        <div class="col-12 col-md-1 mb-3">
                            <label class="form-label">Valor</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="relative_income_value"
                                    placeholder="Valor" type="number" v-model="relative.income_value" />
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mb-3">
                            <label class="form-label">Escolaridade</label>
                            <select class="form-control" v-model="relative.schooling">
                                <option value="">Selecione</option>
                                <option value="analfabeto">Analfabeto</option>
                                <option value="fundamental_incompleto">Fundamental Incompleto</option>
                                <option value="fundamental_completo">Fundamental Completo</option>
                                <option value="medio_incompleto">Médio Incompleto</option>
                                <option value="medio_completo">Médio Completo</option>
                                <option value="superior_incompleto">Superior Incompleto</option>
                                <option value="superior_completo">Superior Completo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
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
                        <div class="col-12 col-md-4">
                            <input type="checkbox" id="checkReceivesBasketFromAnotherSource"
                                v-model="costumer.receives_basket_from_another_source" />
                            <label for="checkReceivesBasketFromAnotherSource">Já recebe cesta básica de outro
                                lugar?</label>
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
                                <input :class="'input100 form-control '" name="chronic_diseases"
                                    placeholder="Doenças Crônicas" type="text"
                                    v-model="healthSituation.chronic_diseases" />
                            </div>
                        </div>

                        <div class="col-12 col-md-4 mb-3">
                            <label class="form-label">Vícios</label>
                            <div class="wrap-input100">
                                <input :class="'input100 form-control '" name="vices" placeholder="Vícios" type="text"
                                    v-model="healthSituation.vices" />
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
                            <input type="radio" id="radioRented" value="rented" v-model="habitation.type" />
                            <label for="radioRented">Alugada</label>
                        </div>

                        <div class="col-12 col-md-2">
                            <input type="radio" id="radioOwned" value="owned" v-model="habitation.type" />
                            <label for="radioOwned">Própria</label>
                        </div>
                        <div class="col-12 col-md-2">
                            <input type="radio" id="radioGived" value="gived" v-model="habitation.type" />
                            <label for="radioGived">Cedida</label>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label">Detalhes de Financiamento/Cessão</label>
                            <input :class="'input100 form-control '" type="text" id="financing_details"
                                name="financing_details" placeholder="Detalhes"
                                v-model="habitation.financing_details" />
                        </div>
                        <div v-if="habitation.type === 'rented'" class="col-12 col-md-6">
                            <label class="form-label">Valor do Aluguel</label>
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
                        <textarea :class="'form-control'" placeholder="Digite as observações aqui..." rows="4"
                            v-model="observations.observation"></textarea>
                    </div>
                </div>
            </div>

            <div class="mt-5 pb-5 d-flex align-items-center justify-content-between mx-10">
                <button class="btn btn-danger" @click="home">Cancelar</button>
                <button class="btn btn-primary" @click="createCostumer">
                    Inserir usuário
                </button>
            </div>
        </div>
    </v-app>
</template>

<script>
export default {
    name: "CreateCostumer",
    data() {
        return {
            birthDateInput: null,
            isCpfInvalid: false,
            lastCheckedCpf: '',
            costumer: {
                name: "",
                phone: "",
                birth_date: null,
                marital_status: "",
                rg: "",
                cpf: "",
                schooling: "",
                occupation: "",
                salary: "",
                family_income: "",
                cadastro_unico: false,
                bolsa_familia: false,
                prestacao_continuada: false,
                renda_cidada: false,
                cesta_basica: false,
                receives_basket_from_another_source: false,
            },
            address: {
                street: "",
                neighborhood: "",
                number: "",
                city: "",
                state: "",
                cep: "",
                complement: "-",
                reference: "",
            },
            relatives: [
                {
                    name: "",
                    kinship: "",
                    birth_date: null,
                    birth_date_input: null,
                    income_source: "",
                    income_value: "",
                    schooling: "",
                },
            ],
            healthSituation: {
                chronic_diseases: "",
                vices: "",
            },
            habitation: {
                type: "",
                financing_details: "",
                value: null,
            },
            observations: {
                observation: "",
            },

            menu2: false,
        };
    },
    methods: {
        createCostumer() {

            if (this.isCpfInvalid) {
                this.$toast.error("CPF Já existenete. Por favor, corrija antes de prosseguir.");
                return;
            }

            let loader = this.$loading.show();
            let body = {
                costumer: this.costumer,
                address: this.address,
                relatives: this.relatives,
                healthSituation: this.healthSituation,
                habitation: this.habitation,
                observations: this.observations,
            };
            axios
                .post("/costumers/insert", body)
                .then((response) => {
                    loader.hide();
                    window.location.href = "/";
                })
                .catch((error) => {
                    console.log(error);
                    loader.hide();
                    this.$toast.error(error.response.data.errors[Object.keys(error.response.data.errors)[0]][0]);
                });
        },
        home() {
            window.location.href = "/";
        },
        addRelative() {
            this.relatives.push({
                name: "",
                kinship: "",
                birth_date: null,
                birth_date_input: null,
                income_source: "",
                income_value: "",
                schooling: "",
            });
        },
        formatCpf() {
            // As soon as the user starts typing, assume the CPF is valid until proven otherwise.
            // This removes the red border while they are correcting it.
            this.isCpfInvalid = false;

            let cpf = this.costumer.cpf.replace(/\D/g, "");

            if (cpf.length > 11) {
                cpf = cpf.slice(0, 11);
            }

            // Apply formatting
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
            cpf = cpf.replace(/(\d{3})\.(\d{3})\.(\d{3})(\d{1,2})$/, '$1.$2.$3-$4');

            this.costumer.cpf = cpf;

            const rawCpf = cpf.replace(/\D/g, "");

            //  *** CORE LOGIC CHANGE ***
            // Only trigger the check if the CPF has 11 digits AND we haven't checked this exact CPF before.
            if (rawCpf.length === 11 && rawCpf !== this.lastCheckedCpf) {
                this.checkCpf(rawCpf);
            }

            // If the user deletes characters, reset lastCheckedCpf so it can be checked again if they re-complete it.
            if (rawCpf.length < 11) {
                this.lastCheckedCpf = '';
            }
        },
        checkCpf(rawCpf) {
            // Immediately store the CPF we are about to check to prevent multiple API calls.
            this.lastCheckedCpf = rawCpf;

            axios.post("/costumers/check-cpf", { cpf: this.costumer.cpf })
                .then(response => {
                    if (response.data.msg.exists) {
                        // CPF already exists: Show the alert ONCE and set the invalid state to true.
                        this.$toast.error("CPF já cadastrado.");
                        this.isCpfInvalid = true;
                    } else {
                        // CPF is valid: Ensure the invalid state is false.
                        this.isCpfInvalid = false;
                    }
                });
        },

        onRelativeDateInput(relative) {
            // --- Part A: MASKING ---
            const input = relative.birth_date_input || '';
            const digitsOnly = input.replace(/\D/g, '').slice(0, 8);
            let formattedValue = digitsOnly;

            if (digitsOnly.length > 4) {
                formattedValue = `${digitsOnly.slice(0, 2)}/${digitsOnly.slice(2, 4)}/${digitsOnly.slice(4)}`;
            } else if (digitsOnly.length > 2) {
                formattedValue = `${digitsOnly.slice(0, 2)}/${digitsOnly.slice(2)}`;
            }

            if (formattedValue !== input) {
                relative.birth_date_input = formattedValue;
            }

            // --- Part B: SYNCHRONIZING Input -> Picker ---
            if (digitsOnly.length === 8) {
                const [d, m, y] = formattedValue.split('/');
                const newModelDate = `${y}-${m}-${d}`;
                // Update the picker's model only if it's different
                if (relative.birth_date !== newModelDate) {
                    relative.birth_date = newModelDate;
                }
            } else {
                // If the input is incomplete, clear the picker's model
                if (relative.birth_date !== null) {
                    relative.birth_date = null;
                }
            }
        },

        // This new method handles SYNCHRONIZING Picker -> Input.
        onRelativePickerChange(newDate, relative) {
            // newDate is the YYYY-MM-DD string from the picker's event
            if (!newDate) {
                relative.birth_date_input = null;
                return;
            }
            const [y, m, d] = newDate.split('-');
            const formattedInput = `${d}/${m}/${y}`;

            // Update the input field
            if (relative.birth_date_input !== formattedInput) {
                relative.birth_date_input = formattedInput;
            }
        },

        calculateAge(dateString) {
            // Return nothing if the date is not set
            if (!dateString) return '';

            // Parse the YYYY-MM-DD string into a Date object
            const [year, month, day] = dateString.split('-').map(Number);
            const birthDate = new Date(year, month - 1, day);

            const today = new Date();

            // Check for invalid or future dates
            if (isNaN(birthDate.getTime()) || birthDate > today) {
                return '';
            }

            let years = today.getFullYear() - birthDate.getFullYear();
            let months = today.getMonth() - birthDate.getMonth();

            // Adjust years if the birthday hasn't occurred this year yet
            if (months < 0 || (months === 0 && today.getDate() < birthDate.getDate())) {
                years--;
                // Adjust months to be a positive value (0-11)
                months = (months + 12) % 12;
            }

            // Build the final display string
            if (years === 0 && months === 0) {
                return 'Recém-nascido';
            }

            const yearText = years > 0 ? `${years} ${years > 1 ? 'anos' : 'ano'}` : '';
            const monthText = months > 0 ? `${months} ${months > 1 ? 'meses' : 'mês'}` : '';

            // Join the parts with ' e ' if both exist
            return [yearText, monthText].filter(Boolean).join(' e ');
        },
        formatPhone() {
            // Get only the digits from the input
            let phone = this.costumer.phone.replace(/\D/g, '');

            // Limit to 11 digits (DDD + 9 digits)
            if (phone.length > 11) {
                phone = phone.slice(0, 11);
            }

            // Apply the mask based on the number of digits
            if (phone.length > 10) {
                // (XX) Y XXXX-XXXX
                phone = phone.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
            } else if (phone.length > 6) {
                // (XX) XXXX-XXXX
                phone = phone.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
            } else if (phone.length > 2) {
                // (XX) XXXX
                phone = phone.replace(/^(\d{2})(\d{0,5}).*/, '($1) $2');
            } else {
                // (XX
                phone = phone.replace(/^(\d*)/, '($1');
            }

            // Update the model value, ensuring it's not the same to avoid loops
            if (phone !== this.costumer.phone) {
                this.costumer.phone = phone;
            }
        },
    },
    computed: {
        cep() {
            return this.address.cep;
        },
        costumerAge() {
            return this.calculateAge(this.costumer.birth_date);
        }
    },
    watch: {
        cep() {
            let cep = this.cep.replace(/\D/g, "");
            if (cep.length == 8) {
                let loader = this.$loading.show();
                axios
                    .get(`https://viacep.com.br/ws/${this.cep}/json/`)
                    .then((response) => {
                        loader.hide();
                        this.address.street = response.data.logradouro;
                        this.address.neighborhood = response.data.bairro;
                        this.address.city = response.data.localidade;
                        this.address.state = response.data.uf;
                    })
                    .catch((error) => {
                        loader.hide();
                        console.log(error);
                    });
            }
        },
        birthDateInput(newValue) {
            // --- Part A: Masking Logic ---
            const digitsOnly = newValue ? newValue.replace(/\D/g, "").slice(0, 8) : "";
            let formattedValue = digitsOnly;
            if (digitsOnly.length > 4) {
                formattedValue = `${digitsOnly.slice(0, 2)}/${digitsOnly.slice(2, 4)}/${digitsOnly.slice(4)}`;
            } else if (digitsOnly.length > 2) {
                formattedValue = `${digitsOnly.slice(0, 2)}/${digitsOnly.slice(2)}`;
            }

            if (formattedValue !== newValue) {
                this.birthDateInput = formattedValue;
            }

            // --- Part B: Updating the real model ---
            // If the date is complete (8 digits), update the picker's model.
            if (digitsOnly.length === 8) {
                const [day, month, year] = formattedValue.split('/');
                this.costumer.birth_date = `${year}-${month}-${day}`;
            } else {
                // If the date is incomplete, make sure the picker's model is cleared.
                this.costumer.birth_date = null;
            }
        },

        // WATCHER 2: Handles selecting from the date picker
        'costumer.birth_date'(newDate) {
            // If the picker's date changes, update the text input field.
            if (newDate) {
                const [year, month, day] = newDate.split('-');
                this.birthDateInput = `${day}/${month}/${year}`;
            } else {
                this.birthDateInput = null;
            }
        }
    },
};
</script>