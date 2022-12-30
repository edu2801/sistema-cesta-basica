<template>
    <div class="container">
        <navbarVue />
        <v-app>
            <v-data-table :headers="columns" :items="dataTable"></v-data-table>
        </v-app>
    </div>
</template>
<script>
import axios from 'axios';
import navbarVue from '../../components/navbar.vue';

export default {
    name: 'index',
    components: {
        navbarVue,
    },
    props: {
        data: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            dataTable: JSON.parse(this.data),
            columns: [
                { text: 'Nº', value: 'id', align: 'center' },
                { text: 'Nome', value: 'name', align: 'center' },
                { text: 'CPF', value: 'cpf', align: 'center' },
                { text: 'Nascimento', value: 'birthday', align: 'center' },
                { text: 'Telefone', value: 'phone', align: 'center' },
            ],
        };
    },
}
</script>