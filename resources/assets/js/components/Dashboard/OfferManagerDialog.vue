<template>
    <el-dialog :title="'Szczegółowa oferta dla ' + offerData.place + ' z dnia: '+ offerData.date"
               :visible.sync="dialogFormVisible"
               @visible-change="hideDialog"
               size="large">
        <offer-details :offers-list="offersList"
                       :offer-data="offerData">
        </offer-details>
        <span slot="footer" class="dialog-footer">
        <el-button type="primary" size="small" @click="hideDialog(false)">Zamknij</el-button>
        </span>
    </el-dialog>
</template>

<script>
    import OfferDetails from './OfferDetails.vue';

    export default {
        props:['data', 'list', 'show'],
        components: { OfferDetails },
        data() {
            return {
                offersList:[],
                offerData: {},
                dialogFormVisible: false,
            }
        },
        watch: {
            data() {
                this.offerData = this.data;
            },
            list() {
                this.offersList = this.list;
            },
            show() {
                this.dialogFormVisible = this.show;
            }
        },
        methods: {
            hideDialog(state) {
                if (state === false) {
                    this.$emit('hide-dialog', state);
                }
            },
        }
    }
</script>