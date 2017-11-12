<template>
    <div>
    <el-row style="margin: 10px 0;" >
        <el-col :xs="24" :sm="10" :md="8" :lg="6"  class="mt-1">
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
        </el-col>
        <el-col :xs="24" :sm="12" :md="14" :lg="16">
            <search-product class="mt-1" :data="productsNames" @show-product-by-name="showProduct" @reset-table-data="resetTableData" ref="searchInput"></search-product>
        </el-col>
    </el-row>
    <el-table
            v-loading="loading"
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
    import { Loading } from 'element-ui';
    import SearchProduct from '../SearchProduct.vue'

    export default {
        components: { Loading, SearchProduct },
        props:['data'],
        data() {
            return {
                productsNames:[],
                multipleSelection: [],
                tableData: this.data,
                loading: false
            }
        },
        watch: {
            data() {
                this.tableData = this.data;
                this.setProductsNames(this.data);
            }
        },
        created() {
            this.setProductsNames(this.data);
        },
        computed: {
            tableHeight() {
                return window.innerHeight * 0.75;
            },
            canDelete() {
                return Boolean(!this.multipleSelection.length);
            }
        },
        methods:{
            setProductsNames(data) {
                let uniqueProductList = _.uniq(_.map(data, 'product'));

                this.productsNames = uniqueProductList.map(item => {
                    return {'value': item};
                });
            },
            showProduct(item) {
                let product = this.tableData.filter(element =>
                    _.includes(item.value, element.product)
                );

                if(product.length > 0) {
                    return this.tableData = product;
                }
            },
            resetTableData() {
                this.tableData = this.data;
            },

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
                this.loading = true;
                let ids = data.map(item => item._id);
                let market_id = this.$parent.offerData.market_id;
                let date = this.$parent.offerData.date;

                axios({
                    method: 'delete',
                    url: '/dashboard/offers',
                    data: {'ids': ids}
                }).then(() => {
                    this.$root.$emit('decrease-offers-count', {'ids': ids, 'market_id': market_id, 'date': date});
                    this.$root.$emit('update-offer-list', {'ids': ids, 'type': 'delete'});
                    this.$notify.success({
                        title: 'Success',
                        message: 'Wskazane oferty zostały usunięte',
                        duration: 2500
                    });
                    this.loading = false;
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