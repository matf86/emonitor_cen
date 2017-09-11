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
            this.$root.$on('update-offer-list', this.updateOfferList);
            this.$root.$on('get-offers', this.getOffers);
        },
        methods: {
            hideDialog() {
                this.dialogFormVisible = false;
                this.offerData = {};
                this.offersList = [];
            },
            getOffers(payload) {
                let date = payload.data.date;
                let id = payload.data.place_id.$oid;
                let place = payload.data.place;

                axios.get('/api/dashboard/offers', {
                    params: {
                        date: date,
                        id: id
                    }
                }).then(response => {
                    this.offersList = response.data.data.offers;
                    this.offerData = {'date': date, 'place_id': id, 'place': place};
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
                   return this.offersList = response.data;
                }

                let index = _.findIndex(this.offersList, {_id: response.data._id});

                if(index === -1) {
                    return this.offersList.push(response.data);
                }

                this.offersList.splice(index, 1, response.data);
            },
        }
    }
</script>

<style>
    el-dialog {
        margin-bottom: 0px;
    }
</style>