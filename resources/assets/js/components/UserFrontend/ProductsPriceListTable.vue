<template>
    <div>
        <el-table
                :default-sort = "{prop: 'product', order: 'ascending'}"
                @sort-change="sort"
                :data="entriesList"
                border
                empty-text="Brak danch..."
                style="width:100%; margin: 5px 0;"
                @cell-click='showDialog'>>
            <el-table-column
                    fixed="left"
                    sortable="custom"
                    label="Produkt"
                    min-width="150">
                <template scope="scope">
                    <el-tag><i class="fa fa-line-chart" aria-hidden="true"></i></el-tag>
                    <span style="margin-left: 10px">{{ scope.row.product }}</span>
                </template>
            </el-table-column>
            <el-table-column
                    label="Cena min"
                    min-width="70">
                <template scope="scope">
                    <span>{{ scope.row.price_min }} zł</span>
                </template>
            </el-table-column>
            <el-table-column
                    label="Cena max"
                    min-width="70">
                <template scope="scope">
                    <span>{{ scope.row.price_max }} zł</span>
                </template>
            </el-table-column>
            <el-table-column
                    prop="package"
                    label="Ilość"
                    min-width="90">
            </el-table-column>
            <el-table-column
                    prop="origin"
                    label="Pochodzenie"
                    min-width="75">
            </el-table-column>
        </el-table>
        <product-price-graph-dialog :data="productPriceList"
                                    :visible="chartDialogVisible"
                                    :product="selectedProduct"
                                    :market="market">
        </product-price-graph-dialog>
    </div>

</template>

<script>
    import ProductPriceGraphDialog from './ProductPriceGraphDialog.vue';

    export default {
        components: { ProductPriceGraphDialog},
        props: ['data', 'market'],
        data() {
            return {
                selectedProduct: '',
                entriesList: this.data,
                productPriceList: [],
                chartDialogVisible: false,
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
//            sortEntries(column) {
//                this.sortAndPaginate(column);
//            },
            sort(data) {
                this.$root.$emit('paginate', data);
            },
            showDialog(row, col) {
                this.getProductData(row);
            },
            hideDialog() {
                this.chartDialogVisible = false;
                this.productPriceList = [];
            },
            // Invoked by showDialog event handler.
            // @productName string - passed by @row-click event.
            getProductData(data) {
                this.loading = true;

                //Set date range for query, default period of time 1 month.
                let dateRange = [];
                let end = moment();
                let start = end.clone().subtract(1, 'months');

                dateRange[0] = start.format('YYYY-MM-DD');
                dateRange[1] = end.format('YYYY-MM-DD');

                let params = { params: {
                    product: data.product,
                    package: data.package,
                    origin: data.origin,
                    dateRange: dateRange
                }};

                axios.get(this.slug +'/offers', params).then(response => {
                        this.productPriceList = response.data.data;
                        this.selectedProduct = data;
                        this.chartDialogVisible = true;
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
            }
        }
    }
</script>