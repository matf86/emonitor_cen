<template>
    <el-autocomplete
            class="inline-input input-size"
            size="large"
            v-model="searchInput"
            :fetch-suggestions="querySearch"
            placeholder="Znajdź produkt..."
            :triggerOnFocus="true"
            @select="showProduct"
            @input="resetData"
            icon="search">
    </el-autocomplete>
</template>

<script>

    export default {
        props: ['data'],
        data() {
            return {
                searchInput:'',
            }
        },
        created() {
            this.$root.$on('update-offer-list', this.clearSearchInput); //event emitted by OfferManagerTable component
            this.$root.$on('filter-by-type', () => {
                this.searchInput = '';
            });
        },
        methods: {
            clearSearchInput() {
              this.searchInput = '';
            },
            querySearch(queryString, cb) {
                let query = queryString.trim().toLowerCase();
                let productsNames = this.data;
                let results = query ? this.createFilter(query) : productsNames;

                cb(results);
            },
            createFilter(query) {
                let productsNames = this.data;

                return productsNames.filter(product =>
                    product.value.toLowerCase().includes(query)
                );
            },
            showProduct(item) {
                this.$emit('show-product-by-name', item);
            },
            resetData(item) {
                if(!item) {
                    this.$emit('reset-table-data', item);
                }
            }
        }
    }
</script>