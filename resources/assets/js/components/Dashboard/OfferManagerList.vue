<template>
    <div>
    <el-row>
        <date-range-picker :init-days="30" @set-date-range="setDateRange"></date-range-picker>
        <checkbox-places :data="places" @set-places-list="setCheckedPlaces"></checkbox-places>
        <el-button type="success" icon="search" style="margin: 5px 0 0 0;" @click="getTableData">Szukaj</el-button>
    </el-row>
        <offer-manager-table v-loading="loading" element-loading-text="Wczytuje..." :data="entriesList"></offer-manager-table>
        <pagination :data="tableData" @set-sliced-table-data="setEntriesList"></pagination>
    </div>
</template>

<script>
    import OfferManagerTable from './OfferManagerTable.vue';
    import CheckboxPlaces from './CheckboxPlaces.vue';

    export default {
        components: { OfferManagerTable, CheckboxPlaces },
        data() {
            return {
                checkedPlaces:[],
                dateRange:[],
                tableData: [],
                places: [],
                entriesList:[],
                loading:  true,
            }
        },
        created() {
            this.$root.$on('delete-table-entry', this.deleteTableData); //event emitted by OfferManagerTable component
            this.$root.$on('decrease-offers-count', this.decreaseOffersCount); //event emitted by OfferDetailsTable component
            this.$root.$on('increase-offers-count', this.increaseOffersCount); //event emitted by OfferFormDialog component

            this.getTableData('initial');
            this.getMarketsData();
        },
        methods: {
            setEntriesList(data) {
                this.entriesList = data
            },
            setDateRange(payload) {
                this.dateRange = payload;
            },
            setCheckedPlaces(payload) {
                this.checkedPlaces = payload;
            },
            getTableData(type) {
                this.loading = true;
                let ids = null;
                let dateRange = null;

                if(type !== 'initial') {
                    ids = (this.checkedPlaces.length === 0)? [null] : this.checkedPlaces;
                    dateRange = [this.dateRange[0], this.dateRange[1]];
                }

                axios.get('/dashboard/offers/stats/count', {
                    params: {
                        markets: ids,
                        dateRange: dateRange
                    }
                }).then(response => {
                    let data = response.data.data;
                    this.tableData = _.orderBy(data, ['date'],['desc']);
                    this.loading = false;
                }).catch(() => {
                    this.$notify.error({
                        message: 'Brak danych dla wskazanych parametrów wyszukiwania',
                        duration: 4000
                    });
                    this.tableData = [];
                    this.loading = false;
                });
            },
            getMarketsData() {
                axios.get('/dashboard/markets').then(response => {
                    this.setPlacesList(response.data);
                }).catch(error => {
                    this.$notify.error({
                        message: 'Brak danych...',
                        duration: 0
                    });
                    console.log(error);
                })
            },
            deleteTableData(data) {
                    this.tableData = this.tableData.filter(e => {
                        return !(e.market_slug === data.slug && e.date === data.date);
                });
            },
            setPlacesList(data) {
                this.places =  _.uniqWith(_.map(data, function(item) {
                    return {
                        label: item.name,
                        value: item._id
                    }
                }), _.isEqual);
            },
            increaseOffersCount(data) {
                let item = _.find(this.tableData, function(o) {
                    return (o.date === data.date && o.market_id.$oid === data.market_id);
                });

                item.count ++;
            },
            decreaseOffersCount(data) {
               let item = _.find(this.tableData, function(o) {
                   return (o.date === data.date && o.market_id.$oid === data.market_id);
               });

               item.count -= data.ids.length;
            }
        }
    }
</script>