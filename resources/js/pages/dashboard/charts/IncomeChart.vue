<script>
import { Doughnut, mixins } from 'vue-chartjs';
const { reactiveProp } = mixins;

export default {
    name: 'IncomeChart',
    extends: Doughnut,
    mixins: [reactiveProp],
    props: ['chartData'],
    mounted() {
        this.renderChart(this.chartData, { responsive: true, maintainAspectRatio: false });
    },
};
</script>
