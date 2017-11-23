<template>
    <div style="margin: 15px 15px 0 15px;">
        <el-row>
            <date-picker :date="date">
                <span slot="title">Dane dla dnia:</span>
            </date-picker>
        </el-row>
        <el-row style="margin: 15px 0;">
            <el-col :xs="24" :sm="24" :md="10" :lg="10" style="margin: 5px 0;">
                <checkbox-types :data="types"></checkbox-types>
            </el-col>
            <el-col :xs="24" :sm="24" :md="14" :lg="14" style="margin: 5px 0;">
                <search-product :data="productsNames" @show-product-by-name="showProduct" @reset-table-data="resetTableData"></search-product>
            </el-col>
        </el-row>
        <el-row>
            <products-price-list-table :data="entriesList" :market="market"></products-price-list-table>
        </el-row>
        <pagination :data="tableData"  @set-sliced-table-data="setEntriesList"></pagination>
    </div>
</template>

<script>
    import SearchProduct from '../SearchProduct.vue'
    import CheckboxTypes from './CheckboxTypes.vue';
    import ProductsPriceListTable from './ProductsPriceListTable.vue'

    export default {
        components: { CheckboxTypes, ProductsPriceListTable, SearchProduct },
        props: ['data', 'date', 'types', 'market'],
        data() {
            return {
                entriesList: [],
                tableData: [],
                checkedTypes: [],
                productsNames: [],
                productsTypes: [],
            }
        },
        watch:{
            data() {
                this.setTableData(this.data);
            },
            types() {
                this.checkedTypes = this.types;
            }
        },
        created() {
            this.$root.$on('filter-by-type', this.setTableDataByType);
        },
        methods: {
            setEntriesList(data) {
                this.entriesList = data
            },
            setTableDataByType(checkedTypes) {
                this.setCheckedTypes(checkedTypes);
                this.setTableData(this.filterByType());
            },
            setCheckedTypes(checkedTypes) {
                this.checkedTypes = checkedTypes;
            },
            filterByType() {
               return this.data.filter(product =>
                  _.includes(this.checkedTypes, product.type)
               );
            },
            setTableData(data) {
                if(data.length > 0) {
                    this.productsNames = this.setProductsNames(data);
                    this.tableData = data;

                    return
                }

                this.tableData = [];
                this.productsNames =[];
                this.productsTypes =[];
            },
            setProductsNames(data) {
                let uniqeProductList = _.uniq(_.map(data, 'product'));

                return uniqeProductList.map(item => {
                    return {'value': item};
                });
            },
            showProduct(item) {
              let filteredProducts = this.filterByType();

              let product = filteredProducts.filter(element =>
                  _.includes(item.value, element.product)              
              );

              if(product.length > 0) {
                return this.tableData = product;
              }

             return noData('Brak wybranego produktu.'); 
            },
            resetTableData() {
                this.tableData = this.filterByType();
            }
        }
    }
</script>

<style>
    .el-table tr {
        background-color: #fff;
        cursor: pointer;
    }
</style>
