<template>
    <div>
        <market-info :data="marketData"></market-info>
        <products-price-list v-loading="loading" element-loading-text="Wczytuje..." :data="products" :date="date" :types="productsTypes" :market="marketData"></products-price-list>
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
                productsTypes: [],
                loading: true
            }
        },
        created() {
            this.$root.$on('reload-products-data', this.getOffers);
            this.getOffers(null);
        },
        methods: {
            getOffers(date) {
                this.loading = true;
                console.log(date);
                axios.get('/markets/'+this.marketData.slug+'/offers',{ params:
                    {
                        date: date
                    }
                }).then(response => {
                    this.setProductsData(response.data.data);
                    this.loading = false;
                }).catch(error => {
                    this.$notify.error({
                        message: 'Wystąpił błąd podczas pobierania danych...',
                        duration: 0
                    });
                    this.loading = false;
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