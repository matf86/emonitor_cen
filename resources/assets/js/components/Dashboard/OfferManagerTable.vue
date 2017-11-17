<template>
    <el-table
            :default-sort = "{prop: 'date', order: 'descending'}"
            @sort-change="sortAndPaginate"
            :data="entriesList"
            border
            empty-text="Brak danch..."
            style="width:100%; margin: 5px 0;">
        <el-table-column
                    fixed
                    sortable
                    prop="date"
                    label="Data"
                    min-width="130">
            <template scope="scope">
                <el-icon name="date"></el-icon>
                <span style="margin-left: 3px">{{ scope.row.date }}</span>
            </template>
        </el-table-column>
        <el-table-column
                    sortable
                    prop="market_name"
                    label="Nazwa"
                    min-width="300">
        </el-table-column>
        <el-table-column
                    sortable
                    prop="count"
                    label="Ilość"
                    min-width="95">
        </el-table-column>
        <el-table-column
                    label="Opcje"
                    min-width="175">
            <template scope="scope">
                <el-button
                        size="small"
                        @click="getOffers(scope.$index, scope.row)">Szczegóły
                </el-button>
                <el-button
                        size="small"
                        type="danger"
                        @click="deleteConfirm(scope.$index, scope.row)">Usuń
                </el-button>
            </template>
        </el-table-column>
    </el-table>
</template>

<script>

    export default {
        props: ['data'],
        data() {
            return {
                entriesList: this.data,
            }
        },
        watch: {
          data() {
              this.entriesList = this.data;
          }
        },
        methods: {
            sortEntries(column) {
                this.sortAndPaginate(column);
            },
            sortAndPaginate(data) {
                this.$root.$emit('paginate', data);
            },
            getOffers(index, data) {
                this.$root.$emit('get-offers', {'index': index, 'data': data});
            },
            deleteOffers(data) {
                let date = data.date;
                let slug = data.market_slug;

                axios.delete('/dashboard/markets/'+ slug  +'/offers', {
                    params: {
                        date: date,
                    }
                }).then(() => {
                    this.$root.$emit('delete-table-entry', {'date':date, 'slug': slug});
                    this.$notify.success({
                        message: `Wszystkie oferty z dnia ${date} dla ${data.market_name} zostały usunięte.`,
                        duration: 4000
                    });
                }).catch(error => {
                    this.$notify.error({
                        message: 'Operacja usunięcia nie powiodla się...',
                        duration: 0
                    });
                    console.log(error);
                })
            },
            deleteConfirm(index, row) {
                this.$confirm(`Czy napewno chcesz usnąc wszystkie wpisy dla ${row.market} z dnia: ${row.date}`, 'Uwaga!', {
                    confirmButtonText: 'Usuń',
                    confirmButtonClass: 'el-button--danger',
                    cancelButtonText: 'Anuluj',
                }).then(() => {
                    this.deleteOffers(row);
                }).catch(() => {

                });
            }
        }
    }
</script>