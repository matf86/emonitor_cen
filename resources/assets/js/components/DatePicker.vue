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
                slug: location.pathname,
            }
        },
        watch: {
            date() {
                this.pickedDate = this.date
            }
        },
        methods: {
            fetchProducts(date) {
                if(date !==  this.pickedDate) {
                    this.$root.$emit('reload-products-data', date);
                }
            }
        },
    }
</script>