<template>
    <div>
    <el-row>
        <date-range-picker @set-date-range="setDateRange"></date-range-picker>
        <checkbox-places :data="places" @set-places-list="setCheckedPlaces"></checkbox-places>
        <el-button type="success" icon="search" style="margin: 5px 0 0 0;" @click="updateTableData">Szukaj</el-button>
    </el-row>
        <offer-manager-table :data="entriesList"></offer-manager-table>
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
            }
        },
        created() {
            this.$root.$on('update-offer-manager-table', this.updateTableData);
            this.$root.$on('delete-table-entry', this.deleteTableData);

            this.getInitialTableData();
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
            getInitialTableData() {
                axios.get('/api/dashboard/offers/entries').then(response => {
                    let data = response.data.data.entries_list;
                    this.tableData = _.orderBy(data, ['date'],['desc']);
                    this.setPlacesList(response.data.data.entries_list);
                }).catch(error => {
                    this.$notify.error({
                        title: 'Error',
                        message: error.response.data,
                        duration: 0
                    });
                })
            },
            updateTableData() {
                axios.get('/api/dashboard/offers/entries', {
                    params: {
                        id: (this.checkedPlaces.length === 0)? [null] : this.checkedPlaces,
                        minDate: this.dateRange[0],
                        maxDate: this.dateRange[1]
                    }
                }).then(response => {
                    let data = response.data.data.entries_list;
                    this.tableData = _.orderBy(data, ['date'],['desc']);
                }).catch(error => {
                  this.$notify.error({
                    title: 'Error',
                    message: error.response.data,
                    duration: 0
                  });
                })
            },
            deleteTableData(data) {
                    this.tableData = this.tableData.filter(e => {
                        return !(e.place_id.$oid === data.id && e.date === data.date);
                });
            },
            setPlacesList(data) {
                let results =  _.uniqWith(_.map(data, function(item) {
                    return {
                        label: item.place,
                        value: item.place_id.$oid
                    }
                }), _.isEqual);

                this.places = results;
            }
        }
    }
</script>