<script>
import { Bar, mixins } from 'vue-chartjs';
const { reactiveProp } = mixins;

export default {
    name: 'AgeChart',
    extends: Bar,
    mixins: [reactiveProp],
    props: ['chartData'],
    mounted() {
        this.renderChart(this.chartData, { responsive: true, maintainAspectRatio: false });
    },
};
</script>
