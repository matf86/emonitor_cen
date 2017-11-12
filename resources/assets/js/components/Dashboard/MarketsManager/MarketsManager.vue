<template>
    <div class="manager-size">
        <div v-for="market in markets">
            <market-card :data="market" @show-dialog="showDialog"></market-card>
        </div>
    <market-logs-dialog :data="logs" :market="market" :categories="categories" :show="dialogFormVisible" @hide-dialog="hideDialog" @update-logs="updateLogs"></market-logs-dialog>
    </div>
</template>

<script>
    import MarketCard from './MarketCard.vue';
    import MarketLogsDialog from './MarketLogsDialog.vue';


    export default {
        components: { MarketCard, MarketLogsDialog },
        data() {
            return {
                markets: [],
                categories: [],
                dialogFormVisible: false,
                logs: [],
                market:[]

            }
        },
        created() {
          this.getMarketsData();
        },
        methods: {
            showDialog(market) {
                let dateRange = this.initDateRange();

                axios.get('/dashboard/markets/'+market.slug+'/logs',  {params: {
                    dateRange: dateRange
                }
                }).then(({data}) => {
                    this.logs = data.data;
                    this.categories = _.uniq(_.map(data.data, 'category')).sort();
                    this.market = market;
                    this.dialogFormVisible = true;
                }).catch(()=> {
                    this.$notify.error({
                        title: 'Error',
                        message: 'Błąd podczas pobierania danych.',
                        duration: 4500
                    });
                });
            },
            initDateRange() {
                const end = new Date();
                const start = new Date();
                start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                let dateRange = [start, end];

                return dateRange.map(item => {
                    return moment.parseZone(item).local().format('YYYY-MM-DD');
                });
            },
            updateLogs(data) {
               let categories = (data.categories.length === 0)? [null] : data.categories;
               axios.get('/dashboard/markets/'+data.market.slug+'/logs', { params:
                    {
                        categories: categories,
                        dateRange: data.dateRange
                    }
                }).then(({data}) => {
                    this.logs = data.data;
                }).catch(()=> {
                    this.$notify.error({
                        title: 'Error',
                        message: 'Błąd podczas pobierania danych.',
                        duration: 4500
                    });
               })
            },
            hideDialog(state) {
                this.dialogFormVisible = state;
                this.logs = [];
                this.categories= [];
            },
            getMarketsData() {
                axios.get('/dashboard/markets').then((response) => {
                    this.markets = response.data;
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>