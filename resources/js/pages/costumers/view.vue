<template>
    <div class="bg-white">
        <navbarVue />
        <div class="container">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <div>
                        Nome: <h2 class="d-inline">{{ costumer.name }}</h2>
                    </div>
                    <div>
                        Telefone: <h5 class="d-inline">{{ costumer.phone }}</h5>
                    </div>
                </div>

                <div class="float-end">
                    <a class="btn btn-primary" :href="'/costumers/edit/' + costumer.id">Editar</a>
                    <a class="btn btn-primary" :href="'/costumers/print/' + costumer.id" target="_blank">Imprimir</a>
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
                            :headers="[{ text: 'Data', value: 'created_at' }, { text: 'Observação', value: 'observation' }]"
                            :items="reedeems" class="elevation-1">
                            <template v-slot:item.created_at="{ item }">
                                {{ item.delivery_date.split(" ")[0].split("-").reverse().join("/") }}
                            </template>
                        </v-data-table>
                    </v-app>
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                    tabindex="0">
                    <v-app class="mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">Dados básicos</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Nome</label>
                                            <input disabled class="form-control" type="text" v-model="costumer.name" />
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Telefone</label>
                                            <input disabled class="form-control" type="text" v-model="costumer.phone" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Data de nascimento</label>
                                            <input disabled type="text" class="form-control" :value="formattedBirthDate">
                                            <div v-if="costumerAge" class="text-muted" style="font-size: 0.875em; margin-top: 4px;">
                                                Idade: {{ costumerAge }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Estado civil</label>
                                            <input disabled class="form-control" type="text" :value="formattedMaritalStatus" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">RG</label>
                                            <input disabled class="form-control" type="text" v-model="costumer.rg" />
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">CPF</label>
                                            <input disabled class="form-control" type="text" v-model="costumer.cpf" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Escolaridade</label>
                                            <input disabled class="form-control" type="text" :value="formattedSchooling(costumer.schooling)" />
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Profissão</label>
                                            <input disabled class="form-control" type="text" v-model="costumer.occupation" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Salário</label>
                                            <input disabled class="form-control" type="text" :value="costumer.salary" />
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Renda familiar</label>
                                            <input disabled class="form-control" type="text" v-model="costumer.family_income" />
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
                                            <input disabled class="form-control" type="text" v-model="address.cep" />
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Rua</label>
                                            <input disabled class="form-control" type="text" v-model="address.street" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Número</label>
                                            <input disabled class="form-control" type="string" v-model="address.number" />
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Bairro</label>
                                            <input disabled class="form-control" type="text" v-model="address.neighborhood" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Cidade</label>
                                            <input disabled class="form-control" type="text" v-model="address.city" />
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Estado</label>
                                            <input disabled class="form-control" type="text" v-model="address.state" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-12 mb-3">
                                            <label class="form-label">Referência</label>
                                            <input disabled class="form-control" type="text" v-model="address.reference" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-5">
                                <div class="card-header">Grupo familiar</div>
                                <div class="card-body">
                                    <div v-for="(relative, index) in relatives" :key="index" class="row border-bottom mb-3 pb-3">
                                        <div class="col-12 col-md-3 mb-3">
                                            <label class="form-label">Nome</label>
                                            <input disabled class="form-control" type="text" v-model="relative.name" />
                                        </div>
                                        <div class="col-12 col-md-2 mb-3">
                                            <label class="form-label">Parentesco</label>
                                            <input disabled class="form-control" type="text" v-model="relative.relationship" />
                                        </div>
                                        <div class="col-12 col-md-2 mb-3">
                                            <label class="form-label">Data de Nascimento</label>
                                            <input disabled class="form-control" type="text" :value="relative.birth_date ? relative.birth_date.split('-').reverse().join('/') : ''" />
                                             <div v-if="calculateAge(relative.birth_date)" class="text-muted" style="font-size: 0.875em; margin-top: 4px;">
                                                Idade: {{ calculateAge(relative.birth_date) }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2 mb-3">
                                            <label class="form-label">Fonte de Renda</label>
                                            <input disabled class="form-control" type="text" v-model="relative.income_source" />
                                        </div>
                                        <div class="col-12 col-md-1 mb-3">
                                            <label class="form-label">Valor</label>
                                            <input disabled class="form-control" type="text" v-model="relative.income_value" />
                                        </div>
                                        <div class="col-12 col-md-2 mb-3">
                                            <label class="form-label">Escolaridade</label>
                                            <input disabled class="form-control" type="text" :value="formattedSchooling(relative.schooling)" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-5">
                                <div class="card-header">Benefícios de transferência de renda</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto"><input disabled type="checkbox" v-model="costumer.cadastro_unico" /> Cadastro Único</div>
                                        <div class="col-auto"><input disabled type="checkbox" v-model="costumer.bolsa_familia" /> Bolsa Família</div>
                                        <div class="col-auto"><input disabled type="checkbox" v-model="costumer.prestacao_continuada" /> Prestação Continuada</div>
                                        <div class="col-auto"><input disabled type="checkbox" v-model="costumer.renda_cidada" /> Renda Cidadã</div>
                                        <div class="col-auto"><input disabled type="checkbox" v-model="costumer.cesta_basica" /> Cesta Básica</div>
                                        <div class="col-auto"><input disabled type="checkbox" v-model="costumer.receives_basket_from_another_source" /> Já recebe cesta básica de outro lugar?</div>
                                    </div>
                                </div>
                            </div>

                             <div class="card mt-5">
                                <div class="card-header">Situação de saúde</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Doenças crônicas</label>
                                            <input disabled class="form-control" type="text" v-model="healthSituation.chronic_diseases" />
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Vícios</label>
                                            <input disabled class="form-control" type="text" v-model="healthSituation.vices" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-5">
                                <div class="card-header">Habitação</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto"><input disabled type="radio" value="rented" v-model="habitation.type" /> Alugada</div>
                                        <div class="col-auto"><input disabled type="radio" value="owned" v-model="habitation.type" /> Própria</div>
                                        <div class="col-auto"><input disabled type="radio" value="gived" v-model="habitation.type" /> Cedida</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Detalhes de Financiamento/Cessão</label>
                                            <input disabled class="form-control" type="text" v-model="habitation.financing_details" />
                                        </div>
                                        <div v-if="habitation.type === 'rented'" class="col-12 col-md-6">
                                            <label class="form-label">Valor do Aluguel</label>
                                            <input disabled class="form-control" type="text" v-model="habitation.value" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mt-5">
                                <div class="card-header">Observações adicionais</div>
                                <div class="card-body">
                                    <textarea disabled class="form-control" rows="4" v-model="observations.observation"></textarea>
                                </div>
                            </div>
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
            costumer: {},
            address: {},
            relatives: [],
            healthSituation: {},
            habitation: {},
            observations: {},
            reedeems: [],
            // Mappings for human-readable text
            maritalStatusMap: {
                solteiro: 'Solteiro(a)',
                casado: 'Casado(a)',
                divorciado: 'Divorciado(a)',
                viuvo: 'Viúvo(a)',
                separado: 'Separado(a)',
                uniao_estavel: 'União Estável'
            },
            schoolingMap: {
                analfabeto: 'Analfabeto',
                fundamental_incompleto: 'Fundamental Incompleto',
                fundamental_completo: 'Fundamental Completo',
                medio_incompleto: 'Médio Incompleto',
                medio_completo: 'Médio Completo',
                superior_incompleto: 'Superior Incompleto',
                superior_completo: 'Superior Completo'
            }
        };
    },
    computed: {
        formattedBirthDate() {
            if (!this.costumer.birth_date) return '';
            // It's already formatted in mounted, but this is safer
            return this.costumer.birth_date.split('-').reverse().join('/');
        },
        costumerAge() {
            return this.calculateAge(this.costumer.birth_date);
        },
        formattedMaritalStatus() {
            return this.maritalStatusMap[this.costumer.marital_status] || this.costumer.marital_status;
        }
    },
    methods: {
        home() {
            window.location.href = "/";
        },
        deleteCostumer() {
            if (!confirm("Deseja realmente excluir este usuário?")) {
                return;
            }
            axios.delete("/costumers/" + this.costumer.id)
                .then(response => {
                    this.$toast.success("Usuário excluído com sucesso!");
                    setTimeout(this.home, 2000);
                })
                .catch(error => {
                    console.error("Erro ao excluir usuário:", error);
                    this.$toast.error("Não foi possível excluir o usuário.");
                });
        },
        calculateAge(dateString) {
            if (!dateString) return '';
            const [year, month, day] = dateString.split('-').map(Number);
            const birthDate = new Date(year, month - 1, day);
            const today = new Date();
            if (isNaN(birthDate.getTime()) || birthDate > today) {
                return '';
            }
            let years = today.getFullYear() - birthDate.getFullYear();
            let months = today.getMonth() - birthDate.getMonth();
            if (months < 0 || (months === 0 && today.getDate() < birthDate.getDate())) {
                years--;
                months = (months + 12) % 12;
            }
            if (years === 0 && months === 0) {
                return 'Recém-nascido';
            }
            const yearText = years > 0 ? `${years} ${years > 1 ? 'anos' : 'ano'}` : '';
            const monthText = months > 0 ? `${months} ${months > 1 ? 'meses' : 'mês'}` : '';
            return [yearText, monthText].filter(Boolean).join(' e ');
        },
        formattedSchooling(schoolingValue) {
            return this.schoolingMap[schoolingValue] || schoolingValue;
        }
    },
    mounted() {
        const person = JSON.parse(this.data);

        // Assign data from prop to component's data properties
        this.costumer = person.costumer || {};
        this.address = person.address || {};
        this.relatives = person.familyGroup || [];
        this.healthSituation = person.healthSituation || { chronic_diseases: "", vices: "" };
        this.habitation = person.habitation || { type: "", financing_details: "", value: null };
        this.observations = person.observations || { observation: "" };
        this.reedeems = person.reedeems || [];

        // Keep original YYYY-MM-DD format for calculations, format for display via computed property
        // The line below is no longer needed as formatting is handled by computed property
        // if (this.costumer.birth_date) {
        //     this.costumer.birth_date = this.costumer.birth_date.split('-').reverse().join('/');
        // }
    },
};
</script>

<style>
.nav-link {
    color: #000;
}

.nav-link.active {
    color: #0d6efd;
}

.col-auto {
    margin-right: 1.5rem;
}
</style>