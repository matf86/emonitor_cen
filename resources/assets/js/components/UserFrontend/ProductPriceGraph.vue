<template>
    <div v-loading="loading" element-loading-text="Wczytuje...">
        <el-row>
            <date-range-picker :init-days="30" ref="picker" @set-date-range="setDateRange"></date-range-picker>
            <el-button type="success" icon="search" class="mt-1 mb-1" @click="updateGraphData">Szukaj</el-button>
        </el-row>
        <hr/>
        <div id="chart"></div>
    </div>
</template>

<script>
    import chartInit from '../../utils/zingchart';

    export default {
        props: ['products', 'selected'],
        data() {
            return {
                dateRange:[],
                loading: false
            }
        },
        mounted() {
            this.$root.$on('hide-dialog', this.resetPicker);
            this.prepChart();
        },
        watch: {
            products() {
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
                this.loading = true;

                let labels= [];
                let values = [];

                if(this.products.length > 0) {
                    this.products.forEach((item) => {
                        labels.push([item.date]);
                        values.push([item.price_min, item.price_max]);
                    });
                }

                chartInit(labels, values);
                this.loading = false;
            },
            updateGraphData() {
                this.loading = true;
                this.$root.$emit('update-graph-data', {
                    dateRange: {
                                  'from': this.dateRange[0],
                                  'to': this.dateRange[1]
                                 },
                    productName: this.selected.product,
                    package: this.selected.package,
                    origin: this.selected.origin
                });
            }
        }
    }

</script>
