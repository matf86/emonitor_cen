<template>
    <div>
        <el-row>
            <date-range-picker ref="picker" @set-date-range="setDateRange"></date-range-picker>
            <el-button type="success" icon="search" style="margin: 5px 0;" @click="updateGraphData">Szukaj</el-button>
        </el-row>
        <hr/>
        <div id="chart"></div>
    </div>
</template>

<script>

    export default {
        props: ['product', 'selected'],
        data() {
            return {
                dateRange:[],
            }

        },
        mounted() {
            this.$root.$on('hide-dialog', this.resetPicker);
            this.prepChart();
        },
        watch: {
            product() {
                this.prepChart();
            },
        },
        methods: {
            setDateRange(payload) {
                this.dateRange = payload;
            },
            resetPicker() {
                this.$refs['picker'].initDateRange();
            },
            prepChart() {
                let price_max = ['cena_max'];
                let price_min = ['cena_min'];
                let dates = [];

                this.product.forEach((item) => {
                    price_max.push(item.price_max);
                    price_min.push(item.price_min);
                    dates.push(item.date);
                });


                let chart = c3.generate({
                    bindto: '#chart',
                    data: {
                        columns: [
                            price_max,
                            price_min
                        ],
                        empty: {
                            label: {
                                text: "Brak danych..."
                            }
                        }
                    },
                    axis: {
                        x: {
                            type: 'category',
                            categories: dates
                        },
                        y: {
                            label: {
                                text: 'PLN',
                                position: 'outer-middle'
                            }
                        }
                    },
                    grid: {
                        y: {
                            show: true
                        }
                    },
                    zoom: {
                        enabled: true
                    },
                    point: {
                        r: 4
                    }
                });
            },
            updateGraphData() {
                this.$root.$emit('update-graph-data', {
                    'dateRange': {
                                  'minDate': this.dateRange[0],
                                  'maxDate': this.dateRange[1]
                                 },
                    'productName': this.selected
                });
            }
        }
    }

</script>

<style>
    #chart .c3-line {
        stroke-width: 4px;
    }

</style>