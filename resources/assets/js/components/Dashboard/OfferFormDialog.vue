<template>
    <el-dialog :title="title" :visible.sync="offerFormVisible" size="small" @visible-change="hideForm"
               ref="dialog">
        <offer-form :data="data" :emptyForm="form" ref="form"></offer-form>
        <span slot="footer" class="dialog-footer">
            <el-col class="mb-1 btn-stacked">
                <el-button class="btn-mobile" @click="hideForm(false)">Anuluj</el-button>
                <el-button class="btn-mobile" type="primary" @click="addOffer">Dodaj</el-button>
            </el-col>
        </span>
    </el-dialog>
</template>

<script>
    import OfferForm from './OfferForm.vue';

    export default {
        components: {OfferForm},
        props: ['visible', 'data', 'type'],
        data() {
            return {
                form: {
                    origin: '',
                    package: '',
                    price_max: 0,
                    price_min: 0,
                    product: '',
                    type: '',
                    market_id: '',
                    date: ''
                }
            }
        },
        mounted() {
            document.body.appendChild(this.$refs.dialog.$el);
        },
        computed: {
            offerFormVisible() {
                return this.visible;
            },
            title() {
                return (this.type === 'edit') ? 'Edytuj ofertę' : 'Dodaj ofertę';
            }
        },
        methods: {
            clearForm() {
                for (let prop in this.form) {
                    this.form[prop] = '';
                }
            },
            hideForm(state) {
                if (state === false) {
                    this.$emit('hide-form', state);
                    this.$refs['form'].$refs['offerForm'].resetFields();
                    this.clearForm();
                }
            },
            axiosAdd() {
                axios.post('/dashboard/offers', this.form)
                    .then(response => {
                        this.$root.$emit('update-offer-list', response.data);
                        this.$root.$emit('increase-offers-count', {'market_id': this.form.market_id, 'date': this.form.date});
                        this.hideForm(false);
                        this.$notify.success({
                            title: 'Sukces',
                            message: 'Operacja dodania oferty powiodła się.',
                            duration: 2500
                        });
                    }).catch(response => {
                    console.log('error:' + response);
                });
            },
            axiosUpdate() {
                axios.patch('/dashboard/offers/' + this.data._id, this.form)
                    .then(response => {
                        this.$root.$emit('update-offer-list', response.data);
                        this.hideForm(false);
                        this.$notify.success({
                            title: 'Sukces',
                            message: 'Operacja aktualizacji ofert powiodła się.',
                            duration: 2500
                        });
                    }).catch(response => {
                    console.log('error:' + response);
                });
            },
            addOffer() {
                this.$refs['form'].$refs['offerForm'].validate((valid) => {
                    if (valid) {
                       if(this.type === 'create') {
                          this.axiosAdd();
                       } else {
                          this.axiosUpdate();
                       }
                    } else {
                        this.$notify.error({
                            title: 'Error',
                            message: 'Formularz nie może być przesłany, popraw wskazane błędy.',
                            duration: 0
                        });
                        return false;
                    }
                });
            }
        }
    }
</script>