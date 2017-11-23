<template>
    <div>
        <el-table
                :default-sort = "{prop: 'product', order: 'ascending'}"
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
                    min-width="230">
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
                                    :visible="dialogFormVisible"
                                    :product="selectedProduct"
                                    :market="market">
        </product-price-graph-dialog>
    </div>

</template>

<script>
    import ProductPriceGraphDialog from './ProductPriceGraphDialog.vue';

    export default {
        components: { ProductPriceGraphDialog },
        props: ['data', 'market'],
        data() {
            return {
                selectedProduct: '',
                entriesList: this.data,
                productPriceList: [],
                dialogFormVisible: false,
                slug: location.pathname,
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
                this.getProductData(data);
            },
            hideDialog() {
                this.dialogFormVisible = false;
                this.productPriceList = [];
            },
            // Invoked by showDialog event handler.
            // @productName string - passed by @row-click event.
            getProductData(data) {

                this.loading = true;

                let params = { params: {
                    product: data.product,
                    package: data.package,
                    origin: data.origin
                }};


                axios.get(this.slug +'/offers', params).then(response => {
                        this.productPriceList = response.data.data;
                        this.selectedProduct = data;
                        this.dialogFormVisible = true;
                }).catch(error => {
                    this.productPriceList = [];
                    this.$notify.error({
                        title: 'Error',
                        message: 'Wystąpił błąd podczas pobierania danych...',
                        duration: 0
                    });
                    console.log(error);
                });
            },
            // Updates product price graph after picking new date range.
            // @data Object - passed by @update-graph-data event.
            updateProductList(data) {
                let dateRange = [];
                dateRange[0] = data.dateRange.from;
                dateRange[1] = data.dateRange.to;

                axios.get(this.slug +'/offers', { params:
                    {
                        product: data.productName,
                        package: data.package,
                        origin: data.origin,
                        dateRange: dateRange
                    }
                }).then(response => {
                    this.productPriceList = response.data.data;
                }).catch(error => {
                    this.productPriceList = [];
                    this.$notify.error({
                        message: 'Wystąpił błąd podczas pobierania danych...',
                        duration: 0
                    });
                    console.log(error);
                });
            },
        }
    }
</script>