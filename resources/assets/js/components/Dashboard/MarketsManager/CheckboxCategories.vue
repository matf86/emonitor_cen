<template>
    <el-checkbox-group v-model="checkedCategories" size="small" class="mt-1" @change="checkedTypesList">
        <el-checkbox v-for="category in data" :label="category" :key="category">{{ category }}</el-checkbox>
    </el-checkbox-group>
</template>

<script>

    export default {
        props: ['data'],
            data() {
                return {
                    checkedCategories: [],
                }
       },
       methods: {
           checkedTypesList() {
               this.$emit('filter-by-category', this.checkedCategories);
           }
       },
       created() {
           this.checkedCategories = this.data;
       },
       watch: {
           data() {
               this.checkedCategories = this.data;
           }
       }
   }
</script>