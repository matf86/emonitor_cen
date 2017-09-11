<template>
    <el-dialog :title="'Produkt: '+ selectedProduct" :visible.sync="dialogFormVisible" size="large" @close="hideDialog(false)">
        <product-price-graph :product="productList" :selected="selectedProduct"></product-price-graph>
        <span slot="footer" class="dialog-footer">
            <el-button type="primary" @click="hideDialog(false)">Zamknij</el-button>
        </span>
    </el-dialog>
</template>

<script>
    import ProductPriceGraph from './ProductPriceGraph.vue';

    export default {
        components: { ProductPriceGraph },
        props: ['data', 'visible'],
        data() {
            return {
                productList: [],
                dialogFormVisible: false

            }
        },
        watch: {
            data() {
                this.productList = this.data;
            },
            visible() {
                this.dialogFormVisible = this.visible;
            }
        },
        computed: {
            selectedProduct() {
                if(this.productList.length > 0) {
                    return this.productList[0].product;
                }
                return '';
            }
        },
        methods: {
            hideDialog(state) {
                if (state === false) {
                    this.$root.$emit('hide-dialog', state);
                }
            },
        }

    }
</script>