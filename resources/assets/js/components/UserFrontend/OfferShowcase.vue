<template>
    <div>
        <market-info :data="marketData"></market-info>
        <products-price-list :data="products" :date="date" :types="productsTypes" :market="marketData"></products-price-list>
    </div>
</template>

<script>
    import MarketInfo from './MarketInfo.vue';
    import ProductsPriceList from './ProductsPriceList.vue';

    export default {
        props: ['marketData'],
        components: { MarketInfo,  ProductsPriceList },
        data() {
            return {
                date:'',
                products: [],
                productsTypes: []
//                placeData: {},
            }
        },
        created() {
            this.$root.$on('reload-products-data', this.getOffers);
            this.getOffers(null);
        },
        methods: {
            getOffers(date) {
                console.log(date);
                axios.get('/markets/'+this.marketData.slug+'/offers',{ params:
                    {
                        date: date
                    }
                }).then(response => {
                    this.setProductsData(response.data.data);
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