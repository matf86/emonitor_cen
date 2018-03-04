<template>
    <el-checkbox-group v-model="checkedTypes" size="small" class="mt-1" @change="checkedTypesList">
        <el-checkbox v-for="type in data" :label="type" :key="type">{{ type }}</el-checkbox>
    </el-checkbox-group>
</template>

<script>

   export default {
       props: ['data'],
       data() {
           return {
               checkedTypes:[],
           }
       },
       methods: {
           checkedTypesList() {
               this.$root.$emit('filter-by-type', this.checkedTypes);
           }
       },
       watch: {
           data() {
               this.checkedTypes = this.data;
           }
       }
   }
</script>