<template>
    <div>
        <el-row>
            <el-col>
                <el-date-picker
                        v-model="dateRange"
                        type="daterange"
                        align="right"
                        placeholder="Dane z dni.."
                        :picker-options="pickerOptions">
                </el-date-picker>
                <el-button type="success" icon="search" style="margin: 5px 0;" @click="updateGraphData">Szukaj</el-button>
            </el-col>
        </el-row>
        <hr/>
        <div id="chart">
        </div>
    </div>
</template>

<script>

    export default {
        props: ['product'],
        data() {
            return {
                productName: '',
                dateRange:[],
                pickerOptions: {
                    shortcuts: [{
                        text: 'Tydzień',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: 'Miesiąc',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: '3 miesiące',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: '6 miesięcy',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 180);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: 'Rok',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 364);
                            picker.$emit('pick', [start, end]);
                        }
                    }]
                }
            }
        },
        created() {
            window.events.$on('clean-graph-data', this.cleanData);
        },
        mounted() {
            this.prepChart();

            if(this.product.length > 0 ) {
                this.productName = this.product[0].product;
            }
        },
        watch: {
            product() {
                this.prepChart();

                if(this.product.length > 0 ) {
                    this.productName = this.product[0].product;
                }
            }
        },
        computed: {
          convertDateRange() {
              if(this.dateRange.length > 0) {
                return this.dateRange.map(item => {
                    return moment.parseZone(item).local().format('YYYY-MM-DD');
                });
              }
          }
        },
        methods: {
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
                this.$emit('update-graph-data', {
                    'dateRange': {
                                  'minDate': this.convertDateRange[0],
                                  'maxDate': this.convertDateRange[1]
                                 },
                    productName: this.productName
                });
            },
            cleanData() {
                this.productName = '';
                this.dateRange = [];
            }
        }
    }

</script>

<style>
    #chart .c3-line {
        stroke-width: 4px;
    }

</style>