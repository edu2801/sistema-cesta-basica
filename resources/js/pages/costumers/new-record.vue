<template>
    <div class="container">
        <h1>Confirmação</h1>
        <div>
            Eu confirmo que o(a) sr(a)
            <strong>{{ costumerData.name }}</strong> está retirando a Cesta
            Básica hoje
            {{ new Date().toLocaleDateString("pt-br") }}
        </div>
        <div>
            <a class="btn btn-secondary" href="/">Cancelar</a>
            <button class="btn btn-primary" @click="confirm">Confirmar</button>
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
            default: () => {},
        },
    },
    data() {
        return {
            dataParsed: JSON.parse(this.data),
            adminData: JSON.parse(this.data).admin,
            costumerData: JSON.parse(this.data).costumer,
        };
    },
    methods: {
        confirm() {
            axios
                .post("/costumers/insert-record/" + this.costumerData.id)
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
