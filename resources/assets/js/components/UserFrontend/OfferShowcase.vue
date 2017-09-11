<template>
    <div>
        <market-info :data="placeData"></market-info>
        <products-price-list :data="products" :date="date" :types="productsTypes"></products-price-list>
    </div>
</template>

<script>
    import MarketInfo from './MarketInfo.vue';
    import ProductsPriceList from './ProductsPriceList.vue';

    export default {
        components: { MarketInfo,  ProductsPriceList },
        data() {
            return {
                date:'',
                products: [],
                productsTypes: [],
                placeData: {},
                path: location.pathname,
            }
        },
        created() {
            this.$root.$on('reload-products-data', this.setProductsData);
            this.getMarketData();
        },
        methods: {
            getMarketData() {
                axios.get('/api' + this.path + '/products')
                .then(response => {
                    this.setProductsData(response.data.data.products_list);
                    this.placeData = response.data.data.place_data;
                }).catch(error => {
                    return noData('Błąd serwera, spróbój ponownie puźniej.');
                })
            },
            setProductsData(data) {
                if(data.length > 0) {
                    this.products = data;
                    this.date = data[0]['date'];

                    this.productsTypes = this.setProductsTypes(data);

                    return
                }

                this.products = [];
            },
            setProductsTypes(data) {
                return _.uniq(_.map(data, 'type')).sort();
            },
        }
    }
</script>