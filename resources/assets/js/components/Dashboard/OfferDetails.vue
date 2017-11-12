<template>
    <div>
        <offer-details-table @show-offer-form-dialog="showOfferFormDialog"
                             :data="tableData">
        </offer-details-table>
        <offer-form-dialog :data="rowData"
                           :visible="offerFormDialogVisible"
                           :type="dialogType"
                           @hide-form="hideOfferFormDialog">
        </offer-form-dialog>
    </div>
</template>

<script>
    import OfferDetailsTable from './OfferDetailsTable.vue';
    import OfferFormDialog from './OfferFormDialog.vue';

    export default {
        components: { OfferFormDialog, OfferDetailsTable },
        props:['offersList', 'offerData'],
        data() {
            return {
                rowData:{},
                offerFormDialogVisible: false,
                dialogType: '',
                tableData: this.offersList,
            }
        },
        watch: {
            offersList() {
                this.tableData = this.offersList;
            }
        },
        methods: {
            hideOfferFormDialog(state) {
                this.offerFormDialogVisible = state;
                this.rowData = {};
            },
            showOfferFormDialog(data) {
                if(data.index === null) {
                    this.rowData = {
                        'date': this.offerData['date'],
                        'market_id': this.offerData['market_id']
                    }
                    this.dialogType = 'create';
                }

                if(Number.isInteger(data.index)) {
                    this.rowData = data.data;
                    this.dialogType = 'edit';
                }

                this.offerFormDialogVisible = true;
            }
        }
    }
</script>

<style>
    table {
        border-collapse: separate;
        border-spacing: 0;
    }
</style>

