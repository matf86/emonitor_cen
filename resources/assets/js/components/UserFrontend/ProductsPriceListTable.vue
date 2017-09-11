<template>
    <div>
        <el-table
                :default-sort = "{prop: 'product', order: 'descending'}"
                @sort-change="sortAndPaginate"
                :data="entriesList"
                border
                empty-text="Brak danch..."
                style="width:100%; margin: 5px 0;"
                @row-click='showDialog'>>
            <el-table-column
                    fixed
                    sortable="custom"
                    prop="product"
                    label="Produkt"
                    min-width="120">
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
        </el-table>
        <product-price-graph-dialog :data="productPriceList"
                                    :visible="dialogFormVisible">
        </product-price-graph-dialog>
    </div>

</template>

<script>
    import ProductPriceGraphDialog from './ProductPriceGraphDialog.vue';

    export default {
        components: { ProductPriceGraphDialog },
        props: ['data'],
        data() {
            return {
                entriesList: this.data,
                productPriceList: [],
                dialogFormVisible: false,
                path: location.pathname,
            }
        },
        watch: {
          data() {
              this.entriesList = this.data;
          }
        },
        created() {
            this.$root.$on('update-graph-data', this.updateProductList);
            this.$root.$on('hide-dialog', this.hideDialog);
        },
        methods: {
            sortEntries(column) {
                this.sortAndPaginate(column);
            },
            sortAndPaginate(data) {
                this.$root.$emit('paginate', data);
            },
            showDialog(data) {
                this.getProductData(data.product);
            },
            hideDialog() {
                this.dialogFormVisible = false;
                this.productPriceList = [];
            },
            getProductData(productName) {
                axios.get('/api' + this.path + '/products/' + productName)
                    .then(response => {
                        this.productPriceList = response.data.data.products_list;
                        this.dialogFormVisible = true;
                    }).catch(error => {
                    console.log(error.response.data);
                })
            },
            updateProductList(data) {
                axios.get('/api' + this.path + '/products/' + data.productName, { params:
                    {
                        minDate: data.dateRange.minDate,
                        maxDate: data.dateRange.maxDate
                    }
                }).then(response => {
                    this.productPriceList = response.data.data.products_list;
                }).catch(error => {
                    this.productList = [];
                    this.$notify.error({
                        title: 'Error',
                        message: error.response.data,
                        duration: 0
                    });
                })
            },
        }
    }
</script>