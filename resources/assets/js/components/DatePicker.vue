<template>
    <div>
        <slot name="title"></slot>
        <el-date-picker
                v-model="pickedDate"
                type="date"
                placeholder="Wybierz date"
                format="yyyy-MM-dd"
                @change="fetchProducts">
        </el-date-picker>
    </div>
</template>

<script>

    export default {
        props: ['date'],
        data() {
            return {
                pickedDate: '',
            }
        },
        watch: {
            date() {
                this.pickedDate = this.date
            }
        },
        methods: {
            fetchProducts(date) {
                if(date !== this.pickedDate) {
                    axios.get('/api'+ window.location.pathname +'/products', { params:
                        {
                            date: date
                        }
                    }).then(response => {
                        this.$root.$emit('reload-products-data', response.data.data.products_list);
                    }).catch(error => {
                        this.$notify.error({
                            title: 'Error',
                            message: error.response.data,
                            duration: 2500
                        });
                        this.$root.$emit('reload-products-data', []);
                    })
                }
            },
        }
    }
</script>