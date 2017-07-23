<template>
    <div v-show="show" v-loading.fullscreen.lock="loading">
        <marketplace :data="place"></marketplace>
        <price-list :products="products"
                    :types="types"
                    :names="names"
                    @new-data-set="setProducts"
                    @show-graph-modal="showModal"></price-list>
        <el-dialog :title="selectedProduct" :visible.sync="dialogFormVisible" size="large" @close="cleanGraphsData">
            <graph :product="product" @update-graph-data="updateProductData"></graph>
            <span slot="footer" class="dialog-footer">
            <el-button type="primary" @click="dialogFormVisible = false">Zamknij</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
    import Marketplace from './Marketplace.vue';
    import PriceList from './PriceList.vue';

    export default {
        components: { Marketplace,  PriceList },
        data() {
            return {
                products: [],
                place: {},
                types:[],
                names:{},
                product:[],
                path: location.pathname,
                dialogFormVisible: false,
                show: false,
                loading: true
            }
        },
        computed: {
          selectedProduct() {
              if(this.product.length > 0) {
                  return 'Produkt: '+ this.product[0].product;
              }
              return '';
          }
        },
        created() {
            this.getMarketData();
            this.show = true;
            this.loading = false;
        },
        methods: {
            getMarketData() {
                axios.get('/api' + this.path + '/products')
                .then(response => {
                    this.prepareProductsData(response.data);
                    this.preparePlaceData(response.data.data.place_data[0]);
                }).catch(error => {
                    window.location.replace(window.location.origin);
                })
            },
            getProductData(productName) {
                axios.get('/api' + this.path + '/products/' + productName)
                    .then(response => {
                       this.product = response.data.data.products_list;
                       this.dialogFormVisible = true;
                    }).catch(error => {
                    console.log(error.response.data);
                })
            },
            updateProductData(data) {
                axios.get('/api' + this.path + '/products/' + data.productName, { params:
                        {
                        minDate: data.dateRange.minDate,
                        maxDate: data.dateRange.maxDate
                        }
                    }).then(response => {
                        this.product = response.data.data.products_list;
                    }).catch(error => {
                    console.log(error.response.data);
                })
            },
            setProducts(data) {
                this.prepareProductsData(data);
            },
            prepareProductsData(dataToPrep) {
                let data = dataToPrep.data;

                this.products = data.products_list;
                this.types = this.productTypes(data.products_list);
                this.names = this.loadProductsNames(data.products_list);
            },
            preparePlaceData(dataToPrep) {
                this.place = dataToPrep;
            },
            productTypes(data) {
                return _.uniq(_.map(data, 'type'));
            },
            loadProductsNames(data) {
                let uniqeProductList = _.uniq(_.map(data, 'product'));

                return uniqeProductList.map(item => {
                    return {'value': item};
                });
            },
            showModal(data) {
                this.getProductData(data.product);
            },
            cleanGraphsData() {
                window.events.$emit('clean-graph-data');
            }
        }
    }
</script>