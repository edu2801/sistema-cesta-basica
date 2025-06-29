<template>
    <v-app class="bg-white">
        <div class="container">
            <h1>Confirmação</h1>
            <div class="mt-1">
                Confirmo que o(a) sr(a)
                <strong>{{ costumerData.name }}</strong> está retirando a Cesta
                Básica.
            </div>

            <div class="row mt-3">
                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label">Data da Retirada</label>
                    <v-menu v-model="menu" :close-on-content-click="false" transition="scale-transition" offset-y
                        min-width="auto">
                        <template v-slot:activator="{ on, attrs }">
                            <div class="wrap-input100">
                                <input :class="'input100 form-control'" placeholder="DD/MM/AAAA" type="text"
                                    v-model="deliveryDateInput" v-bind="attrs" v-on="on" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i aria-hidden="true" class="mdi mdi-calendar"></i>
                                </span>
                            </div>
                        </template>
                        <v-date-picker v-model="delivery_date" no-title locale="pt-BR"></v-date-picker>
                    </v-menu>
                </div>
            </div>


            <div class="bg-white mt-3">
                <textarea class="form-control" name="observation" placeholder="Observação" rows="5"
                    v-model="observation"></textarea>
            </div>

            <div class="mt-2">
                <button class="btn btn-secondary" @click="cancel">Cancelar</button>
                <button class="btn btn-primary" @click="confirm">Confirmar</button>
            </div>
        </div>
    </v-app>
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
            observation: '',
            // Data properties for the date picker
            menu: false,
            delivery_date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000).toISOString().substr(0, 10),
            deliveryDateInput: null,
        };
    },
    watch: {
        deliveryDateInput(newValue) {
            if (!newValue) {
                this.delivery_date = null;
                return;
            }
            // Formats input as DD/MM/YYYY while typing
            const digitsOnly = newValue.replace(/\D/g, "").slice(0, 8);
            let formattedValue = digitsOnly;
            if (digitsOnly.length > 4) {
                formattedValue = `${digitsOnly.slice(0, 2)}/${digitsOnly.slice(2, 4)}/${digitsOnly.slice(4)}`;
            } else if (digitsOnly.length > 2) {
                formattedValue = `${digitsOnly.slice(0, 2)}/${digitsOnly.slice(2)}`;
            }

            if (formattedValue !== newValue) {
                this.deliveryDateInput = formattedValue;
            }

            // Updates the v-date-picker model if a full date is entered
            if (digitsOnly.length === 8) {
                const [day, month, year] = formattedValue.split('/');
                if (day && month && year && year.length === 4) {
                    this.delivery_date = `${year}-${month}-${day}`;
                }
            }
        },
        delivery_date(newDate) {
            // Updates the input field when a date is selected from the picker
            if (newDate) {
                const [year, month, day] = newDate.split('-');
                this.deliveryDateInput = `${day}/${month}/${year}`;
            } else {
                this.deliveryDateInput = null;
            }
            // Close calendar after selection
            this.menu = false;
        }
    },
    methods: {
        confirm() {
            axios
                .post("/costumers/insert-record/" + this.costumerData.id, {
                    observation: this.observation,
                    delivery_date: this.delivery_date, // Send the new date parameter
                })
                .then((response) => {
                    window.location.href = "/";
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        cancel() {
            window.location.href = "/";
        }
    },
    created() {
        // Set the initial formatted date for the input field when the component is created
        if (this.delivery_date) {
            const [year, month, day] = this.delivery_date.split('-');
            this.deliveryDateInput = `${day}/${month}/${year}`;
        }
    }
};
</script>