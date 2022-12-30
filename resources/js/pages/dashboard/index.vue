<template>
    <div class="container">
        <navbarVue />
        <v-app>
            <v-data-table :headers="columns" :items="dataTable">
                <template v-slot:item.birth_date="{ item }">
                    <td class="text-center">
                        {{
                            new Date(item.birth_date).toLocaleDateString(
                                "pt-br"
                            )
                        }}
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
            type: Array,
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
            ],
        };
    },
};
</script>
