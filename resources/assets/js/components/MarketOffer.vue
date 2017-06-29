<template>
    <el-row>
        <marketplace :data="place"></marketplace>
        <price-list :products="products" @new-data-set="setProducts"></price-list>
    </el-row>
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
                path: location.pathname
            }
        },
        created() {
            this.getMarketData();
        },
        methods: {
            getMarketData() {
                axios.get(this.path)
                .then(response => {
                    let data = response.data
                    this.products = data;
                    this.place = {
                        'name': data[0].place,
                        'city': data[0].city,
                    }
                }).catch(error => {
                    console.log(error.response.data);
                })
            },
            setProducts(data) {
                this.products = data;
            }
        }
    }
</script>