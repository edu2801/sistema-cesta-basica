<template>
    <div class="bg-white">
        <navbarVue />
        <div class="container">
            <div class="mx-5 d-flex justify-content-between align-items-center">
                <h1 class="page-title">Dashboard</h1>
                <a href="/costumers/create" class="d-block btn btn-primary btn-icon text-white me-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span>
                    Novo cadastro
                </a>
            </div>
        </div>

        <v-app class="container">
            <v-data-table class="elevation-1" :headers="columns" :items="dataTable" :search="search">
                <template v-slot:top>
                    <v-text-field v-model="search" label="Pesquisar" class="mx-4"></v-text-field>
                </template>
                <template v-slot:item.birth_date="{ item }">
                    <td class="text-center">
                        {{
                            item.birth_date?.split("-").reverse().join("/")
                        }}
                    </td>
                </template>
                <template v-slot:item.last_redeem="{ item }">
                    <td class="text-center">
                        {{
                            item.last_redeem?.split("-").reverse().join("/")
                        }}
                    </td>
                </template>
                <template v-slot:item.actions="{ item }">
                    <td class="text-center" style="font-size: 22px">
                        <a :href="'/costumers/new-record/' + item.id" class="icons-table my-auto text-success me-1"
                            title="Nova retirada">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a :href="'/costumers/view/' + item.id" class="icons-table my-auto text-primary me-1"
                            title="Detalhes">
                            <i class="fa fa-list-alt"></i>
                        </a>
                    </td>
                </template>
            </v-data-table>
        </v-app>
    </div>
</template>
<script>
import axios from "axios";
import navbarVue from "../../components/navbar.vue";

export default {
    name: "index",
    components: {
        navbarVue,
    },
    props: {
        data: {
            type: String,
            default: () => ({}),
        },
    },
    data() {
        return {
            dataTable: JSON.parse(this.data),
            columns: [
                { text: "Nº", value: "id", align: "center" },
                { text: "Nome", value: "name", align: "center" },
                { text: "CPF", value: "cpf", align: "center" },
                { text: "Nascimento", value: "birth_date", align: "center" },
                { text: "Telefone", value: "phone", align: "center" },
                {
                    text: "Última retirada",
                    value: "last_redeem",
                    align: "center",
                },
                { text: "Ações", value: "actions", align: "center" },
            ],
            search: "",
        };
    },
};
</script>
