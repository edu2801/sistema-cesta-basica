<template>
    <div class="bg-white">
        <div class="container">
            <h1>Confirmação</h1>
            <div class="mt-1">
                Confirmo que o(a) sr(a)
                <strong>{{ costumerData.name }}</strong> está retirando a Cesta
                Básica hoje
                <strong>
                    {{ new Date().toLocaleDateString("pt-br") }}
                </strong>
            </div>

            <div class="bg-white">
                <textarea class="form-control" name="observation" placeholder="Observação" rows="5"
                    v-model="observation"></textarea>
            </div>

            <div class="mt-2">
                <a class="btn btn-secondary" href="/">Cancelar</a>
                <button class="btn btn-primary" @click="confirm">Confirmar</button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    name: "new-record",
    props: {
        data: {
            type: String,
            default: () => { },
        },
    },
    data() {
        return {
            dataParsed: JSON.parse(this.data),
            adminData: JSON.parse(this.data).admin,
            costumerData: JSON.parse(this.data).costumer,
            observation: ''
        };
    },
    methods: {
        confirm() {
            axios
                .post("/costumers/insert-record/" + this.costumerData.id, {
                    observation: this.observation,
                })
                .then((response) => {
                    window.location.href = "/";
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
