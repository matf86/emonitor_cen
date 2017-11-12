<template>
        <div class="manager-size">
            <offer-manager-list></offer-manager-list>
            <offer-manager-dialog :data="offerData" :list="offersList" :show="dialogFormVisible" @hide-dialog="hideDialog"></offer-manager-dialog>
        </div>
</template>

<script>
    import OfferManagerList from './OfferManagerList.vue';
    import OfferManagerDialog from './OfferManagerDialog.vue';

    export default {
        components: { OfferManagerList, OfferManagerDialog },
        data() {
            return {
                offersList:[],
                offerData: {},
                dialogFormVisible: false,
            }
        },
        created() {
            this.$root.$on('update-offer-list', this.updateOfferList);// event emitted by OfferDetailsTable and OfferFormDialog
            this.$root.$on('get-offers', this.getOffers);// event emitted by OfferManager
        },
        methods: {
            hideDialog() {
                this.dialogFormVisible = false;
                this.offerData = {};
                this.offersList = [];
            },
            //Dispatched on "get-offers" event emitted by OfferManager component,
            //
            //@param payload Object parameters{count, date, market_id, market_name, market_slug}
            //
            //@return ajax response - all offers from given market on given date
            getOffers(payload) {
                let date = payload.data.date;
                let id = payload.data.market_id.$oid;
                let market = payload.data.market_name;

                axios.get('/markets/'+ payload.data.market_slug +'/offers', {
                    params: {
                        date: date,
                    }
                }).then(response => {
                    this.offersList = response.data.data;
                    this.offerData = {'date': date, 'market_id': id, 'market': market};
                    this.dialogFormVisible = true;
                }).catch(error => {
                    this.$notify.error({
                        title: 'Error',
                        message: error.response.data,
                        duration: 0
                    });
                })
            },
            updateOfferList(response) {
                if(response.type === 'delete') {
                   return this.offersList = this.offersList.filter(x => response.ids.indexOf(x._id) == -1);
                }

                let index = _.findIndex(this.offersList, {_id: response.data._id});

                if(index !== -1) {
                    this.offersList.splice(index, 1);
                }

                return this.offersList.unshift(response.data);
            },
        }
    }
</script>
