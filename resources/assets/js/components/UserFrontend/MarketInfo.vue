<template>
    <el-row class="market-info">
        <info-card :data="data" class="market-info__card"></info-card>
        <google-maps :cords="data.cords" :zoomlevel="14"></google-maps>
    </el-row>
</template>

<script>
    import GoogleMaps from './GoogleMaps.vue';
    import InfoCard from './InfoCard.vue';

    export default {
        components: { GoogleMaps, InfoCard },
        props: ['data'],
    }

</script>

<style lang="scss" scoped>
    .market-info {
        position: relative;
    }

    .market-info__card {
        position: absolute;
        top: 5%;
        left:1%;
        z-index: 10;
    }
</style>

