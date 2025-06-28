<script>
import { Pie, mixins } from 'vue-chartjs';
const { reactiveProp } = mixins;

export default {
    name: 'NeighborhoodChart',
    extends: Pie,
    mixins: [reactiveProp],
    props: ['chartData'],
    mounted() {
        this.renderChart(this.chartData, { responsive: true, maintainAspectRatio: false });
    },
};
</script>
