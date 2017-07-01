<template>
    <div>
        <marketplace :data="place"></marketplace>
        <price-list :products="products" :types="types" :names="names" @new-data-set="setProducts"></price-list>
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
                path: location.pathname
            }
        },
        created() {
            this.getMarketData();
        },
        methods: {
            getMarketData() {
                axios.get('/api'+this.path+'/products')
                .then(response => {
                    this.prepareData(response.data);
                }).catch(error => {
                    console.log(error.response.data);
                })
            },
            setProducts(data) {
                this.prepareData(data);
            },
            prepareData(dataToPrep) {
                let data = dataToPrep;
                this.products = data;
                this.place = {
                    'name': data[0].place,
                    'city': data[0].city,
                };
                this.types = this.productTypes(data);
                this.names = this.loadProductsNames(data);
            },
            productTypes(data) {
                return _.uniq(_.map(data, 'type'));
            },
            loadProductsNames(data) {
                let uniqeProductList = _.uniq(_.map(data, 'product'));

                return uniqeProductList.map(item => {
                    return {'value': item};
                });
            }
        }
    }
</script>