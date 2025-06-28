<template>
    <v-app>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Gráficos</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Beneficiarios por Bairro</div>
                        <div class="card-body">
                            <neighborhood-chart :chart-data="neighborhoodData"></neighborhood-chart>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Beneficiarios por Idade</div>
                        <div class="card-body">
                            <age-chart :chart-data="ageData"></age-chart>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Beneficiarios por Renda Familiar</div>
                        <div class="card-body">
                            <income-chart :chart-data="incomeData"></income-chart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </v-app>
</template>

<script>
import NeighborhoodChart from './charts/NeighborhoodChart.vue';
import AgeChart from './charts/AgeChart.vue';
import IncomeChart from './charts/IncomeChart.vue';

export default {
    name: 'Charts',
    components: {
        NeighborhoodChart,
        AgeChart,
        IncomeChart,
    },
    props: {
        neighborhoods: {
            type: Object,
            required: true,
        },
        ages: {
            type: Object,
            required: true,
        },
        income: {
            type: Object,
            required: true,
        },
    },
    computed: {
        neighborhoodData() {
            return {
                labels: Object.keys(this.neighborhoods),
                datasets: [
                    {
                        backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16', '#FFC107', '#607D8B'],
                        data: Object.values(this.neighborhoods),
                    },
                ],
            };
        },
        ageData() {
            return {
                labels: Object.keys(this.ages),
                datasets: [
                    {
                        label: 'Beneficiarios por Idade',
                        backgroundColor: '#f87979',
                        data: Object.values(this.ages),
                    },
                ],
            };
        },
        incomeData() {
            return {
                labels: Object.keys(this.income),
                datasets: [
                    {
                        backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
                        data: Object.values(this.income),
                    },
                ],
            };
        },
    },
};
</script>
    mounted() {
        console.log('Charts component mounted', this.neighborhoods, this.ages, this.income);
    },
};
</script>
