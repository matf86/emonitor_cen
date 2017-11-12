<template>
    <el-dialog :title="'Szczegółowa oferta dla: ' + offerData.market + ' z dnia '+ offerData.date"
               :visible.sync="dialogFormVisible"
               @visible-change="hideDialog"
               size="full">
        <offer-details :offers-list="offersList"
                       :offer-data="offerData">
        </offer-details>
        <span slot="footer" class="dialog-footer">
            <el-col class="mb-1 btn-stacked">
                <el-button class="btn-mobile" type="primary" size="small" @click="hideDialog(false)">Zamknij</el-button>
            </el-col>
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