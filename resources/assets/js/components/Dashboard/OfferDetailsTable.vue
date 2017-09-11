<template>
    <div>
    <el-row style="margin: 10px 0;">
        <el-button
                size="small"
                type="danger"
                :disabled="canDelete"
                @click="deleteConfirm">Usuń zaznaczone wiersze
        </el-button>
        <el-button
                size="small"
                type="success"
                @click="showOfferFormDialog(null, null)">Dodaj oferte
        </el-button>
    </el-row>
    <el-table
            :height="tableHeight"
            ref="multipleTable"
            :data="tableData"
            border
            style="width: 100%"
            @selection-change="handleSelectionChange">
        <el-table-column
            fixed
            type="selection"
            min-width="55">
        </el-table-column>
        <el-table-column
            sortable
            prop="product"
            label="Produkt"
            width="150">
        </el-table-column>
        <el-table-column
            sortable
            prop="origin"
            label="Pochodzenie"
            min-width="150">
        </el-table-column>
        <el-table-column
            prop="package"
            label="Ilość"
            min-width="150">
        </el-table-column>
        <el-table-column
            sortable
            prop="price_min"
            label="Cena min"
            min-width="120">
        </el-table-column>
        <el-table-column
            sortable
            prop="price_max"
            label="Cena max"
            min-width="120">
        </el-table-column>
        <el-table-column
            fixed="right"
            label="Opcje"
            width="100">
            <template scope="scope">
                <el-button
                    size="small"
                    @click="showOfferFormDialog(scope.$index, scope.row)">Edytuj
                </el-button>
            </template>
        </el-table-column>
    </el-table>
    </div>
</template>

<script>
    export default {
        props:['data'],
        data() {
            return {
                multipleSelection: [],
                tableData: this.data
            }
        },
        watch: {
            data() {
                this.tableData = this.data;
            }
        },
        computed: {
            tableHeight() {
                return window.innerHeight * 0.5;
            },
            canDelete() {
                return Boolean(!this.multipleSelection.length);
            }
        },
        methods:{
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            showOfferFormDialog(index, data) {
                this.$emit('show-offer-form-dialog', {'index': index, 'data':data});
            },
            deleteConfirm() {
                this.$confirm(`Czy napewno chcesz usnąc zaznaczone oferty.`, 'Uwaga!', {
                    confirmButtonText: 'Usuń',
                    confirmButtonClass: 'el-button--danger',
                    cancelButtonText: 'Anuluj',
                }).then(() => {
                    this.deleteSelectedOffers(this.multipleSelection);
                }).catch(() => {

                });
            },
            deleteSelectedOffers(data) {
                let ids = data.map(item => item._id);
                let place_id = data[0]['place_id'];
                let date = data[0]['date'];

                axios({
                    method: 'delete',
                    url: '/api/dashboard/offers/selected',
                    data: {'ids': ids, 'place_id':  place_id, 'date': date}
                }).then(response => {
                    this.$root.$emit('update-offer-manager-table');
                    this.$root.$emit('update-offer-list', response.data);
                    this.$notify.success({
                        title: 'Success',
                        message: response.data.msg,
                        duration: 2500
                    });
                }).catch(error => {
                    this.$notify.error({
                        title: 'Error',
                        message: error.response,
                        duration: 0
                    });
                })
            }
        }
    }
</script>