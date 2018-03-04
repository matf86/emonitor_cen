<template>
    <el-checkbox-group v-model="checkedPlaces" size="small" class="mt-1 mb-1" @change="checkedPlacesList">
        <el-checkbox v-for="place in data" :label="place.value" :key="place.value">{{place.label}}</el-checkbox>
    </el-checkbox-group>
</template>

<script>

   export default {
       props: ['data'],
       data() {
           return {
               checkedPlaces:[],
           }
       },
       methods: {
           setCheckedPlaces(data) {
               this.checkedPlaces = _.map(data, 'value');
           },
           checkedPlacesList() {
               this.$emit('set-places-list', this.checkedPlaces);
           }
       },
       watch: {
           data() {
               this.setCheckedPlaces(this.data);
               this.checkedPlacesList();
           }
       }
   }
</script>