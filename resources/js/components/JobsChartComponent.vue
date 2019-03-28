
<script>
    import { Line } from 'vue-chartjs'
    export default {
        extends: Line,
        props: ['chartdata', 'options'],
        name: "JobsChartComponent",
        mounted () {
            this.renderChart(this.chartdata, this.options)
        }
    }
</script>

<style scoped>

</style>