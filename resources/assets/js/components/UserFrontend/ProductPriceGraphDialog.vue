<template>
    <el-dialog :visible.sync="dialogFormVisible" size="full" @close="hideDialog(false)">
        <h4 class="center">{{market.name}} | {{product.product}} | {{ product.package }}</h4>
        <product-price-graph :products="productsList" :selected="selectedProduct" :market="market"></product-price-graph>
        <span slot="footer" class="dialog-footer">
            <el-col class="mb-1">
                <el-button class="btn-mobile" type="primary" @click="hideDialog(false)">Zamknij</el-button>
            </el-col>
        </span>
    </el-dialog>
</template>

<script>
    import ProductPriceGraph from './ProductPriceGraph.vue';

    export default {
        components: { ProductPriceGraph },
        props: ['data', 'visible', 'product', 'market'],
        data() {
            return {
                productsList: [],
                dialogFormVisible: false,
                selectedProduct: ''
            }
        },
        watch: {
            data() {
                this.productsList = this.data;
            },
            visible() {
                this.dialogFormVisible = this.visible;
            },
            product() {
                this.selectedProduct = this.product;
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